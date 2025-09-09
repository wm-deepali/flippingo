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
        'status'
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

}
