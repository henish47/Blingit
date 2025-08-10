<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; // We will create this Mailable next
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Handle the incoming contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|min:5|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Save the message to the database
        ContactMessage::create($validated);

        // Send the email to your support address
        // Make sure your .env mail settings are configured correctly
        Mail::to('support@blingit.com')->send(new ContactFormMail($validated));

        return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you shortly.');
    }
}
