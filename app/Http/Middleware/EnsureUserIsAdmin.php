<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'admin' role.
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // If not an admin, log them out and redirect to the login page with an error.
        Auth::logout();
        
        return redirect('/login')->withErrors([
            'email' => 'You do not have permission to access the admin panel.'
        ]);
    }
}
