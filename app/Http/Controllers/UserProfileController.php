<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    /**
     * Show the user's profile editing screen.
     */
    public function show()
    {
        return view('edit_profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information (AJAX supported).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation rules
        $rules = [
            'name'  => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s.\'-]+$/'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'profile_photo' => [
                'nullable', 'image', 'max:2048' // Max 2MB
            ],
        ];

        // If changing password
        if ($request->filled('password')) {
            $rules['old_password'] = ['required'];
            $rules['password'] = [
                'required',
                'string',
                Password::min(8)->mixedCase()->numbers()->symbols(),
                'confirmed'
            ];
        }

        $validated = $request->validate($rules);

        // Handle password update
        if ($request->filled('password')) {
            if (! Hash::check($validated['old_password'], $user->password)) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'The current password does not match our records.'
                    ], 422);
                }
                return back()->withErrors([
                    'old_password' => 'The current password does not match our records.'
                ])->withInput();
            }
            $user->password = Hash::make($validated['password']);
        }

        // Update name and email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            // Save new photo
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->save();

        // AJAX response
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully!',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_photo_url' => $user->profile_photo_url,
                ]
            ]);
        }

        // Fallback for non-AJAX
        return redirect()->route('edit_profile')->with('success', 'Profile updated successfully!');
    }
}
