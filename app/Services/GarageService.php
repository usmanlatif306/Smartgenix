<?php

namespace App\Services;

use App\Enums\GarageUserType;
use App\Models\Garage\Currency;
use App\Models\Garage\Enterprise;
use App\Models\Garage\EnterpriseGarage;
use App\Models\Garage\Garage;
use App\Models\Garage\GarageSetting;
use App\Models\Garage\GarageSubscription;
use App\Models\Garage\GarageUser;
use App\Models\Garage\GarageUsers;
use App\Models\Tier;
use Illuminate\Support\Facades\DB;

class GarageService
{

    // getting statistics
    public function statistics()
    {
        $garage_count = DB::connection('garage')->table('garages')->count();
        $mots_count = DB::connection('garage')->table('mot_appointments')->count();
        $services_count = DB::connection('garage')->table('service_appointments')->count();
        $repairs_count = DB::connection('garage')->table('repair_appointments')->count();
        $recovery_count = DB::connection('garage')->table('recoveries')->count();
        $money_made = $this->money_made();

        if (is_uk()) {
            return  [
                trans('general.indp_garage') => $garage_count,
                trans('general.mot_booked') => $mots_count,
                trans('general.service_booked') => $services_count,
                trans('general.repair_booked') => $repairs_count,
                trans('general.recovery_booked') => $recovery_count,
                trans('general.money_made') => setting('currency_symbol') . $money_made,
            ];
        } else {
            return  [
                trans('general.indp_garage') => $garage_count,
                trans('general.service_booked') => $services_count,
                trans('general.repair_booked') => $repairs_count,
                trans('general.recovery_booked') => $recovery_count,
                trans('general.money_made') => setting('currency_symbol') . $money_made,
            ];
        }
    }

    private function money_made()
    {
        $mots_money =  DB::connection('garage')->table('mot_appointments')->sum('price');
        $services_money =  DB::connection('garage')->table('service_appointments')->sum('price');
        $repairss_money =  DB::connection('garage')->table('repair_appointments')->sum('price');
        $recovery_money =  DB::connection('garage')->table('recoveries')->sum('price');

        $total = $mots_money + $services_money + $repairss_money + $recovery_money;
        if ($total < 1001) {
            return number_format($total, 2);
        } else {
            return number_format(ceil($total) / 1000, 1) . 'K';
        }
    }

    /**
     * creating new garage on garage db
     *
     */
    public function installation($user = null)
    {
        $user = $user ?? request()->user();
        $is_recovery = str_contains($user->active_subscription()?->package?->name, 'Recovery') ? true : false;
        $garage_user = GarageUser::where('email', $user->email)->first();

        if (!$garage_user) {
            // creating garage admin
            $garage_user = GarageUser::create([
                'type' => !$is_recovery ? GarageUserType::Admin : GarageUserType::Recovery,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'mobile' => $user->mobile,
                'company' => $user->company->name,
                'country' => $user->company->country,
                'city' => $user->company->city,
                'email_verified_at' => $user->email_verified_at,
                'password' => $user->password,
                'status' => $user->status ?? true,
                'trial_ends_at' => $user->trial_ends_at
            ]);

            // only create when user is not have recovery subscription
            if (!$is_recovery) {
                // creating garage
                $garage = Garage::create([
                    'user_id' => $garage_user->id,
                    'user_role' => auth()->user()->company->user_role,
                    'name' => auth()->user()->company->name,
                    'country' => auth()->user()->company->country,
                    'city' => auth()->user()->company->city,
                    'address' => auth()->user()->company->address,
                    'latitude' => auth()->user()->company->latitude,
                    'longitude' => auth()->user()->company->longitude,
                    'telephone' => auth()->user()->company->telephone,
                    'postcode' => auth()->user()->company->postcode,
                    'opening' => auth()->user()->company->opening,
                    'closing' => auth()->user()->company->closing,
                    'out_of_hour_response' => auth()->user()->company->out_of_hour_response,
                    'vehicles' => json_encode(auth()->user()->setup->vehicles),
                    'is_mot' => auth()->user()->setup->is_mot,
                    'is_services' => auth()->user()->setup->is_services,
                    'is_repairs' => auth()->user()->setup->is_repairs,
                    'is_recovery' => auth()->user()->setup->is_recovery,
                    'status' => true,
                ]);
            }

            // updating user garage record
            $user->company()->update([
                'garage_user_id' => $garage_user->id,
                'garage_id' => !$is_recovery ? $garage->id : null,
            ]);
        } else {
            $garage_user->garage()?->update(['status' => true]);
        }


        return true;
    }

    /**
     * delete garage garage on garage db
     *
     */
    public function delete()
    {
        // creating garage admin
        $user = GarageUser::where('email', auth()->user()->email)->first();
        if ($user) {
            $garage = Garage::where('user_id', $user->id)->first();
            if ($garage) {
                Currency::where('garage_id', $garage->id)?->delete();
                GarageSetting::where('garage_id', $garage->id)?->delete();
            }
            $garage?->delete();
            $user?->delete();
        }


        return true;
    }

    /**
     * update user infomation on updating subscription
     *
     */
    public function update_garage($new_type, $user)
    {
        if ($new_type === GarageUserType::Enterprise) {
            $enterprise = Enterprise::where('user_id', $user->id)->first();
            if (!$enterprise) {
                $tier = Tier::first();
                Enterprise::create([
                    'user_id' => $user->id,
                    'role' => 'Owner',
                    'garages_left' => $tier->end,
                ]);
            }

            if ($user->garage) {
                EnterpriseGarage::updateOrCreate([
                    'garage_id' => $user->garage->id
                ], [
                    'enterprise_id' => $enterprise->id
                ]);
            }
        }

        $user->update(['type' => $new_type]);
        return true;
    }
}
