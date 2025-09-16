<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationCustomer extends Model
{
    use HasFactory;

    protected $table = 'notification_customer';

    protected $fillable = [
        'notification_id',
        'customer_id',
        'status',
        'read_at',
        'is_bookmarked',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'is_bookmarked' => 'boolean',
    ];

    /*
     * Relationships
     */

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
