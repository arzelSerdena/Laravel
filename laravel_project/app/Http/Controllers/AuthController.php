<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    function loginPost(Request $request) {
        $request->validate([
            
            'email' => ['required','email', 'max:255', 'unique:users'],
            'password'=> ['required','confirmed'],
        ]);
        $credentials = $request->only("email", "password");
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("profile"));
        }
        return redirect(route("login"))->with("error", "Invalid credentials.");
    }

    public function register()
    {
        return view("auth.register");
    }

    function registerPost(Request $request) {
        $request->validate([
            'avatar' => ['file', 'nullable', 'max:300'],
            'name' => ['required','max:255'],
            'email' => ['required','email', 'max:255', 'unique:users'],
            'password'=> ['required','confirmed'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->avatar = $request->file('avatar')->store('avatars', 'public');
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return redirect(route("profile"))->with("success", "Account created successfully.");
        }
        return redirect(route('register'))->with("error", "Failed to create account.");
    }
}
