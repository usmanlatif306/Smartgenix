<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'specifications', 'price', 'setup_fee'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'float',
        'setup_fee' => 'float',
        'specifications' => 'array',
        'addons' => 'array',
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getTotalAttribute()
    {
        return $this->price + $this->setup_fee;
    }
}
