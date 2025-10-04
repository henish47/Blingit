<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; // <-- Mail facade ne import karyo
use App\Mail\VerifyEmail;             // <-- Tamaro navo Mailable import karyo

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Handle a new registration.
     */
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
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        // *** MUKHYA SUDHARO AHIYA CHHE ***
        // Have, default email ne badle tamaro custom verification email jase.
        try {
            Mail::to($user->email)->send(new VerifyEmail($user));
        } catch (\Exception $e) {
            // Jo email na jay to pan user ne aagal vadhva do, pan error ne log kari shakay
        }

        // User ne login page par ek success message sathe redirect karo.
        return redirect()->route('login')->with('status', 'Registration successful! Please check your email to verify your account.');
    }
}

