<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('recruiter.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'position'     => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'phone'        => 'nullable|string|max:20',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }
            $path = $request->file('photo')->store('avatars', 'public');
            $user->photo_path = $path;
        }

        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->position     = $request->position;
        $user->company_name = $request->company_name;
        $user->phone        = $request->phone;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}