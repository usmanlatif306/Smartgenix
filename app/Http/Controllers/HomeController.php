<?php

namespace App\Http\Controllers;

use App\Enums\GarageUserType;
use App\Http\Requests\AccountUpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Garage\Garage;
use App\Models\Garage\GarageUser;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Newsletter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('subscription');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if (!$request->user()->isCompany()) {
            // Anyother loggedin user will be logged out
            // $request->user()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        } else {
            // if account is suspended then logout
            if (!$request->user()->status) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('error', 'Your account is suspended. Kindly contact with support to restore your account');
            }
            return redirect()->route('company.dashboard');
        }
    }

    /**
     * account
     *
     * @return view
     */
    public function account()
    {
        $garage_user = GarageUser::where('email', auth()->user()->email)->first();
        $is_garage = $garage_user?->type === GarageUserType::Admin;
        $vehicles_list = Vehicle::get();

        return view('account', compact('is_garage', 'vehicles_list'));
    }
    // AccountUpdate
    public function updateAccount(AccountUpdateRequest $request)
    {
        $garage_user = GarageUser::with('garage')->where('email', auth()->user()->email)->first();

        $request->user()->update($request->safe()->except(['password']));
        $garage_user?->update($request->safe()->except(['password']));

        if ($garage_user->type === GarageUserType::Admin) {
            // if address is not same
            if ($request->company_address !== request()->user()->company->address || $request->country !== request()->user()->company->country || $request->city !== request()->user()->company->city || $request->postcode !== request()->user()->company->postcode) {
                if ($request->country == 'United Kingdom' || $request->country == 'England' || $request->country == 'Great Britain' || $request->country == 'GB') {
                    $response = postcodes($request->postcode);

                    if ($response['status'] == 200) {
                        $latitude = $response['result']['latitude'];
                        $longitude = $response['result']['longitude'];
                    } else {
                        $latitude = $request->user()->company?->latitude;
                        $longitude = $request->user()->company?->longitude;
                    }
                } else {
                    $address = $request->company_postcode . ' ' . $request->company_address;
                    $coordinates = findAddressCoordinates($address);
                    $latitude = $coordinates['geometry']['location']['lat'];
                    $longitude = $coordinates['geometry']['location']['lng'];
                }
            } else {
                $latitude = $request->user()->company?->latitude;
                $longitude = $request->user()->company?->longitude;
            }
            // $latitude = rand(30.4512, 320123);
            // $longitude = rand(71.7818, 74.2569);

            if ($request->user()->company) {
                $type = 'update';
            } else {
                $type = 'create';
            }

            $request->user()->company()->$type([
                'name' => $request->company_name,
                'address' => $request->company_address,
                'country' => $request->country,
                'city' => $request->city,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'telephone' => $request->company_telephone,
                'postcode' => $request->postcode,
                'user_role' => $request->user_role,
                'opening' => $request->opening,
                'closing' => $request->closing,
                'out_of_hour_response' => $request->out_of_hour_response === 'yes' ? true : false,
            ]);

            $request->user()->setup()->update([
                'vehicles' => $request->vehicles,
                'is_mot' => $request->is_mot === 'yes' ? true : false,
                'is_services' => $request->is_services === 'yes' ? true : false,
                'is_repairs' => $request->is_repairs === 'yes' ? true : false,
                'is_recovery' => $request->is_recovery === 'yes' ? true : false,
            ]);
            $garage_user?->update([
                'company' => $request->company_name,
                'country' => $request->country,
                'city' => $request->city
            ]);

            $garage_user->garage()?->update([
                'name' => $request->company_name,
                'address' => $request->company_address,
                'country' => $request->country,
                'city' => $request->city,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'telephone' => $request->company_telephone,
                'postcode' => $request->postcode,
                'user_role' => $request->user_role,
                'opening' => $request->opening,
                'closing' => $request->closing,
                'out_of_hour_response' => $request->out_of_hour_response === 'yes' ? true : false,
                'vehicles' => $request->vehicles,
                'is_mot' => $request->is_mot === 'yes' ? true : false,
                'is_services' => $request->is_services === 'yes' ? true : false,
                'is_repairs' => $request->is_repairs === 'yes' ? true : false,
                'is_recovery' => $request->is_recovery === 'yes' ? true : false,
            ]);
        }

        if ($request->password) {
            $request->user()->update([
                'password' => Hash::make($request->password)
            ]);

            $garage_user?->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->back()->with('success', 'User account updated successfully');
    }

    // mailchip sunscription
    public function subscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        if (Newsletter::isSubscribed($request->email)) {
            return redirect()->back()->with('error', 'You have already subscribed');
        }

        Newsletter::subscribe($request->email);

        return redirect()->back()->with('success', 'You have successfully subscribed');
    }
}
