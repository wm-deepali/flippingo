<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'sender_admin_id',
        'subject',
        'content',
        'channels',
        'is_broadcast',
        'broadcast_filter',
    ];

    protected $casts = [
        'channels' => 'array',
        'broadcast_filter' => 'array',
        'is_broadcast' => 'boolean',
    ];

    /*
     * Relationships
     */

    // Notification belongs to a template (optional)
    public function template()
    {
        return $this->belongsTo(NotificationTemplate::class, 'template_id');
    }

    // Notification belongs to many customers (through pivot)
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'notification_customer')
            ->withPivot(['status', 'read_at', 'is_bookmarked'])
            ->withTimestamps();
    }

    // Direct relation to pivot
    public function notificationCustomers()
    {
        return $this->hasMany(NotificationCustomer::class);
    }
}
