<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\PaymentController;
use App\Http\Controllers\Owner\StudentController;
use App\Http\Controllers\Owner\TeacherController;

Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');
    Route::resource('payments', PaymentController::class);
    Route::get('students', [StudentController::class, 'index'])->name('owner.students');
    Route::get('teachers', [TeacherController::class, 'index'])->name('owner.teachers');
});