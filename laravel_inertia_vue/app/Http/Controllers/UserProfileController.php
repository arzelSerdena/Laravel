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
            
        ]);

        $request->user()->fill($fields);

        $request->user()->save();
        return redirect()->route('settings');
    }

    public function updateAvatar(Request $request)
    {
        
        $fields = $request->validate([
            'avatar' => ['file', 'nullable', 'max:300'],
            
        ]);

        if ($request->hasFile('avatar')) {
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        $request->user()->fill($fields);

        $request->user()->save();
        return redirect()->route('dashboard');
    }

    public function emailUpdate(Request $request)
    {
        $fields = $request->validate([
            
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            
        ]);

        $request->user()->fill($fields);

        $request->user()->save();
        return redirect()->route('settings');
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
