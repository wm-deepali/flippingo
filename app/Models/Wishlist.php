<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'customer_id',
        'submission_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function submission()
    {
        return $this->belongsTo(FormSubmission::class);
    }
}
