<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserNotificationMail;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    /**
     * Show the form to create a new notification.
     */
    public function create()
    {
        return view('admin.notifications');
    }

    /**
     * Send the notification to all active users.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Fetch all users who have verified their email
        $activeUsers = User::whereNotNull('email_verified_at')->get();

        foreach ($activeUsers as $user) {
            Mail::to($user->email)->send(new UserNotificationMail($validated['subject'], $validated['message']));
        }

        return redirect()->route('notifications.create')->with('success', 'Notification has been sent to all active users!');
    }
}
