<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRefund extends Model
{
    protected $table = 'payment_refunds';

    protected $fillable = [
        'subscription_id',
        'refund_method',
        'payment_date',
        'reference_id',
        'remarks',
        'screenshot',
        'amount',
    ];

    /**
     * Relation to Subscription
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
