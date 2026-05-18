<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecruiterMiddleware
{
    /**
     * MIDDLEWARE PROTECTION — only recruiters can pass
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in AND has recruiter role
        if (!auth()->check() || auth()->user()->role !== 'recruiter') {
            // Redirect unauthorized users to login
            return redirect()->route('login')
                ->with('error', 'Access denied. Recruiters only.');
        }

        return $next($request);
    }
}