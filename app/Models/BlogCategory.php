<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    /**
     * Automatically use slug for route model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Define relationship with Blog posts (if applicable)
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
