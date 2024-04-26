<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/login');
});

Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::get('/login', [AccountController::class, 'loginForm'])->name('login');
Route::post('/login', [AccountController::class, 'login'])->name('account.login');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::get('/schedule', [AccountController::class, 'schedule'])->name('account.schedule');
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/create_course', [CourseController::class, 'create'])->name('courses.create');
Route::post('/create_course', [CourseController::class, 'store'])->name('courses.store');

Route::get('/schedule/addCourse', [ScheduleController::class], 'addCourse')->name('schedule.addCourse');
