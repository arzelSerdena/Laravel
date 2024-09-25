<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $fields = $request->validate([
            'avatar' => ['file', 'nullable', 'max:300'],
            'name' => ['max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'password'=> ['confirmed'],
        ]);

        $request->user()->fill($fields);

        $request->user()->save();
        return redirect()->route('settings.update');
    }

    public function destroy(Request $request) {
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
