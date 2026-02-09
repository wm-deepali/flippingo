<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'customer_id',
        'package_id',

        // core usage
        'listings',
        'used_listings',

        // validity
        'start_date',
        'end_date',

        // features snapshot
        'sponsored',
        'sponsored_frequency',
        'sponsored_unit',

        'whatsapp',
        'whatsapp_frequency',
        'whatsapp_unit',

        'featured',
        'featured_frequency',
        'featured_unit',

        'alerts',

        // meta
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
