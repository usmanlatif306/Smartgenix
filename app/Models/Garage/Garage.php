<?php

namespace App\Models\Garage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $connection = 'garage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'user_role', 'name', 'country', 'city', 'address', 'telephone', 'postcode', 'opening', 'closing', 'out_of_hour_response', 'vehicles', 'is_mot', 'is_services', 'is_repairs', 'is_recovery', 'latitude', 'longitude', 'status', 'is_blocked'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'opening' => 'date',
        'closing' => 'date',
    ];


    /**
     * get user of garage
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get reviews of garage
     *
     */
    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }
}
