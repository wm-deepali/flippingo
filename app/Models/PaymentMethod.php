<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'customer_id',
        'type',
        'account_holder_name',
        'account_number',
        'ifsc_code',
        'bank_name',
        'branch_name',
        'receiver_name',
        'upi_id',
        'bank_address',
        'swift_code',
        'iban_number',
        'paypal_email',
    ];

    /**
     * PaymentMethod belongs to a Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
