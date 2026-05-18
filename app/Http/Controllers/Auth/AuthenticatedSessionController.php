<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // Show login form
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate login form
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        // ROLE REDIRECTION LOGIC — after login
        $user = Auth::user();

        if ($user->role === 'recruiter') {
            return redirect()->route('recruiter.dashboard');
        }

        if ($user->role === 'candidate') {
            return redirect()->route('candidate.dashboard');
        }

        // Admin fallback — redirect to home for now
        return redirect('/');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}