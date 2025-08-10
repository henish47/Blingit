<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Display the OTP verification form.
     */
    public function showOtpForm()
    {
        // Ensure the email from the previous step is in the session
        if (!session('email')) {
            return redirect()->route('password.request')->withErrors(['email' => 'Something went wrong. Please request a new OTP.']);
        }
        return view('otp-verify');
    }

    /**
     * Verify the OTP provided by the user and redirect to the reset form.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        // Verify the OTP and check if it has expired
        if (!$user || $user->otp !== $request->otp || now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'The OTP is invalid or has expired.']);
        }

        // OTP is valid, so redirect to the password reset form.
        // We will use the OTP as the "token" to ensure the user is verified.
        return redirect()->route('password.reset', ['token' => $request->otp, 'email' => $request->email]);
    }

    /**
     * Display the password reset view for the given token.
     */
    public function showResetForm(Request $request, $token)
    {
        // Corrected the view path from 'auth.passwords.reset' to 'reset-password'
        return view('reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        // Re-verify the token (OTP) to ensure it's still valid before changing the password
        if (!$user || $user->otp !== $request->token || now()->gt($user->otp_expires_at)) {
            return redirect()->route('password.request')->withErrors(['email' => 'The password reset token is invalid or has expired. Please try again.']);
        }
        
        // Update the user's password
        $user->password = Hash::make($request->password);
        
        // Clear the OTP fields after a successful reset
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('status', 'Your password has been reset successfully!');
    }
}
