<?php

namespace App\Models\Garage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarageSetting extends Model
{
    use HasFactory;

    protected $connection = 'garage';
    protected $table = 'settings';

    protected $fillable = ['garage_id', 'name', 'value'];
}
