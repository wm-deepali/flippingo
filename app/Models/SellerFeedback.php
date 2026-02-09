<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerFeedback extends Model
{
    // ✅ define table properly
    protected $table = 'seller_feedbacks';

    protected $fillable = [
        'seller_id',
        'customer_id',
        'rating',
        'message',
    ];

    public function seller()
    {
        return $this->belongsTo(Customer::class, 'seller_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
