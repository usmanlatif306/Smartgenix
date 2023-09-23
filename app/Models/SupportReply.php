<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportReply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'support_id', 'message', 'attachments'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'attachments' => 'array',
    ];

    protected $with = ['user', 'support'];

    /**
     * Get the user of reply.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the support of reply.
     */
    public function support()
    {
        return $this->belongsTo(Support::class);
    }
}
