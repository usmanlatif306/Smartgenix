<?php

namespace App\Models\Garage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $connection = 'garage';
    protected $table = 'currencies';

    protected $fillable = ['garage_id', 'name', 'stripe_name', 'symbol'];
}
