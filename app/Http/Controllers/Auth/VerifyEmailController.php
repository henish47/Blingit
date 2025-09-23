<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Verify the user's email using ID and hash, works even if the user is logged out.
     */
    public function __invoke($id, $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Check if hash matches
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'This action is unauthorized.');
        }

        // If already verified
        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('status', 'Email already verified.');
        }

        // Mark email as verified
        $user->markEmailAsVerified();
        event(new Verified($user));

        return redirect('/')->with('status', '✅ Email verified successfully. You can now login.');
    }
}
