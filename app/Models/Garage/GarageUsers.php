<?php

namespace App\Models\Garage;

use App\Traits\AddGarage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarageUsers extends Model
{
    use HasFactory;

    protected $connection = 'garage';
    protected $table = 'garage_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'garage_id'];

    /**
     * get user of garage
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get garage
     *
     */
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }
}
