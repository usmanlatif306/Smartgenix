<?php

use App\Enums\GarageUserType;
use App\Enums\UserType;
use App\Models\ExchangeRate;
use App\Models\Garage\EnterpriseGarage;
use App\Models\Garage\GarageSetting;
use App\Models\Garage\GarageUser;
use App\Models\Package;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserLog;
use App\Services\ExchangeRateService;
use App\Services\UserService;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Http;

// get seeting value
if (!function_exists('setting')) {
    function setting($setting_name = Null)
    {
        if ($setting_name === 'currency_symbol') {
            $exchange = ExchangeRate::where('country_code', user_log()?->country)->first();
            if ($exchange) {
                return $exchange->currency_sign;
            }
        }
        $setting = Setting::where('key', $setting_name)->first();

        return $setting ? $setting->value : null;
    }
}

// get garage setting value
if (!function_exists('garage_setting')) {
    function garage_setting($setting_name, $garage_id)
    {
        $setting = GarageSetting::where('name', $setting_name)->where('garage_id', $garage_id)->first();

        return $setting ? $setting->value : null;
    }
}

// get file path of website files
if (!function_exists('file_url')) {
    function file_url($file)
    {
        return setting('app_url') . $file;
    }
}

// get package price
if (!function_exists('package_price')) {
    function package_price($id)
    {
        return Package::find($id)?->total;
    }
}

// check wheather setup is done or not
if (!function_exists('is_setup')) {
    function is_setup()
    {
        if (request()->user()) {
            $setup = request()->user()->setup;
            if ($setup) {
                $vehicles = is_string($setup->vehicles) ? json_decode($setup->vehicles, true) : $setup->vehicles;
                if (count($vehicles) < 1 || !$setup->services) {
                    return true;
                }
            }
        }

        return false;
    }
}

// check the user location
if (!function_exists('location')) {
    function location()
    {
        $ip = str_contains(request()->ip(), '::1') ? '2.31.255.255' : request()->ip();

        return Location::get($ip);
    }
}

// check the user post code if they are from uk
if (!function_exists('postcodes')) {
    function postcodes($code)
    {
        $res = Http::get('https://api.postcodes.io/postcodes/' . $code);
        return $res->json();
    }
}

//  hours of a day
if (!function_exists('hours')) {
    function hours()
    {
        return [
            '01:00:00' => '01:00 AM',
            '02:00:00' => '02:00 AM',
            '03:00:00' => '03:00 AM',
            '04:00:00' => '04:00 AM',
            '05:00:00' => '05:00 AM',
            '06:00:00' => '06:00 AM',
            '07:00:00' => '07:00 AM',
            '08:00:00' => '08:00 AM',
            '09:00:00' => '09:00 AM',
            '10:00:00' => '10:00 AM',
            '11:00:00' => '11:00 AM',
            '12:00:00' => '12:00 PM',
            '13:00:00' => '01:00 PM',
            '14:00:00' => '02:00 PM',
            '15:00:00' => '03:00 PM',
            '16:00:00' => '04:00 PM',
            '17:00:00' => '05:00 PM',
            '18:00:00' => '06:00 PM',
            '19:00:00' => '07:00 PM',
            '20:00:00' => '08:00 PM',
            '21:00:00' => '09:00 PM',
            '22:00:00' => '10:00 PM',
            '23:00:00' => '11:00 PM',
            '00:00:00' => '12:00 AM',
        ];
    }
}

// get user ip
if (!function_exists('user_ip')) {
    function user_ip()
    {
        // france 148.253.127.255,canade 100.42.255.255, UK 31.28.95.255
        $requestIP = request()->ip();
        return str_contains($requestIP, '::') ? '100.42.255.255' : $requestIP;
    }
}

// get user logs
if (!function_exists('user_log')) {
    function user_log()
    {
        if (request()->user()) {
            return request()->user()->user_logs()->latest()->first();
        } else {
            return UserLog::where('ip', user_ip())->whereNull('logged_out_at')->latest()->first();
        }
    }
}

// price converter
if (!function_exists('convert_price')) {
    function convert_price($price, $is_monthly = false)
    {
        if ($is_monthly) {
            $price = round($price / 12, 2);
        }

        $exchange = ExchangeRate::where('country_code', user_log()?->country)->first();
        if ($exchange) {
            $total = $price * $exchange->rate;
            return number_format($total, 2);
        } else {
            return $price;
        }
    }
}

// check weather loggedin user is from uk or not
if (!function_exists('is_uk')) {
    function is_uk()
    {
        if (auth()->user()) {
            $log = user_log();

            if ($log?->country === 'GB' || $log?->country === 'United Kingdom' || $log?->region === 'ENG' || $log?->region === 'England') {
                return true;
            } else {
                return false;
            }
        } else {
            $location = Location::get(user_ip());

            if ($location?->countryName === 'United Kingdom' || $location?->countryName === 'England' || $location?->countryCode === 'GB' || $location?->regionCode === 'ENG' || $location?->regionName === 'England') {
                return true;
            } else {
                return false;
            }
        }
    }
}

// check the user is from UK or not
if (!function_exists('from_uk')) {
    function from_uk()
    {
        $location = Location::get(user_ip());

        if ($location?->countryName === 'United Kingdom' || $location?->countryName === 'England' || $location?->countryCode === 'GB' || $location?->regionCode === 'ENG' || $location?->regionName === 'England') {
            return true;
        } else {
            return false;
        }
    }
}

// check whether a user is on trial or not
if (!function_exists('on_trial')) {
    function on_trial()
    {
        return auth()->user() ? auth()->user()->trial_ends_at > now() : false;
    }
}

// initialze the user service
if (!function_exists('user_service')) {
    function user_service()
    {
        return new UserService();
    }
}

// initialze the exchange_rate service
if (!function_exists('exchange_rate')) {
    function exchange_rate()
    {
        return new ExchangeRateService();
    }
}

// get the package image
if (!function_exists('package_image')) {
    function package_image($package_name)
    {
        return Package::select(['image'])->whereLike('name', $package_name)->first()?->image;
    }
}

// check wheather the user garage is created by enterprise or not
if (!function_exists('is_garage_by_enterprise')) {
    function is_garage_by_enterprise()
    {
        $garage_id = GarageUser::select('id')->with('garage:id,user_id')->where('email', auth()->user()->email)->first()?->garage?->id;

        if ($garage_id) {
            return EnterpriseGarage::where('garage_id', $garage_id)->first() ? true : false;
        } else {
            return false;
        }
    }
}

// check wheather the user package is enterprise
if (!function_exists('is_enterprise')) {
    function is_enterprise()
    {
        $garage_user = GarageUser::select('id', 'type')->where('email', auth()->user()->email)->first();

        return $garage_user->type === GarageUserType::Enterprise ? true : false;
    }
}

// get individual garage package
if (!function_exists('individual_package')) {
    function individual_package($columns = [])
    {
        return Package::when(count($columns) > 0, fn ($q) => $q->select($columns))->whereLike('name', 'individual')->first();
    }
}
