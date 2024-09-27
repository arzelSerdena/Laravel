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

    public function login(Request $request) {

        // Validating the inputs
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        // Logic for remember session
        if (Auth::attempt($fields, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // If there are errors in the credentials
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('home');
    }
}
