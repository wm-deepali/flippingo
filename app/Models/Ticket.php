<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'customer_id',    // the user who raised the ticket
        'ticket_type',
        'subject',
        'order_id',
        'detail',
        'file_path',
        'status',
    ];

    // The customer who created the ticket
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class);
    }

    // Replies for the ticket
    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class);
    }
}
