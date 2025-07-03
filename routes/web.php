<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\{
    AdminDashboardController,
    UserController,
    SemesterController,
    CourseController,
    DepartmentController,
    AssignmentController,
    SettingController
};

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Authenticated User Routes
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🧑‍🎓 Student Dashboard
    // middleware(['role:student'])->
    Route::prefix('/student')->group(function () {
        Route::get('/dashboard', function () {
            return view('student.dashboard');
        })->name('student.dashboard');
    });

    // 👨‍🏫 Teacher Dashboard
    Route::middleware('role:teacher')->group(function () {
        Route::get('/teacher/dashboard', function () {
            return view('teacher.dashboard');
        })->name('teacher.dashboard');
    });

    // 🧑‍💼 Admin Routes + Dashboard
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('semesters', SemesterController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('assignments', AssignmentController::class);
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    });
});

// Default dashboard route (fallback or non-role specific)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
