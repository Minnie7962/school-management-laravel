<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\MarksController;
use App\Http\Controllers\Admin\NotesController;
use App\Http\Controllers\Admin\NoticeboardController;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\TimetableController;
use App\Http\Controllers\Admin\SyllabusController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::resource('marks', MarksController::class);
    Route::resource('notes', NotesController::class);
    Route::resource('noticeboard', NoticeboardController::class);
    Route::resource('buses', BusController::class);
    Route::resource('timetable', TimetableController::class);
    Route::resource('syllabus', SyllabusController::class);
});