<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormSubmissionView extends Model
{
    use HasFactory;

    protected $table = 'form_submission_views';

    // The attributes that are mass assignable.
    protected $fillable = [
        'form_submission_id',
        'customer_id',
        'ip_address',
    ];

    /**
     * The form submission that this view belongs to.
     */
    public function formSubmission()
    {
        return $this->belongsTo(FormSubmission::class);
    }

    /**
     * The customer (user) that viewed the submission. Nullable for guests.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
