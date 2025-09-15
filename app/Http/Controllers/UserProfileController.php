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
        // Fetch the currently authenticated user and pass it to the view.
        return view('edit_profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // *** MUKHYA SUDHARO AHIYA CHHE ***
        // Have, controller fakt e j fields ne check ane update karshe je form sathe aavya chhe.
        $rules = [];

        if ($request->has('name')) {
            $rules['name'] = ['required', 'string', 'max:255'];
        }
        if ($request->has('email')) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)];
        }
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'];
        }
        if ($request->hasFile('profile_photo')) {
            $rules['profile_photo'] = ['required', 'image', 'max:2048'];
        }

        $validated = $request->validate($rules);
        
        // Fakt validated data ne j update karvano.
        $user->fill($validated);

        // Password ne alag thi handle karvano.
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Profile photo ne alag thi handle karvano.
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->save();

        return redirect()->route('edit_profile')->with('success', 'Profile updated successfully!');
    }
}

