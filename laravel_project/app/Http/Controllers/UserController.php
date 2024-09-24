<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('index');
    }

    public function register(){
        return view('register');
    }

    public function profile(){
        return view('profile');
    }

    public function userSettings(){
        return view('userSettings');
    }

    public function userDashboard(){
        return view('userDashboard');
    }

    public function adminDashboard(){
        return view('adminDashboard');
    }
}
