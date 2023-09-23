<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'ip', 'country', 'countryCode', 'region', 'regionName', 'city', 'zipCode', 'latitude', 'longitude', 'areaCode', 'timezone', 'logged_out_at', 'postal'];
}
