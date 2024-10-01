<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
        // Show the forgot password form
    public function requestPass()
    {
        // Render the ForgotPassword Inertia view, passing the session status if it exists
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status')
        ]);
    }

    // Handle the request to send a password reset email
    public function sendEmail(Request $request) {
        // Validate the email field to ensure it is required and has a valid email format
        $request->validate(['email' => 'required|email']);
    
        // Attempt to send the reset link to the provided email address
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        // Check if the reset link was successfully sent
        return $status === Password::RESET_LINK_SENT
                    // If successful, redirect back with a status message
                    ? back()->with(['status' => __($status)])
                    // Otherwise, redirect back with an error message
                    : back()->withErrors(['email' => __($status)]);
    }

    // Show the reset password form
    public function resetForm(Request $request) {
        // Render the ResetPassword Inertia view, passing the email and token for the reset link
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token')
        ]);
    }

    // Handle the password reset form submission
    public function resetHandler(Request $request) {
        // Validate the form input to ensure token, email, and new password (with confirmation) are provided
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        // Attempt to reset the user's password
        $status = Password::reset(
            // Extract necessary fields from the request (email, password, confirmation, token)
            $request->only('email', 'password', 'password_confirmation', 'token'),
            // Callback function to handle password reset
            function (User $user, string $password) {
                // Update the user's password securely
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
        
                $user->save();
        
                // Trigger the password reset event
                event(new PasswordReset($user));
            }
        );
        
        // Check if the password was successfully reset
        return $status === Password::PASSWORD_RESET
                    // If successful, redirect to the login page with a status message
                    ? redirect()->route('login')->with('status', __($status))
                    // Otherwise, redirect back with an error message
                    : back()->withErrors(['email' => [__($status)]]);
    }

}
