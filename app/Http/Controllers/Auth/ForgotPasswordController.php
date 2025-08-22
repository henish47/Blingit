<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail; // આપણે આ નવી મેઈલ ક્લાસ બનાવીશું

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
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
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();

        // 6-digit OTP જનરેટ કરો
        $otp = rand(100000, 999999);
        
        // OTP અને તેની એક્સપાયરી ડેટ (10 મિનિટ) યુઝરના રેકોર્ડમાં સાચવો
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        // યુઝરને OTP ઈમેલમાં મોકલો
        Mail::to($user->email)->send(new SendOtpMail($otp, $user));

        // યુઝરને OTP વેરિફિકેશન પેજ પર રીડાયરેક્ટ કરો અને ઈમેલ સાથે મોકલો
        return redirect()->route('password.otp.form')->with(['email' => $user->email, 'status' => 'An OTP has been sent to your email address.']);
    }
}
