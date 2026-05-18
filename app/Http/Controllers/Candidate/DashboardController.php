<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    // Candidate dashboard
    public function index()
    {
        $user = Auth::user();
        $appliedCount = $user->applications()->count();
        return view('candidate.dashboard', compact('user', 'appliedCount'));
    }

    // Candidate profile page (view only)
    public function profile()
    {
        $user = Auth::user();
        return view('candidate.profile', compact('user'));
    }

    // Candidate edit profile page (form)
    public function editProfile()
    {
        $user = Auth::user();
        return view('candidate.edit_profile', compact('user'));
    }

    // Handle profile update (name, email, photo)
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo from storage if it exists
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }
            // Store new photo in storage/app/public/avatars/
            $path = $request->file('photo')->store('avatars', 'public');
            $user->photo_path = $path;
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('candidate.profile')
                         ->with('success', 'Profile updated successfully!');
    }
}