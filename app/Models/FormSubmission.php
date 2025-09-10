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
        'published',
        'expires_at',
        'published_at',
    ];

    // Cast 'data' JSON column to array automatically
    protected $casts = [
        'data' => 'array',
        'published' => 'boolean',
        'published_at' => 'datetime',
        'expires_at' => 'datetime'
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
}
