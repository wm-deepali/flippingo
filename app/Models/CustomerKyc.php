<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerKyc extends Model
{
    use HasFactory;

    protected $table = 'customer_kyc';

    protected $fillable = [
        'customer_id',
        'pan_number',
        'pan_document',
        'aadhaar_number',
        'aadhaar_front',
        'aadhaar_back',
        'gst_number',
        'gst_document',
        'personal_id_number',
        'personal_id_document',
        'entity_registration_number',
        'entity_registration_document',
        'tax_registration_number',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
