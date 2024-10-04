<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function register(Request $request) {

        // Validating the inputs
        $fields = $request->validate([
            'avatar' => ['file', 'nullable', 'max:300'],
            'name' => ['required','max:255'],
            'email' => ['required','email', 'max:255', 'unique:users'],
            'password'=> ['required','confirmed'],
            'admin_token' => 'nullable|string',
        ]);
        
        // Storing the avatar in public folder
        if ($request->hasFile('avatar')) {
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        // Verify if admin token is correct. If yes, set the user as admin.
        if ($request->admin_token === env('ADMIN_TOKEN')) {
            $fields['is_admin'] = true;
        } else {
            $fields['is_admin'] = false;
        }

        // Create user data in the database
        $user = User::create($fields);
        event(new Registered($user));

        // Login
        Auth::login($user);

        // Redirect
        return redirect()->route('dashboard');
        
    }

    // Handle user login
    public function login(Request $request) {
        // Validate the request input: email must be valid and required, password is required
        $request->validate([
            'email' => ['required', 'email'], // validate the email field
            'password' => ['required'], // validate the password field
        ]);
        
        // Attempt to log in the user with the provided email and password, and remember if checkbox is checked
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            // Redirect to the intended page or dashboard after successful login
            return redirect()->intended('dashboard');
        }

        // If authentication fails, return back with an error message for the email field
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.', // show error message
        ])->onlyInput('email'); // keep the email field input intact
    }


    // Handle user logout
    public function logout(Request $request) {

        // Log the user out by invalidating their authentication session
        Auth::logout();

        // Invalidate the current session to prevent reuse
        $request->session()->invalidate();

        // Regenerate the session token to protect against CSRF attacks
        $request->session()->regenerateToken();

        // Redirect the user to the home page after logging out
        return redirect()->route('home');
    }

}
