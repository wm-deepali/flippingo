<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'language',
        'text_direction',
        'status',
        'message',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_private' => 'boolean',
        'save' => 'boolean',
        'submission_scope' => 'boolean',
        'protected_files' => 'boolean',
        'submission_editable' => 'boolean',
        'total_limit' => 'boolean',
        'user_limit' => 'boolean',
        'schedule' => 'boolean',
        'authorized_urls' => 'boolean',
        'authorized_urls_error_type' => 'boolean',
        'use_password' => 'boolean',
        'honeypot' => 'boolean',
        'novalidate' => 'boolean',
        'ip_tracking' => 'boolean',
        'analytics' => 'boolean',
        'autocomplete' => 'boolean',
        'resume' => 'boolean',
        'schedule_start_date' => 'datetime',
        'schedule_end_date' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'form_users');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function formData()
    {
        return $this->hasOne(FormData::class, 'form_id', 'id');
    }

    public function filters()
    {
        return $this->hasMany(FormFilter::class);
    }

}

