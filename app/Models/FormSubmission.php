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
        'total_views',
        'unique_views',
        'total_clicks',
        'sponsor_display_until'
    ];

    protected $casts = [
        'data' => 'array',
        'published' => 'boolean',
        'expires_at' => 'datetime',
        'published_at' => 'datetime',
        'sponsor_display_until' => 'datetime'
    ];


    protected $appends = [
        'product_title',
        'category_name',
        'product_photo',
        'offered_price'
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

    public function getProductTitleAttribute()
    {
        $data = $this->data ? json_decode($this->data, true) : [];
        return $data['product_title']['value'] ?? '-';
    }


     public function getOfferedPriceAttribute()
    {
        $data = $this->data ? json_decode($this->data, true) : [];
        return $data['offered_price']['value'] ?? '-';
    }


    public function getCategoryNameAttribute()
    {
        return optional($this->form->category)->name ?? '-';
    }

    public function getProductPhotoAttribute()
    {
        $file = $this->files()
            ? $this->files()->where('show_on_summary', true)->first()
            : null;

        return $file ? $file->file_path : null;
    }
}
