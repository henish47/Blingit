<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;

        // Secure signed URL valid for 60 minutes
        $this->verificationUrl = URL::temporarySignedRoute(
            'verification.verify', // must match your route name
            Carbon::now()->addMinutes(60),
            [
                'id'   => $this->user->getKey(),
                'hash' => sha1($this->user->getEmailForVerification()),
            ]
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Verify Your Email Address - Blingit')
                    ->view('emails.verify') // your Blade view for the email
                    ->with([
                        'user'             => $this->user,
                        'verificationUrl'  => $this->verificationUrl,
                    ]);
    }
}
