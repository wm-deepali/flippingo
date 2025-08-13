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
    ];


    protected $casts = [
        'fields' => 'array',
        'builder' => 'array', // if you want same for builder
    ];


    /**
     * Define the relationship with the Form model.
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
