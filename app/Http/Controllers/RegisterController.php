<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    // Show the registration form
    public function create()
    {
        return view('register'); // adjust to 'auth.register' if file is inside 'auth' folder
    }

    // Handle the registration
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        event(new Registered($user)); // Sends email verification
        Auth::login($user); // Auto-login

        return redirect()->route('verification.notice');
    }
}
