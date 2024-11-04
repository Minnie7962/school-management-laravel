<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\BusLocationController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Student\FeeController;
use App\Http\Controllers\Student\ProgressController;
use App\Http\Controllers\Student\TimetableController;

Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('student.dashboard');
    Route::get('attendance', [AttendanceController::class, 'index'])->name('student.attendance');
    Route::get('bus-location', [BusLocationController::class, 'index'])->name('student.bus-location');
    Route::get('exams', [ExamController::class, 'index'])->name('student.exams');
    Route::get('fees', [FeeController::class, 'index'])->name('student.fees');
    Route::get('progress', [ProgressController::class, 'index'])->name('student.progress');
    Route::get('timetable', [TimetableController::class, 'index'])->name('student.timetable');
});