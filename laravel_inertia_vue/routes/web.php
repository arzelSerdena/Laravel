<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Authenticated user access
Route::middleware('auth')->group(function() {

    // Inertia route for the dashboard, accessible to authenticated users
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');

    // Home route that lists users with optional search functionality
    Route::get('/', function(Request $request) {
        return inertia('Home', [
            // Fetch users with search query if provided, paginate results with 8 users per page
            'users' => User::when($request->search, function($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%');
            })->paginate(8)->withQueryString(),

            // Pass search term back to the view for display or further use
            'searchTerm' => $request->search,

            // Pass authenticated user data to the view
            'auth' => [
                'user' => [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'avatar' => $request->user()->avatar,
                    'is_admin' => $request->user()->is_admin,
                ],
            ],
        ]);
    })->name('home');

    // Settings page route to display user profile information
    Route::get('/settings', function(Request $request) {
        return inertia('Settings', [
            // Pass authenticated user data to the settings view
            'auth' => [
                'user' => [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'avatar' => $request->user()->avatar,
                    'is_admin' => $request->user()->is_admin,
                ],
            ],
        ]);
    })->name('settings');

    // Routes to update user profile information (avatar, name, email) or delete profile
    Route::post('/settings/avatar', [UserProfileController::class, 'updateAvatar'])->name('settings_avatar.update');
    Route::patch('/settings/name', [UserProfileController::class, 'update'])->name('settings_name.update');
    Route::patch('/settings/email', [UserProfileController::class, 'emailUpdate'])->name('settings_email.update');
    Route::delete('/settings/delete', [UserProfileController::class, 'destroy'])->name('profile.destroy');

    // Route to handle user logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Guest access (for unauthenticated users)
Route::middleware('guest')->group(function() {

    // Registration page and form submission
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login page and form submission
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Forgot password and reset routes
    Route::get('/forgot-password', [ResetPasswordController::class, 'requestPass'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'])->name('password.update');
});

// Admin access, restricted to authenticated users with the admin role
Route::middleware(['auth', Admin::class])->group(function () {
    // Admin route to edit user profile
    Route::get('/home/{user}/edit', [AdminController::class, 'edit'])->name('user.edit');

    // Admin route to update user avatar
    Route::post('/home/users/{user}/avatar', [AdminController::class, 'updateAvatar'])->name('user.updateAvatar');

    // Admin route to update user profile information (name, email)
    Route::patch('/home/users/{user}', [AdminController::class, 'update'])->name('user.update');
    Route::patch('/home/{user}/role', [AdminController::class, 'toggleRole'])->name('user.toggleRole');
    Route::patch('/home/users/{user}/email', [AdminController::class, 'updateEmail'])->name('user.updateEmail');

    // Admin route to delete a user
    Route::delete('/home/{user}', [AdminController::class, 'destroy'])->name('user.destroy');
});
