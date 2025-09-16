<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\NotificationTemplate;
use App\Models\Customer;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    // Event-Based Notifications // Event-Based Notifications
    public function eventNotifications()
    {
        // Fetch all event templates with their sent notifications
        $templates = NotificationTemplate::with('notifications')
            ->where('type', 'event')
            ->latest()
            ->get();

        return view('admin.notifications.events', compact('templates'));
    }

    // Admin-Created Notifications (list)
    public function adminNotifications()
    {
        $customers = Customer::all();
        // Fetch all admin templates with their sent notifications
        $templates = NotificationTemplate::with('notifications')
            ->where('type', 'admin')
            ->latest()
            ->get();

        return view('admin.notifications.custom', compact('templates', 'customers'));
    }

    // Show create form
    public function create()
    {
        $customers = Customer::all(); // for selecting specific customers
        return view('admin.notifications.create', compact('customers'));
    }

    // Store admin-created notification
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'send_to' => 'nullable|array',
            'use_template' => 'nullable|boolean',
            'template_key' => 'nullable|string|unique:notification_templates,key',
        ]);

        $templateId = null;

        // If admin wants to save as a template
        if ($request->use_template) {
            // Ensure key is provided or generate one
            $key = $request->template_key ?? Str::slug($request->subject) . '-' . time();

            $template = NotificationTemplate::create([
                'key' => $key,
                'type' => 'admin',
                'subject' => $request->subject,
                'content' => $request->content,
                'channels' => ['database'],
                'is_active' => true,
            ]);

            $templateId = $template->id;
        }

        // Create notification
        $notification = Notification::create([
            'template_id' => $templateId,
            'sender_admin_id' => auth()->id(),
            'subject' => $request->subject,
            'content' => $request->content,
            'channels' => ['database'],
            'is_broadcast' => in_array('all', $request->send_to ?? []) ? true : false,
            'broadcast_filter' => [],
        ]);

        // Attach to customers
        if ($request->send_to && !in_array('all', $request->send_to)) {
            $notification->customers()->attach($request->send_to);
        } else {
            $allCustomers = Customer::pluck('id')->toArray();
            $notification->customers()->attach($allCustomers);
        }

        return response()->json([
            'success' => true,
            'message' => 'Notification sent successfully.'
        ]);
    }


    // Send a notification from an existing template
    public function sendFromTemplate(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:notification_templates,id',
            'send_to' => 'nullable|array',
        ]);

        $template = NotificationTemplate::findOrFail($request->template_id);

        // Create a new notification based on the template
        $notification = Notification::create([
            'template_id' => $template->id,
            'sender_admin_id' => auth()->id(),
            'subject' => $template->subject,
            'content' => $template->content,
            'channels' => $template->channels ?? ['database'],
            'is_broadcast' => in_array('all', $request->send_to ?? []) ? true : false,
            'broadcast_filter' => [],
        ]);

        // Attach to specific customers or all
        if ($request->send_to && !in_array('all', $request->send_to)) {
            $notification->customers()->attach($request->send_to);
        } else {
            $allCustomers = Customer::pluck('id')->toArray();
            $notification->customers()->attach($allCustomers);
        }

        return response()->json([
            'success' => true,
            'message' => 'Notification sent successfully from template.'
        ]);
    }

}
