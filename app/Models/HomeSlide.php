<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    protected $fillable = [
        'title',
        'highlight',
        'features',
        'media_type',
        'media_path',
        'btn1_text',
        'btn1_icon',
        'btn1_link',
        'btn2_text',
        'btn2_icon',
        'btn2_link',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}