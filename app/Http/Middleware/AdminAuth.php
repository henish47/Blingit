<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('user_role')) {
            return redirect('/login')->withErrors(['email' => 'Please login to access the admin dashboard.']);
        }
        return $next($request);
    }
} 