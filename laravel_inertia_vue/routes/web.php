<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;






Route::middleware('auth')->group(function() {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
    
    Route::get('/settings', function(Request $request) {
        return inertia('Settings', [
            'auth' => [
                'user' => [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'avatar' => $request->user()->avatar,
                ],
            ],
        ]);
    })->name('settings');

    
        // For updating email
    Route::patch('/settings/email', [UserProfileController::class, 'emailUpdate'])->name('settings_email.update');

    // For updating name
    Route::patch('/settings/name', [UserProfileController::class, 'update'])->name('settings_name.update');

    Route::post('/settings/avatar', [UserProfileController::class, 'updateAvatar'])->name('settings_avatar.update');


    Route::delete('/settings', [UserProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', function(Request $request) {
        return inertia('Home', [
            'users' => User::when($request->search, function($query) use ($request) {
                $query->where('name','like', '%'.$request->search.'%')
                      ->orWhere('email','like', '%'.$request->search.'%');
            })->paginate(8)->withQueryString(),
            
            'searchTerm' => $request->search,
            'can' => [
                'delete_user' => Auth::user() ? Auth::user()->can('delete', User::class) : null,
            ],
        ]);
        
    })->name('home');
    
    

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    
});

Route::middleware('guest')->group(function() {
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/forgot-password', [ResetPasswordController::class, 'requestPass'])->name('password.request');

    Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'])->name('password.update');
});

Route::middleware(['auth', Admin::class])->group(function () {
    Route::patch('/home/{user}/role', [AdminController::class, 'toggleRole'])->name('user.toggleRole');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/home/{user}', [AdminController::class, 'destroy'])->name('user.destroy');
    
    Route::get('/home/{user}/edit', [AdminController::class, 'edit'])->name('user.edit');
    
    Route::patch('/home/users/{user}', [AdminController::class, 'update'])->name('user.update');
    Route::patch('/home/users/{user}/email', [AdminController::class, 'updateEmail'])->name('user.updateEmail');
    Route::post('/home/users/{user}/avatar', [AdminController::class, 'updateAvatar'])->name('user.updateAvatar');
    
});
