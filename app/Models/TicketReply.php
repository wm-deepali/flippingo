<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = [
        'ticket_id',
        'replied_by',
        'replied_type',
        'reply',
    ];

    // Ticket this reply belongs to
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // The user/admin who replied
    public function replier()
    {
        // Or custom logic:
        if ($this->replied_type === 'admin') return $this->belongsTo(\App\Models\User::class, 'replied_by');
        else return $this->belongsTo(\App\Models\Customer::class, 'replied_by');
    }
}
