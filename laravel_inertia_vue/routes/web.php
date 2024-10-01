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

    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');

    Route::get('/', function(Request $request) {
        return inertia('Home', [
            'users' => User::when($request->search, function($query) use ($request) {
                $query->where('name','like', '%'.$request->search.'%')
                ->orWhere('email','like', '%'.$request->search.'%');
            })->paginate(8)->withQueryString(),
            
            'searchTerm' => $request->search,
            
            'auth' => [
                'user' => [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'avatar' => $request->user()->avatar,
                    'is_admin'=>$request->user()->is_admin,
                ],
            ],
        ]);
        
    })->name('home');

    Route::get('/settings', function(Request $request) {
        return inertia('Settings', [
            'auth' => [
                'user' => [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'avatar' => $request->user()->avatar,
                    'is_admin'=>$request->user()->is_admin,
                ],
            ],
        ]);
    })->name('settings');

    // User profile edit
    Route::post('/settings/avatar', [UserProfileController::class, 'updateAvatar'])->name('settings_avatar.update');
    Route::patch('/settings/name', [UserProfileController::class, 'update'])->name('settings_name.update');
    Route::patch('/settings/email', [UserProfileController::class, 'emailUpdate'])->name('settings_email.update');
    Route::delete('/settings/delete', [UserProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function() {

    // Register
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Forgot password
    Route::get('/forgot-password', [ResetPasswordController::class, 'requestPass'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'])->name('password.update');
});

// Admin access
Route::middleware(['auth', Admin::class])->group(function () {
    Route::get('/home/{user}/edit', [AdminController::class, 'edit'])->name('user.edit');
    Route::post('/home/users/{user}/avatar', [AdminController::class, 'updateAvatar'])->name('user.updateAvatar');
    Route::patch('/home/users/{user}', [AdminController::class, 'update'])->name('user.update');
    Route::patch('/home/{user}/role', [AdminController::class, 'toggleRole'])->name('user.toggleRole');
    Route::patch('/home/users/{user}/email', [AdminController::class, 'updateEmail'])->name('user.updateEmail');
    Route::delete('/home/{user}', [AdminController::class, 'destroy'])->name('user.destroy');
});
