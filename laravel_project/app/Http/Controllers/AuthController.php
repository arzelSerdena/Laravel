<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function register(Request $request) {

        // sleep(1);


        
        
        
        // Validate
        $fields = $request->validate([
            'avatar' => ['file', 'nullable', 'max:300'],
            'name' => ['required','max:255'],
            'email' => ['required','email', 'max:255', 'unique:users'],
            'password'=> ['required','confirmed'],
        ]);
        
        if ($request->hasFile('avatar')) {
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }
        

        // Register
        $user = User::create($fields);
        // Login
        Auth::login($user);
        // Redirect
        return redirect()->route('dashboard')->with('greet', 'Welcome to Laravel Inertia Vue app');
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($fields, $request->remember)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
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

    
    // public function login()
    // {
    //     return view("auth.login");
    // }

    // function loginPost(Request $request) {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     $credentials = $request->only("email", "password");
    //     if(Auth::attempt($credentials)){
    //         return redirect()->intended(route("profile"));
    //     }
    //     return redirect(route("login"))->with("error", "Invalid credentials.");
    // }

    // public function register()
    // {
    //     return view("auth.register");
    // }

    // function registerPost(Request $request) {
    //     $request->validate([
    //         'avatar' => ['file', 'nullable', 'max:300'],
    //         'name' => ['required','max:255'],
    //         'email' => ['required','email', 'max:255', 'unique:users'],
    //         'password'=> ['required','confirmed'],
    //     ]);

    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->avatar = $request->file('avatar')->store('avatars', 'public');
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     if ($user->save()) {
    //         return redirect(route("profile"))->with("success", "Account created successfully.");
    //     }
    //     return redirect(route('register'))->with("error", "Failed to create account.");
    // }
}
