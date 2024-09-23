<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/',[UserController::class, 'index'])->name('index');
Route::get('/login',[UserController::class, 'login'])->name('login');
Route::get('/register',[UserController::class, 'register'])->name('register');
Route::get('/profile',[UserController::class, 'profile'])->name('profile');
Route::get('/userSettings',[UserController::class, 'userSettings'])->name('userSettings');