<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'customer_id',
        'package_id',
        'used_listings',
        'start_date',
        'end_date',
        'status',
        'order_number',
        'cancel_reason',
        'cancel_requested_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function refund()
    {
        return $this->hasOne(PaymentRefund::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }


}
