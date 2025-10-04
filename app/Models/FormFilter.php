<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormFilter extends Model
{
    protected $fillable = ['form_id', 'field_key', 'label', 'type', 'position', 'is_active'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
