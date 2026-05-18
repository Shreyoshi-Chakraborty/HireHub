<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    // Show registration form
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validate registration form
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            // Only candidate or recruiter allowed via registration
            'role'     => 'required|in:candidate,recruiter',
        ]);

        // Create new user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Log the user in
        Auth::login($user);

        // ROLE REDIRECTION LOGIC — after registration
        return $this->redirectByRole($user);
    }

    // ROLE REDIRECTION LOGIC — centralized redirect method
    private function redirectByRole($user)
    {
        if ($user->role === 'recruiter') {
            return redirect()->route('recruiter.dashboard');
        }
        return redirect()->route('candidate.dashboard');
    }
}