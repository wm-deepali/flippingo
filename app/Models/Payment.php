<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'subscription_id',
        'gateway',
        'product_order_id',
        'payment_id',
        'amount',
        'currency',
        'status'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductOrder::class, 'product_order_id');
    }

}
