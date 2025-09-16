<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'type',
        'subject',
        'content',
        'channels',
        'default_recipient',
        'placeholders',
        'is_active',
    ];

    protected $casts = [
        'channels' => 'array',      // stored as JSON
        'placeholders' => 'array',  // stored as JSON
        'is_active' => 'boolean',
    ];

    /*
     * Relationships
     */

    // A template can be used for many notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'template_id');
    }
}
