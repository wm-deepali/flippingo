<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class HomePageContent extends Model
{
    protected $fillable = [
        'section_key',
        'title',
        'description',
    ];
}
