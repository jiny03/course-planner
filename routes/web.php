<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/login');
});

Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::get('/login', [AccountController::class, 'loginForm'])->name('login');
Route::post('/login', [AccountController::class, 'login'])->name('account.login');

// use auth middleware for login and logout functions
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('account.profile');
});
