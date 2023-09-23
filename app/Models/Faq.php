<?php

namespace App\Models;

use App\Enums\FaqType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type', 'question', 'answer', 'show'
    ];

    public static function type()
    {
        if (auth()->user()->isAdmin()) {
            // user is admin
            $type = FaqType::All;
        } elseif (auth()->user()->isStaff()) {
            // user is staff
            $type = FaqType::STAFF;
        } else {
            // user is account
            $type = FaqType::ACCOUNT;
        }

        return $type;
    }
}
