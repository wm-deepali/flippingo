<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Customer;
use App\Events\MessageSent;

class ChatController extends Controller
{
    /**
     * Show chat interface with contacts and messages
     */
    public function index(Request $request, $receiver_type = null, $receiver_id = null)
{
    $admin = auth()->user();

    // Get all customers
    $allCustomers = Customer::all();

    $contacts = collect();

    foreach ($allCustomers as $customer) {
        // Find last message (if any) between admin and customer
        $last_msg = Chat::where(function ($q) use ($admin, $customer) {
            $q->where('sender_type', 'user')->where('sender_id', $admin->id)
                ->where('receiver_type', 'customer')->where('receiver_id', $customer->id);
        })->orWhere(function ($q) use ($admin, $customer) {
            $q->where('sender_type', 'customer')->where('sender_id', $customer->id)
                ->where('receiver_type', 'user')->where('receiver_id', $admin->id);
        })->latest()->first();

        $contacts->push((object) [
            'id' => $customer->id,
            'type' => 'customer',
            'name' => $customer->name,
            'avatar' => $customer->profile_pic ?? null,
            'status' => $customer->online ? 'online' : 'offline',
            'last_message' => $last_msg->message ?? '',
            'last_message_time' => $last_msg ? $last_msg->created_at->format('h:i a') : ''
        ]);
    }

    // Default receiver (first customer if none selected)
    $receiver = null;
    if (!$receiver_type && !$receiver_id && $contacts->first()) {
        $first = $contacts->first();
        $receiver_type = $first->type;
        $receiver_id = $first->id;
        $receiver = Customer::find($first->id);
    } elseif ($receiver_type && $receiver_id) {
        $receiver = $receiver_type === 'customer'
            ? Customer::find($receiver_id)
            : User::find($receiver_id);
    }

    $contacts = $contacts->sortByDesc(fn($c) => strtotime($c->last_message_time ?: '0'))->values();

    // Load messages
    $messages = collect();
    if ($receiver) {
        $messages = Chat::where(function ($q) use ($admin, $receiver_type, $receiver_id) {
            $q->where('sender_type', 'user')->where('sender_id', $admin->id)
                ->where('receiver_type', $receiver_type)->where('receiver_id', $receiver_id);
        })->orWhere(function ($q) use ($admin, $receiver_type, $receiver_id) {
            $q->where('sender_type', $receiver_type)->where('sender_id', $receiver_id)
                ->where('receiver_type', 'user')->where('receiver_id', $admin->id);
        })->orderBy('created_at')->get();
    }

    $messages = $messages->map(fn($msg) => (object) [
        'id' => $msg->id,
        'sender_type' => $msg->sender_type,
        'sender_id' => $msg->sender_id,
        'sender_name' => $msg->sender_type === 'customer'
            ? Customer::find($msg->sender_id)?->name
            : User::find($msg->sender_id)?->name ?? 'Unknown',
        'sender_avatar' => $msg->sender_type === 'customer'
            ? Customer::find($msg->sender_id)?->profile_pic
            : User::find($msg->sender_id)?->profile_pic,
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

    return view('admin.live-chat', compact('contacts', 'messages', 'receiver', 'receiverType'));
}

    /**
     * Send message via AJAX
     */
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_type' => 'required|string',
            'receiver_id' => 'required|integer'
        ]);

        $admin = auth()->user();

        $chat = Chat::create([
            'sender_type' => 'user',
            'sender_id' => $admin->id,
            'receiver_type' => $request->receiver_type,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($chat))->toOthers();

        return response()->json([
            'message' => $chat->message,
            'created_at' => $chat->created_at->format('h:i a')
        ]);
    }
}
