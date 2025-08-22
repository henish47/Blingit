<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

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
    // In app/Http/Controllers/Admin/ContactMessageController.php

public function destroy(ContactMessage $message)
{
    $message->delete();
    return redirect()->route('admin.contact')->with('success', 'Message deleted successfully!');
}
}
