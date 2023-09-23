<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerApplicant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'career_id', 'name', 'email', 'mobile', 'address', 'qualification', 'resume'
    ];


    /**
     * job
     *
     * @return void
     */
    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
