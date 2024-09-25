<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

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
        
        'name' => ['sometimes', 'max:255'],
        
    ]);

    // If an avatar is uploaded, handle the file upload
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars'); // Adjust the storage path as needed
        $fields['avatar'] = $path; // Include the avatar path in the fields to update
    }

    // Fill the user model with validated fields
    $user->fill($fields);

    // Save the changes
    $user->save();

    return redirect()->route('settings.update')->with('success', 'Profile updated successfully!');
}
}
