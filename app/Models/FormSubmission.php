<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $table = 'form_submissions';

    // Mass assignable fields
    protected $fillable = [
        'form_id',
        'customer_id',
        'data',
        'published', // keep for backward compatibility
        'status',
        'expires_at',
        'published_at',
    ];

    protected $casts = [
        'data' => 'array',
        'published' => 'boolean',
        'expires_at' => 'datetime',
        'published_at' => 'datetime',
    ];


    // Relationships:

    // A submission belongs to a form
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    // A submission belongs to a customer (user)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // A submission has many uploaded files
    public function files()
    {
        return $this->hasMany(FormSubmissionFile::class);
    }

    // New: Histories relationship
    public function histories()
    {
        return $this->hasMany(FormSubmissionHistory::class, 'form_submission_id')->orderBy('created_at', 'desc');
    }

    // Optional helper to add a history entry
    public function addHistory(string $status, ?string $adminRemarks = null, ?int $changedBy = null)
    {
        return $this->histories()->create([
            'status' => $status,
            'admin_remarks' => $adminRemarks,
            'changed_by' => $changedBy,
        ]);
    }

    public function currentStatus()
    {
        return $this->hasOne(FormSubmissionHistory::class, 'form_submission_id')->latestOfMany();
    }

    public function orders()
    {
        return $this->hasMany(ProductOrder::class, 'submission_id');
    }

}
