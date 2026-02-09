<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerEnquiry extends Model
{
    protected $fillable = [
        'seller_id',
        'name',
        'email',
        'mobile',
        'message',
    ];

    public function seller()
    {
        return $this->belongsTo(Customer::class, 'seller_id');
    }
}

