<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            ['email' => 'admin@gmail.com', 'password' => 'admin@123', 'role' => 'admin'],
            ['email' => 'guest@gmail.com', 'password' => 'guest@123', 'role' => 'guest'],
        ];

        foreach ($credentials as $user) {
            if ($request->email === $user['email'] && $request->password === $user['password']) {
                session(['user_role' => $user['role'], 'user_email' => $user['email']]);
                
                if ($user['role'] === 'admin') {
                    return redirect('/admin/dashboard');
                } else {
                    return redirect('/');
                }
            }
        }

        return back()->withInput()->withErrors(['email' => 'Invalid credentials. Please try again.']);
    }
} 