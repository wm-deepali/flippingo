<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormSettingsRequest extends FormRequest
{
    public function authorize()
    {
        // Add authorization logic if needed
        // e.g. return $this->user()->can('update', $form);
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'language' => 'required|string|max:10',
            'text_direction' => 'required|in:ltr,rtl',
            'status' => 'required|boolean',
            'is_private' => 'required|boolean',
            'shared_with' => 'required|in:none,everyone,users',
            'users' => 'required_if:shared_with,users|array',
            'users.*' => 'exists:users,id',
            'message' => 'nullable|string|max:1000',
            'submission_number' => 'nullable|string|max:255',
            'submission_number_width' => 'nullable|string|max:10',
            'submission_number_prefix' => 'nullable|string|max:20',
            'submission_number_suffix' => 'nullable|string|max:20',
            'save' => 'required|boolean',
            'submission_scope' => 'required|boolean',
            'protected_files' => 'required|boolean',
            'submission_timezone' => 'nullable|string|max:255',
            'submission_dateformat' => 'nullable|string|max:255',
            'submission_editable' => 'required|boolean',
            'submission_editable_time_length' => 'nullable|integer',
            'submission_editable_time_unit' => 'nullable|string|max:10',
            'total_limit' => 'required|boolean',
            'total_limit_action' => 'nullable|string|max:64',
            'user_limit' => 'required|boolean',
            'user_limit_type' => 'nullable|string|max:64',
            'total_limit_number' => 'nullable|integer',
            'total_limit_time_unit' => 'nullable|string|max:10',
            'user_limit_number' => 'nullable|integer',
            'user_limit_time_unit' => 'nullable|string|max:10',
            'schedule' => 'required|boolean',
            'schedule_start_date' => 'nullable|date',
            'schedule_end_date' => 'nullable|date',
            'authorized_urls' => 'required|boolean',
            'urls' => 'nullable|string|max:512',
            'authorized_urls_error_type' => 'required_if:authorized_urls,1|boolean',
            'authorized_urls_error_message' => 'nullable|string|max:255',
            'use_password' => 'required|boolean',
            'password' => 'nullable|string|max:255',
            'honeypot' => 'required|boolean',
            'novalidate' => 'required|boolean',
            'ip_tracking' => 'required|boolean',
            'analytics' => 'required|boolean',
            'autocomplete' => 'required|boolean',
            'resume' => 'required|boolean',
        ];
    }
}
