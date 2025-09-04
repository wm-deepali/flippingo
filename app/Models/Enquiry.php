<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['submission_id', 'customer_id', 'message', 'status'];

    public function submission()
    {
        return $this->belongsTo(FormSubmission::class, 'submission_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
