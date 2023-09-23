<?php

namespace App\Models\Garage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairAppointment extends Model
{
    use HasFactory;

    protected $connection = 'garage';
    protected $table = 'repair_appointments';
}
