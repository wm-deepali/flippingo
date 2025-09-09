<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'invoice_number',
        'amount',
        'currency',
        'issued_at',
    ];

    protected $dates = [
        'issued_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the subscription associated with the invoice.
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
