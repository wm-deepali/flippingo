<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;

    protected $table = 'form_datas';

    protected $fillable = [
        'form_id',
        'builder',
        'fields',
        'html',
        'height',
        'field_layout'
    ];


    protected $casts = [
        'fields' => 'array',
        'builder' => 'array',
        'field_layout' => 'array'
    ];


    /**
     * Define the relationship with the Form model.
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
