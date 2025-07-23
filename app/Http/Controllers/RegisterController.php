<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     * This method returns the Blade file you have in the Canvas.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Make sure your Blade file is named 'register.blade.php'
        // in the resources/views directory.
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     * This method handles the form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Server-side validation (very important for security!)
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s.\'-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'confirmed', // This automatically checks the 'password_confirmation' field
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        // If validation passes, create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the new user in
        Auth::login($user);

        // Redirect them to the dashboard or home page
        return redirect('/');
    }
}