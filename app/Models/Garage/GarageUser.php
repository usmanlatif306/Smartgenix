<?php

namespace App\Models\Garage;

use App\Enums\GarageUserType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class GarageUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'garage';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type', 'first_name', 'last_name', 'email', 'password', 'mobile', 'status', 'email_verified_at', 'trial_ends_at', 'company', 'country', 'city'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function garage()
    {
        return $this->hasOne(Garage::class, 'user_id');
    }

    public static function userType($package)
    {
        if (strtolower($package) === strtolower('Individual garage')) {
            return GarageUserType::Admin;
        } elseif (strtolower($package) === strtolower('Enterprise')) {
            return GarageUserType::Enterprise;
        } else {
            return GarageUserType::Recovery;
        }
    }
}
