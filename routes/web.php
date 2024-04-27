<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ScheduleController;
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
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/create_course', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/create_course', [CourseController::class, 'store'])->name('courses.store');

    Route::post('/schedule/addCourse', [ScheduleController::class, 'addCourse'])->name('schedule.addCourse');
    Route::get('/semesters', [ScheduleController::class, 'semesters'])->name('schedule.semesters');
    Route::get('/add_semester', [ScheduleController::class, 'addSemester'])->name('schedule.addSemester');
    Route::post('/store_semester', [ScheduleController::class, 'storeSemester'])->name('schedule.storeSemester');
});

