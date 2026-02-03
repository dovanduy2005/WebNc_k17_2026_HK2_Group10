<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/auth', function () {
    return view('auth');
})->name('login');

// The following routes are placeholders or removed because the backend was removed.
// Route::get('/cars', ...);
// Route::get('/profile', ...);
// Route::prefix('admin')...
