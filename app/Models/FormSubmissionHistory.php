<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmissionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_submission_id',
        'status',
        'admin_remarks',
        'changed_by',
    ];

    public function submission()
    {
        return $this->belongsTo(FormSubmission::class, 'form_submission_id');
    }
}