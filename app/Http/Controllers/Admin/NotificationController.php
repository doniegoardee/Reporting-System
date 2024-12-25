<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function markNotificationAsRead($notificationId)
    {
        $userId = Auth::id();

        \Log::info("Marking notification as read for User ID: $userId, Notification ID: $notificationId");

        $notification = DB::table('notifications')
            ->where('id', $notificationId)
            ->where('notifiable_id', $userId)
            ->where('notifiable_type', 'App\Models\User')
            ->whereNull('read_at')
            ->first();

        if (!$notification) {
            \Log::error("Notification not found or already marked as read.");
            return response()->json(['error' => 'Notification not found or already read'], 404);
        }

        DB::table('notifications')
            ->where('id', $notificationId)
            ->where('notifiable_id', $userId)
            ->update(['read_at' => now()]);

        \Log::info("Notification marked as read successfully.");

        return response()->json(['status' => 'success', 'message' => 'Notification marked as read']);
    }

    public function getUnreadCount()
    {
        $userId = Auth::id();

        $unreadCount = DB::table('notifications')
            ->where('notifiable_id', $userId)
            ->whereNull('read_at')
            ->count();

        return response()->json(['unreadCount' => $unreadCount]);
    }
}
