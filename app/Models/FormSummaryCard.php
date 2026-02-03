<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// App\Models\FormSummaryCard.php
class FormSummaryCard extends Model
{
    protected $fillable = [
        'form_id',
        'field_key',
        'label',
        'icon',
        'color',
        'position'
    ];
}