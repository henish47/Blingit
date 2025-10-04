<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Mail\ContactReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the contact messages.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contact', compact('messages'));
    }

    /**
     * Store a reply to a contact message.
     */
    public function reply(Request $request, ContactMessage $message)
    {
        $request->validate([
            'reply' => 'required|string|min:10',
        ]);

        // Mark the message as replied
        $message->markAsReplied($request->reply, Auth::user()->name);

        // Send email to the user
        $emailData = [
            'name' => $message->name,
            'email' => $message->email,
            'subject' => $message->subject,
            'message' => $message->message,
            'reply' => $request->reply,
            'created_at' => $message->created_at->format('F d, Y \a\t h:i A'),
        ];

        Mail::to($message->email)->send(new ContactReplyMail($emailData));

        return redirect()->route('admin.contact')->with('success', 'Reply sent successfully!');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.contact')->with('success', 'Message deleted successfully!');
    }
}
