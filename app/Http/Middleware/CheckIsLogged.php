<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
 public function handle(Request $request, Closure $next): Response
{
    // Check if user is logged in
    if ($request->session()->has('user_logged')) {
        return redirect('/'); // Redirect logged-in users to the homepage
    }

    return $next($request); // Allow access to login and submit routes for non-logged users
}
}
