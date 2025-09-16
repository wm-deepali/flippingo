<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // AdminTicketController.php

    public function index()
    {
        $tickets = Ticket::paginate(20);
        return view('admin.tickets.index', compact('tickets'));
    }


    public function reply(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'reply' => 'required|string',
        ]);

        $ticketReply = new TicketReply();
        $ticketReply->ticket_id = $request->ticket_id;
        $ticketReply->reply = $request->reply;
        $ticketReply->replied_by = auth()->id();       // Admin user ID
        $ticketReply->replied_type = 'admin';          // Type admin to distinguish
        $ticketReply->save();

        return redirect()->back()->with('success', 'Reply sent successfully');
    }

    public function show(Ticket $ticket)
    {
        // Eager load customer and replies with replier
        $ticket->load('customer', 'replies.replier');

        return view('admin.tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:New,In Progress,Resolved'
        ]);

        $ticket->status = $request->input('status');
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }


}
