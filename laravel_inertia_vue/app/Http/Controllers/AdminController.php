<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function destroy(User $user) {
        
        $user->delete();
        return redirect()->route('home');
    }

    public function edit(User $user)
{
    return inertia('AdminEdit', [
        'user' => $user,
    ]);
}
public function update(Request $request, User $user)
{
    // dd($request);
    
    // Validate the incoming request
    $fields = $request->validate([
        
        'name' => ['max:255'],
        
    ]);

    
    // Fill the user model with validated fields
    $user->fill($fields);

    // Save the changes
    $user->save();

    return redirect()->route('home')->with('success', 'Profile updated successfully!');
}

public function updateEmail(Request $request, User $user)
{
    // dd($request);
    
    // Validate the incoming request
    $fields = $request->validate([
        
        'email' => ['email', 'max:255', 'unique:users'],
        
    ]);

    
    // Fill the user model with validated fields
    $user->fill($fields);

    // Save the changes
    $user->save();

    return redirect()->route('home');
}

public function toggleRole(User $user, Request $request)
{
    
    // Toggle the is_admin status
    $user->is_admin = !$user->is_admin;
    $user->save();

    // Optionally, return a response or redirect back
    return redirect()->route('home');
}

public function updateAvatar(User $user, Request $request)
{
    
    

    $fields = $request->validate([
        'avatar' => ['file', 'nullable', 'max:300'],
        
    ]);

    if ($request->hasFile('avatar')) {
        $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
    }


    // Fill the user model with validated fields
    $user->fill($fields);

    // Save the changes
    $user->save();
    return redirect()->route('dashboard');
}


}
