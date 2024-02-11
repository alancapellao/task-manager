<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
        if (Auth::check()) {
                return to_route('dashboard');
        }

        return view('welcome');
})->name('welcome');

Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'show')->name('login');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'show')->name('register');
        Route::post('/register', 'register')->name('register');
})->middleware('guest');
