<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyNews extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'title', 'description', 'image', 'expired_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expired_at' => 'date',
        'created_at' => 'datetime',
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getPhotoAttribute()
    {
        return config('services.support_url') . $this->image;
    }
}
