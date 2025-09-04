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
        'is_private',
        'shared_with',
        'message',
        'submission_number',
        'submission_number_width',
        'submission_number_prefix',
        'submission_number_suffix',
        'save',
        'submission_scope',
        'protected_files',
        'submission_timezone',
        'submission_dateformat',
        'submission_editable',
        'submission_editable_time_length',
        'submission_editable_time_unit',
        'total_limit',
        'total_limit_action',
        'user_limit',
        'user_limit_type',
        'total_limit_number',
        'total_limit_time_unit',
        'user_limit_number',
        'user_limit_time_unit',
        'schedule',
        'schedule_start_date',
        'schedule_end_date',
        'authorized_urls',
        'urls',
        'authorized_urls_error_type',
        'authorized_urls_error_message',
        'use_password',
        'password',
        'honeypot',
        'novalidate',
        'ip_tracking',
        'analytics',
        'autocomplete',
        'resume',
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

}

