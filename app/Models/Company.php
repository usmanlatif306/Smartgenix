<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'first_name', 'middle_name', 'last_name', 'name', 'address', 'telephone', 'postcode', 'country', 'city', 'user_role', 'opening', 'closing', 'out_of_hour_response', 'links', 'latitude', 'longitude', 'garage_user_id', 'garage_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'links' => 'array',
        // 'opening' => 'time',
        // 'closing' => 'time',
    ];
}
