<?php

namespace App\Models\Garage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnterpriseGarage extends Model
{
    use HasFactory;
    protected $connection = 'garage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['enterprise_id', 'garage_id'];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }
}
