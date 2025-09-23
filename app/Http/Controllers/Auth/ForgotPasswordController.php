<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset OTP.
     */
    public function showLinkRequestForm()
    {
        return view('forgot-password');
    }

    /**
     * Send an OTP to the given user.
     */
    public function sendOtp(Request $request)
    {
        // Validate email format
        $request->validate(
            [
                'email' => 'required|email'
            ],
            [
                'email.required' => '⚠️ Please enter your email address.',
                'email.email' => '⚠️ Please enter a valid email address.',
            ]
        );

        // Fetch user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists
        if (! $user) {
            return back()->withErrors(['email' => '❌ This email is not registered.'])->withInput();
        }

        // Check if user has verified email (activated)
        if (is_null($user->email_verified_at)) {
            return back()->withErrors(['email' => '⚠️ Your account is not activated. Please verify your email.'])->withInput();
        }

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Save OTP and expiry (10 minutes)
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        // Send OTP email
        Mail::to($user->email)->send(new SendOtpMail($otp, $user));

        // Redirect to OTP verification page
        return redirect()->route('password.otp.form')->with([
            'email' => $user->email,
            'status' => '✅ An OTP has been sent to your email address.'
        ]);
    }
}
