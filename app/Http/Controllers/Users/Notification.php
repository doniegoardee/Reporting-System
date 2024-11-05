<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Notification extends Controller
{
    public function markNotificationAsRead($notificationId)
    {
        // Get the authenticated user
        $userId = Auth::id();

        // Find the notification by `id` and `notifiable_id` (user ID)
        $notification = DB::table('notifications')
            ->where('id', $notificationId)
            ->where('notifiable_id', $userId)
            ->where('notifiable_type', 'App\Models\User') // Specify user model if polymorphic
            ->first();

        if ($notification && is_null($notification->read_at)) {
            // Update the `read_at` column directly in the database
            DB::table('notifications')
                ->where('id', $notificationId)
                ->update(['read_at' => Carbon::now()]);

            return response()->json(['success' => 'Notification marked as read']);
        }

        return response()->json(['error' => 'Notification not found or already read'], 404);
    }
}