<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormSubmissionStat extends Model
{
    use HasFactory;

    protected $table = 'form_submission_stats';

    protected $fillable = [
        'form_submission_id',
        'date',
        'views',
        'clicks',
        'unique_views',
    ];

    public function submission()
    {
        return $this->belongsTo(FormSubmission::class, 'form_submission_id');
    }
}
