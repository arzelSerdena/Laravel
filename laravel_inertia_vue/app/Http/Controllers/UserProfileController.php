<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    // Update general user profile fields (e.g., avatar)
    public function update(Request $request)
    {
        // Validate the input, allowing for an optional avatar file with a max size of 300KB
        $fields = $request->validate([
            'avatar' => ['file', 'nullable', 'max:300'], // avatar file is optional, with a size limit
        ]);

        // Update the user's profile with the validated data
        $request->user()->fill($fields);

        // Save the updated user information
        $request->user()->save();

        // Redirect back to the settings page after successful update
        return redirect()->route('settings');
    }

    // Update only the user's avatar
    public function updateAvatar(Request $request)
    {
        // Validate the avatar input, ensuring it is an optional file with a max size of 300KB
        $fields = $request->validate([
            'avatar' => ['file', 'nullable', 'max:300'], // avatar file is optional with a size limit
        ]);

        // Check if an avatar file was uploaded
        if ($request->hasFile('avatar')) {
            // Store the avatar file in the 'avatars' directory under public storage and update the avatar field
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        // Update the user's avatar with the new file path
        $request->user()->fill($fields);

        // Save the updated user information
        $request->user()->save();

        // Redirect back to the dashboard after successfully updating the avatar
        return redirect()->route('dashboard');
    }

    // Update the user's email address
    public function emailUpdate(Request $request)
    {
        // Validate the new email address, ensuring it's unique and valid, but allowing the current email to be ignored
        $fields = $request->validate([
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)], // unique email except for the current user
        ]);

        // Update the user's email address with the validated data
        $request->user()->fill($fields);

        // Save the updated user information
        $request->user()->save();

        // Redirect back to the settings page after a successful email update
        return redirect()->route('settings');
    }

    // Delete the user account
    public function destroy(Request $request)
    {
        // Retrieve the current authenticated user
        $user = $request->user();

        // Log the user out
        Auth::logout();

        // Delete the user's account from the database
        $user->delete();

        // Invalidate the current session to prevent reuse
        $request->session()->invalidate();

        // Regenerate the session token for security
        $request->session()->regenerateToken();

        // Redirect the user to the home page after the account has been deleted
        return redirect()->route('home');
    }
}
