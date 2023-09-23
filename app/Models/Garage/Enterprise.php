<?php

namespace App\Models\Garage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;

    protected $connection = 'garage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role', 'garages_left'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the user of enterprise.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the garages of enterprise.
     */
    public function garages()
    {
        return $this->hasManyThrough(Garage::class, EnterpriseGarage::class);
    }
}
