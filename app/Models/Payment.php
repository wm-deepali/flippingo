<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'subscription_id',
        'gateway',
        'payment_id',
        'amount',
        'currency',
        'status'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
