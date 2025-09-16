<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationCustomer;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function notifications(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Get all notifications for the customer
        $notificationsQuery = $customer->notifications()->withPivot('status', 'read_at', 'is_bookmarked')->latest();

        // Apply filter if requested
        $filter = $request->query('filter');
        if ($filter === 'Unread') {
            $notificationsQuery->wherePivot('status', '!=', 'read');
        } elseif ($filter === 'Read') {
            $notificationsQuery->wherePivot('status', 'read');
        } elseif ($filter === 'Bookmarks') {
            $notificationsQuery->wherePivot('is_bookmarked', true);
        }

        $notifications = $notificationsQuery->get();

        // Compute top card counts
        $allNotifications = $customer->notifications()->withPivot('status', 'read_at', 'is_bookmarked')->get();

        $counts = [
            'recent' => $allNotifications->count(),
            'unread' => $allNotifications->where('pivot.status', '!=', 'read')->count(),
            'read' => $allNotifications->where('pivot.status', 'read')->count(),
            'bookmarks' => $allNotifications->where('pivot.is_bookmarked', true)->count(),
        ];

        return view('user.notifications', compact('notifications', 'counts', 'filter'));
    }

    public function markAsRead($id)
    {
        $customer = Auth::guard('customer')->user();

        // Find the notification entry for this customer
        $notificationCustomer = NotificationCustomer::where('notification_id', $id)
            ->where('customer_id', $customer->id)
            ->firstOrFail();

        // Mark it as read
        $notificationCustomer->update(['read_at' => now(), 'status' => 'read']);

        return back()->with('success', 'Notification marked as read.');
    }

    public function toggleBookmark($id)
    {
        $customer = Auth::guard('customer')->user();

        $notificationCustomer = NotificationCustomer::where('notification_id', $id)
            ->where('customer_id', $customer->id)
            ->firstOrFail();

        $notificationCustomer->update([
            'is_bookmarked' => !$notificationCustomer->is_bookmarked
        ]);

        return back()->with('success', 'Bookmark status updated.');
    }
}
