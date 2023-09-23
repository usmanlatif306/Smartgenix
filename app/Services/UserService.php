<?php

namespace App\Services;

use App\Models\UserLog;
use Stevebauman\Location\Facades\Location;

class UserService
{
    public function create_log($user = null)
    {
        $user = $user ?? request()->user();
        $position = Location::get(user_ip());
        // $user->user_logs()->
        UserLog::create([
            'user_id' => $user ? $user->id : null,
            'ip' => $position ? $position->ip : user_ip(),
            'country' => $position ? $position->countryCode : 'GB',
            'region' => $position ? $position->regionName : 'England',
            'city' => $position ? $position->cityName : 'Stevenage',
            'postal' => $position ? $position->zipCode : 'SG1',
            'latitude' => $position ? $position->latitude : '51.9022',
            'longitude' => $position ? $position->longitude : '-0.2026',
            'timezone' => $position ? $position->timezone : 'Europe/London',
        ]);

        return true;
    }
}
