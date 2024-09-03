<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // sleep(2);
    return Inertia::render('Home');
});

Route::inertia('/about', 'About', ['user' => 'Mike']);
