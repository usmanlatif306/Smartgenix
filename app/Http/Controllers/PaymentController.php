<?php

namespace App\Http\Controllers;

use App\Enums\GarageUserType;
use App\Enums\PaymentType;
use App\Models\Garage\Garage;
use App\Models\Garage\GarageUser;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Setup;
use App\Services\GarageService;
use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    public function index()
    {
        $data = [];
        if (request()->package === 'renewal') {
            $data['packages'] = Package::get();
            if (request()->user()->active_subscription()) {
                $data['package_id'] = request()->user()->active_subscription()->package_id;
            } else {
                $data['package_id'] = request()->user()->last_subscription?->package_id;
            }
            abort_if(!$data['package_id'], 404);
            $data['package'] = Package::findOrFail($data['package_id']);
            $data['price'] = $data['packages']->find($data['package_id'])?->price;
        } elseif (request()->type === 'package') {
            $data['package'] = Payment::with('package')->findOrFail(request()->package);
            abort_if(!$data['package'], 404);
            $data['price'] = $data['package']?->total;
        } elseif (request()->type === 'quote') {
            $data['quote'] = Payment::with('quote')->findOrFail(request()->quote);
            abort_if(!$data['quote'], 404);
            $data['price'] = $data['quote']?->total;
        } else {
            abort(404);
            $data['packages'] = Package::whereNot('name', 'Enterprise')->get();
            $data['price'] = $data['packages']->first()->total;
        }
        $data['new_date'] = $this->getSubscriptionExpiredDate();

        return view('company.payment', compact('data'));
    }

    public function payment(Request $request)
    {
        $price = 0;
        $message = '';
        $des = '';
        if ($request->has('package')) {
            $price = Package::find($request->package)->price;
            $message = trans('general.package_renew');
            $des = 'Payment for package renew for customer ' . $request->user()->name;
        } elseif ($request->has('payment_id')) {
            $payment = Payment::with(['user:id,first_name,last_name'])->find($request->payment_id);
            $price = $payment->total;
            $message = trans('general.package_renew');
            $des = 'Payment for package renew for customer ' . $payment->user->name;
        } elseif ($request->has('quote_id')) {
            $payment = Payment::with(['user:id,first_name,last_name'])->find($request->quote_id);
            $price = $payment->total;
            $message =  trans('general.payment_quote');
            $des = 'Payment for quote for customer ' . $payment->user->name;
        } elseif ($request->has('buy_package')) {
            $price = Package::find($request->buy_package)->total;
            $message = trans('general.package_bought');
            $des = 'Payment for package bought for customer ' . $request->user()->name;
        }

        $expiredAt = $this->getSubscriptionExpiredDate();
        Stripe\Stripe::setApiKey(setting('stripe_secret'));
        $stripe = Stripe\Charge::create([
            "amount" => $price * 100,
            "currency" => setting('currency_name'),
            "source" => $request->stripeToken,
            "description" => $des
        ]);

        // if payment is for package renewal
        if ($request->has('package')) {
            // expired old subscription
            $request->user()->active_subscription()?->update(['expired_at' => now()]);
            $request->user()->subscriptions()->create([
                'package_id' => $request->package,
                'expired_at' => $expiredAt,
                'stripe_id' => $stripe->id,
                'price' => $price
            ]);
            $request->user()->payments()->create([
                'type' => 'package',
                'package_id' => $request->package,
                'due_date' => now(),
                'total' => $price,
                'status' =>  PaymentType::Paid,
                'stripe_id' => $stripe->id,
            ]);

            $garage_user = GarageUser::select(['id', 'email', 'type'])->where('email', auth()->user()->email)->first();

            if ($garage_user->type === GarageUserType::Admin) {
                $garage_user->garage()->update(['status' => true]);
            }

            $garage_user->update([
                'status' => true
            ]);
        } elseif ($request->has('payment_id')) {
            // if payment is for quote package renewal
            // expired old subscription
            $request->user()->active_subscription()?->update(['expired_at' => now()]);
            $request->user()->subscriptions()->create([
                'package_id' => $payment->package_id,
                'expired_at' => $expiredAt,
                'stripe_id' => $stripe->id,
                'price' => $price
            ]);

            $package = Package::find($payment->package_id);
            $garage_user = GarageUser::where('email', auth()->user()->email)->first();
            $new_type = GarageUser::userType($package->name);

            if ($new_type !== GarageUserType::Admin) {
                (new GarageService())->update_garage($new_type, $garage_user);
            } else {
                Setup::updateOrCreate([
                    'user_id' => auth()->id()
                ], [
                    'vehicles' => [],
                    'services' => false,
                ]);
            }
            // if ($new_type === GarageUserType::Admin) {
            //     Setup::updateOrCreate([
            //         'user_id' => auth()->id()
            //     ], [
            //         'vehicles' => [],
            //         'services' => false,
            //     ]);
            // }

            // update payment status to paid with stripe id
            $payment->update([
                'status' => PaymentType::Paid,
                'stripe_id' => $stripe->id,
            ]);

            // updating garage user status to active
            $garage_user->update([
                'status' => true
            ]);

            return redirect()->route('company.billing.index')->with('success', $message);
        } elseif ($request->has('quote_id')) {
            // update payment status to paid with stripe id
            $payment->update([
                'status' => PaymentType::Paid,
                'stripe_id' => $stripe->id,
            ]);

            return redirect()->route('company.billing.index')->with('success', $message);
        } elseif ($request->has('buy_package')) {
            // if payment is bought new package
            $request->user()->subscriptions()->create([
                'package_id' => $request->buy_package,
                'expired_at' => $expiredAt,
                'stripe_id' => $stripe->id,
                'price' => $price
            ]);
            $request->user()->payments()->create([
                'type' => 'package',
                'package_id' => $request->buy_package,
                'due_date' => now(),
                'total' => $price,
                'status' =>  PaymentType::Paid,
                'stripe_id' => $stripe->id,
            ]);
        }
        return redirect()->route('company.dashboard')->with('success', $message);
    }

    /**
     * get subscription expired date
     *
     */
    private function getSubscriptionExpiredDate()
    {
        $old_subscription_days = request()->user()->active_subscription()?->expired_at->diffInDays(now());
        return now()->addDays($old_subscription_days)->addYear();
    }
}
