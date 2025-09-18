<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Customer;
use App\Models\User;
use App\Events\MessageSent;

class ChatController extends Controller
{
    // Show list of contacts
    public function index(Request $request, $receiver_type = null, $receiver_id = null)
    {
        $customer = auth('customer')->user();
        $receiver = null;

        // Get all chat contacts
        $contacts_ids = Chat::where(function ($q) use ($customer) {
            $q->where('sender_type', 'customer')->where('sender_id', $customer->id)
                ->orWhere('receiver_type', 'customer')->where('receiver_id', $customer->id);
        })
            ->selectRaw("DISTINCT CASE WHEN sender_type='customer' AND sender_id={$customer->id} THEN receiver_id ELSE sender_id END as contact_id, CASE WHEN sender_type='customer' AND sender_id={$customer->id} THEN receiver_type ELSE sender_type END as contact_type")
            ->get();

        $contacts = collect();

        foreach ($contacts_ids as $c) {
            $contact = $c->contact_type === 'customer' ? Customer::find($c->contact_id) : User::find($c->contact_id);
            if (!$contact)
                continue;

            $last_msg = Chat::where(function ($q) use ($customer, $c) {
                $q->where('sender_type', $c->contact_type)->where('sender_id', $c->contact_id)
                    ->where('receiver_type', 'customer')->where('receiver_id', $customer->id);
            })->orWhere(function ($q) use ($customer, $c) {
                $q->where('sender_type', 'customer')->where('sender_id', $customer->id)
                    ->where('receiver_type', $c->contact_type)->where('receiver_id', $c->contact_id);
            })->latest()->first();

            $contacts->push((object) [
                'id' => $contact->id,
                'type' => $c->contact_type,
                'name' => $contact->name ?? trim(($contact->first_name ?? '') . ' ' . ($contact->last_name ?? '')),
                'avatar' => $contact->profile_pic ?? null,
                'status' => $contact instanceof Customer ? ($contact->online ? 'online' : 'offline') : 'online',
                'last_message' => $last_msg->message ?? '',
                'last_message_time' => $last_msg ? $last_msg->created_at->format('h:i a') : '',
            ]);

        }

        // Add admin if not exists
        $admin = User::where('role', 'admin')->first();
        if ($admin && !$contacts->firstWhere('id', $admin->id)) {
            $contacts->prepend((object) [
                'id' => $admin->id,
                'type' => 'user',
                'name' => $admin->name,
                'avatar' => $admin->profile_pic,
                'status' => 'online',
                'last_message' => '',
                'last_message_time' => ''
            ]);
        }

        // Set default receiver
        if (!$receiver_type && !$receiver_id && $admin) {
            $receiver = $admin;
            $receiver_type = 'user';
            $receiver_id = $admin->id;
        } elseif ($receiver_type && $receiver_id) {
            $receiver = $receiver_type === 'customer' ? Customer::find($receiver_id) : User::find($receiver_id);
        }

        $contacts = $contacts->sortByDesc(fn($c) => strtotime($c->last_message_time))->values();

        // Load messages with selected receiver
        $messages = collect();
        if ($receiver) {
            $messages = Chat::where(function ($q) use ($customer, $receiver_type, $receiver_id) {
                $q->where('sender_type', 'customer')->where('sender_id', $customer->id)
                    ->where('receiver_type', $receiver_type)->where('receiver_id', $receiver_id);
            })->orWhere(function ($q) use ($customer, $receiver_type, $receiver_id) {
                $q->where('sender_type', $receiver_type)->where('sender_id', $receiver_id)
                    ->where('receiver_type', 'customer')->where('receiver_id', $customer->id);
            })->orderBy('created_at')->get();
        }

        // Map sender info
        $messages = $messages->map(fn($msg) => (object) [
            'id' => $msg->id,
            'sender_type' => $msg->sender_type,
            'sender_id' => $msg->sender_id,
            'sender_name' => $msg->sender_type === 'customer' ? Customer::find($msg->sender_id)?->name : User::find($msg->sender_id)?->name ?? 'Unknown',
            'sender_avatar' => $msg->sender_type === 'customer' ? Customer::find($msg->sender_id)?->profile_pic : User::find($msg->sender_id)?->profile_pic,
            'message' => $msg->message,
            'created_at' => $msg->created_at->format('h:i a'),
        ]);

        $receiverType = $receiver instanceof Customer ? 'customer' : 'user';

        if ($request->ajax()) {
            return response()->json([
                'contacts' => $contacts,
                'messages' => $messages,
                'receiver' => $receiver,
                'receiver_status' => $receiver instanceof Customer ? ($receiver->online ? 'online' : 'offline') : 'online'

            ]);
        }

        return view('user.live-chat', compact('contacts', 'messages', 'receiver', 'receiverType'));
    }


    // Send message via AJAX

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_type' => 'required|string',
            'receiver_id' => 'required|integer'
        ]);

        $customer = auth('customer')->user();

        $chat = Chat::create([
            'sender_type' => 'customer',
            'sender_id' => $customer->id,
            'receiver_type' => $request->receiver_type,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        // Fire the broadcast event
        broadcast(new MessageSent($chat))->toOthers();

        return response()->json([
            'message' => $chat->message,
            'created_at' => $chat->created_at->format('h:i a')
        ]);
    }

}
