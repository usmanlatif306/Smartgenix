<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'title', 'description', 'content', 'image', 'category'
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

    /**
     * Get the user of blog.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
