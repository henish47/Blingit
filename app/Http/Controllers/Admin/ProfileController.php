<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the user's profile page.
     */
    public function index()
    {
        // The view will get the user data directly via the Auth facade
        return view('admin.profile');
    }

    /**
     * Update the user's profile information (name, email, and profile photo).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'max:2048'], // Profile photo validation
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];
        
        // Handle profile photo upload if a new photo is provided
        if ($request->hasFile('profile_photo')) {
            // Delete the old photo if it exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            // Store the new photo and add its path to the update data
            $updateData['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->update($updateData);

        return redirect()
            ->route('admin.profile.index')
            ->with('profile_success', 'Profile information updated successfully!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::defaults(), 'confirmed', 'different:current_password'],
        ]);

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()
            ->route('admin.profile.index')
            ->with('password_success', 'Password updated successfully!');
    }
}
