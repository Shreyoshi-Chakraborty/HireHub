<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CandidateMiddleware
{
    /**
     * MIDDLEWARE PROTECTION — only candidates can pass
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in AND has candidate role
        if (!auth()->check() || auth()->user()->role !== 'candidate') {
            // Redirect unauthorized users to login
            return redirect()->route('login')
                ->with('error', 'Access denied. Candidates only.');
        }

        return $next($request);
    }
}