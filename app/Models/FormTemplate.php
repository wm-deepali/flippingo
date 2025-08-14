<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormTemplate extends Model
{
    // Table name (optional if it matches plural of model name)
    protected $table = 'form_templates';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'slug',
        'fields',
        'builder',
        'html',
        'height',
    ];

    // Cast fields & builder to array for easy use
    protected $casts = [
        'fields'  => 'array',
        'builder' => 'array',
    ];
}
