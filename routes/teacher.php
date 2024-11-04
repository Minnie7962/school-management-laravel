<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\MarksController;
use App\Http\Controllers\Teacher\NotesController;
use App\Http\Controllers\Teacher\LeaveController;

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('teacher.dashboard');
    Route::resource('attendance', AttendanceController::class);
    Route::resource('marks', MarksController::class);
    Route::resource('notes', NotesController::class);
    Route::resource('leaves', LeaveController::class);
});