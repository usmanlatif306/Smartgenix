<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\SupportType;
use App\Enums\UserRoles;
use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// implements MustVerifyEmail
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id', 'first_name', 'last_name', 'email', 'status', 'password', 'mobile', 'telephone', 'garage_user_id', 'is_blocked', 'trial_ends_at'
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
    ];

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // check company
    function isCompany()
    {
        // return $this->type === UserType::Company;
        return $this->role_id === UserRoles::Company;
    }

    /**
     * user logs
     */
    public function user_logs()
    {
        return $this->hasMany(UserLog::class)->latest();
    }

    /**
     * Get the user previous all subscriptions.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->with(['package'])->latest();
    }

    /**
     * Get the user current active subscription.
     */
    public function active_subscription()
    {
        return $this->subscriptions()->where('expired_at', '>', now())->first();
    }

    /**
     * Get the user last subscription.
     */
    public function last_subscription()
    {
        return $this->hasOne(Subscription::class)->latest();
    }

    /**
     * Get the company information for a user.
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /**
     * Get the setup integration for a user.
     */
    public function setup()
    {
        return $this->hasOne(Setup::class);
    }

    /**
     * Get the blogs fro a user.
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * Get the payments fora user.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the supports ticket fro a user.
     */
    public function tickets()
    {
        return $this->hasMany(Support::class)->where('type', SupportType::Normal)->orderBy('updated_at', 'desc');
    }
}
