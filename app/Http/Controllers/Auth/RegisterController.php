<?php

namespace App\Http\Controllers\Auth;

use App\Enums\PaymentType;
use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Package;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\GarageService;
use App\Services\UserService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Stripe;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $package = Package::find($data['package']);
        $is_recovery = str_contains(strtolower($package->name), strtolower('Recovery')) ? true : false;
        $price = $package->price + $package->setup_fee;
        $country = Country::select(['code'])->whereName($data['country'])->first();

        Stripe\Stripe::setApiKey(setting('stripe_secret'));

        try {
            $payment = Stripe\Charge::create([
                "amount" => $price * 100,
                "currency" => setting('currency_name'),
                "source" => $data['stripeToken'],
                "description" => "Payment for " . $package->name . " package purchase"
            ]);
            // $payment = 'test';

            $user = User::create([
                'role_id' => UserRoles::Company,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'mobile' => $country->code . $data['mobile'],
                'telephone' => $country->code . $data['telephone'],
                'password' => Hash::make($data['password']),
            ]);

            // saving user company record
            $user->company()->create([
                'name' => $data['company_name'],
                'country' => $data['country'],
                'city' => $data['city'],
                'address' => $data['company_address'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'telephone' => $country->code . $data['company_telephone'],
                'postcode' => $data['company_postcode'],
                'user_role' => $data['role'],
                'opening' => $data['opening'],
                'closing' => $data['closing'],
                'out_of_hour_response' => $data['out_of_hour_response'] === 'yes' ? true : false,
            ]);

            // user payment
            $user->payments()->create([
                'type' => 'Package Subscription',
                'package_id' => $package->id,
                'due_date' => now(),
                'total' => $package->total,
                'status' => PaymentType::Paid,
                'stripe_id' => $payment->id
            ]);

            // payment with capture here
            $user->subscriptions()->create([
                'package_id' => $package->id,
                'expired_at' => now()->addYear(),
                'stripe_id' => $payment->id,
                'price' => $package->total
            ]);

            // creating user setup
            $user->setup()->create([
                'vehicles' => !$is_recovery ? [] : ['cars'],
                'services' => $is_recovery ? true : false,
                'is_mot' => false,
                'is_services' => false,
                'is_repairs' => false,
                'is_recovery' => false,
            ]);

            (new UserService())->create_log($user);

            if ($is_recovery) {
                (new GarageService())->installation($user);
            }

            return $user;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
