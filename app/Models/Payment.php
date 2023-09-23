<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'type', 'package_id', 'due_date', 'total', 'status', 'stripe_id', 'tier_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * Get the user of payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the package of payment.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the quote on payment.
     */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    /**
     * Get the tier of payment.
     */
    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}
