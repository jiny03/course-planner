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

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AccountController::class, 'logout'])->name('account.logout');

    // courses
    Route::get('/create_course', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/create_course', [CourseController::class, 'store'])->name('courses.store');
    Route::post('/schedule/addCourse/{courseId}', [ScheduleController::class, 'addCourse'])->name('schedule.addCourse');
    Route::post('/userCourses/{userCourse}/delete', [ScheduleController::class, 'deleteCourse'])->name('schedule.deleteCourse');

    // course comments
    Route::get('/courses/view_comments/{userCourse}', [CourseController::class, 'viewComments'])->name('courses.viewComments');
    Route::post('/courses/add_comment/{userCourse}', [CourseController::class, 'addComment'])->name('courses.addComment');
    Route::get('/comments/edit/{comment}', [CourseController::class, 'editComment'])->name('comments.edit');
    Route::post('/comments/update/{comment}', [CourseController::class, 'updateComment'])->name('comments.update');
    Route::post('/comments/delete/{comment}', [CourseController::class, 'deleteComment'])->name('comments.delete');

    // account schedule (current semester) and favorites
    Route::get('/schedule', [AccountController::class, 'schedule'])->name('account.schedule');
    Route::get('/favorites', [AccountController::class, 'favorites'])->name('account.favorites');
    Route::post('/add_favorites/{courseId}', [AccountController::class, 'addFavorites'])->name('account.addFavorites');
    Route::post('/delete_favorites/{courseId}', [AccountController::class, 'deleteFavorite'])->name('account.deleteFavorite');

    // semesters and semesters schedule
    Route::get('/schedule/viewSemester/{semester}', [ScheduleController::class, 'viewSemester'])->name('schedule.viewSemester');
    Route::get('/add_semester', [ScheduleController::class, 'addSemester'])->name('schedule.addSemester');
    Route::get('/semesters', [ScheduleController::class, 'semesters'])->name('schedule.semesters');
    Route::post('/store_semester', [ScheduleController::class, 'storeSemester'])->name('schedule.storeSemester');
    Route::post('/semesters/{semester}/set-default', [ScheduleController::class, 'setDefaultSemester'])->name('schedule.setDefaultSemester');
    Route::post('/semesters/{semester}/delete', [ScheduleController::class, 'deleteSemester'])->name('schedule.deleteSemester');
});

