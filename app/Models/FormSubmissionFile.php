<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmissionFile extends Model
{
    use HasFactory;

    protected $table = 'form_submission_files';

    // Mass assignable fields
    protected $fillable = [
        'form_submission_id',
        'field_name',
        'file_path',
        'original_name',
        'mime_type',
        'size',
        'show_on_summary',
    ];

     // Cast 'data' JSON column to array automatically
    protected $casts = [
        'show_on_summary' => 'boolean',
    ];

    // Relationship: file belongs to a submission
    public function formSubmission()
    {
        return $this->belongsTo(FormSubmission::class);
    }
}
