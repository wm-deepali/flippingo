<?php

namespace App\Http\Controllers;

use App\Models\TicketReply;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{

    public function index()
    {
        $customerId = Auth::guard('customer')->id();

        // Paginated tickets for table
        $tickets = Ticket::where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Status counts for cards
        $countNew = Ticket::where('customer_id', $customerId)->where('status', 'New')->count();
        $countProgress = Ticket::where('customer_id', $customerId)->where('status', 'In Progress')->count();
        $countResolved = Ticket::where('customer_id', $customerId)->where('status', 'Resolved')->count();

        return view('user.raise-request', compact('tickets', 'countNew', 'countProgress', 'countResolved'));
    }


    public function show(Ticket $ticket)
    {
        $ticket->load('replies.replier'); // Eager load replies and replier

        // Ensure logged-in customer is owner for security

        return view('user.tickets.show', compact('ticket'));
    }


    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'ticket_type' => 'required|string',
            'subject' => 'required|string|max:255',
            'order_id' => 'nullable|string|max:100',
            'detail' => 'required|string',
            'file' => 'nullable|file|max:2048', // max 2MB
        ]);

        try {
            $ticket = new Ticket();
            $ticket->customer_id = Auth::guard('customer')->id(); // customer auth
            $ticket->ticket_type = $request->ticket_type;
            $ticket->subject = $request->subject;
            $ticket->order_id = $request->order_id;
            $ticket->detail = $request->detail;
            $ticket->status = 'New';

            // Handle file upload
            if ($request->hasFile('file')) {
                $ticket->file_path = $request->file('file')->store('tickets', 'public');
            }

            $ticket->save();

            return response()->json([
                'success' => true,
                'ticket' => $ticket,
                'message' => 'Ticket created successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating ticket: ' . $e->getMessage()
            ], 500);
        }
    }


    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:New,In Progress,Resolved,Closed',
        ]);

        $ticket->status = $request->status;
        $ticket->save();

         return response()->json([
            'success' => true,
            'message' => 'Ticket status updated successfully.'
        ]);
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
        $ticketReply->replied_by = Auth::guard('customer')->id();       // Admin user ID
        $ticketReply->replied_type = 'customer';          // Type admin to distinguish
        $ticketReply->save();

        return response()->json([
            'success' => true,
            'message' => 'Reply sent successfully'
        ]);
    }

}
