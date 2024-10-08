<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // delete user
    public function destroy(User $user) {
        
        $user->delete();
        return redirect()->route('home');
    }

    // Pass user component to admin edit
    public function edit(User $user){
        return inertia('AdminEdit', [
            'user' => $user,
        ]);
    }
    public function update(Request $request, User $user)
    {

        // Validate inputs
        $fields = $request->validate([
            'name' => ['max:255'],
        ]);

        // Fill the user model with validated fields
        $user->fill($fields);

        // Save the changes
        $user->save();

        // Redirect
        return redirect()->route('home')->with('success', 'Profile updated successfully!');
    }
    
    public function updateAvatar(User $user, Request $request)
    {
        // Validate the inputs
        $fields = $request->validate([
            'avatar' => ['file', 'nullable', 'max:300'],
        ]);

        // Store the avatar
        if ($request->hasFile('avatar')) {
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        // Fill the user model with validated fields
        $user->fill($fields);

        // Save the changes
        $user->save();

        // Redirect
        return redirect()->route('dashboard');
    }

    public function updateEmail(Request $request, User $user)
    {
        // Validate inputs
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

        // Redirect
        return redirect()->route('home');
    }

    public function createNewUser(Request $request) {

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

        
        // Redirect
        return redirect()->route('home');
        
    }
}
