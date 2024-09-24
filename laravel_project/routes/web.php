<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::middleware("auth")->group(function(){
    Route::get('/profile',[UserController::class, 'profile'])->name('profile');
    Route::get('/userSettings',[UserController::class, 'userSettings'])->name('userSettings');
    Route::get('/userDashboard',[UserController::class, 'userDashboard'])->name('userDashboard');
    Route::get('/adminDashboard',[UserController::class, 'adminDashboard'])->name('adminDashboard');
});

Route::get('/',[UserController::class, 'index'])->name('index');
Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class, 'loginPost'])->name('login.post');

Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class, 'registerPost'])->name('register.post');

