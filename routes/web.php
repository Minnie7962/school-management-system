<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Authentication Routes
Auth::routes();

// Public Routes
Route::get('/', function () {
    return redirect('/login');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('students', App\Http\Controllers\Admin\StudentController::class);
    Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class);
    Route::resource('subjects', App\Http\Controllers\Admin\SubjectController::class);
    Route::resource('attendance', App\Http\Controllers\Admin\AttendanceController::class);
    Route::resource('marks', App\Http\Controllers\Admin\MarksController::class);
    Route::resource('notes', App\Http\Controllers\Admin\NotesController::class);
    Route::resource('noticeboard', App\Http\Controllers\Admin\NoticeboardController::class);
    Route::resource('buses', App\Http\Controllers\Admin\BusController::class);
    Route::resource('timetable', App\Http\Controllers\Admin\TimetableController::class);
    Route::resource('syllabus', App\Http\Controllers\Admin\SyllabusController::class);
    Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings');
});

// Owner Routes
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('owner.dashboard');
    Route::resource('payments', App\Http\Controllers\Owner\PaymentController::class);
    Route::resource('students', App\Http\Controllers\Owner\StudentController::class);
    Route::resource('teachers', App\Http\Controllers\Owner\TeacherController::class);
});

// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher.dashboard');
    Route::resource('attendance', App\Http\Controllers\Teacher\AttendanceController::class);
    Route::resource('leaves', App\Http\Controllers\Teacher\LeaveController::class);
    Route::resource('marks', App\Http\Controllers\Teacher\MarksController::class);
    Route::resource('notes', App\Http\Controllers\Teacher\NotesController::class);
    Route::resource('timetable', App\Http\Controllers\Teacher\TimetableController::class);
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/attendance', [App\Http\Controllers\Student\AttendanceController::class, 'index'])->name('student.attendance');
    Route::get('/bus-location', [App\Http\Controllers\Student\BusLocationController::class, 'index'])->name('student.bus-location');
    Route::resource('exams', App\Http\Controllers\Student\ExamController::class);
    Route::resource('fees', App\Http\Controllers\Student\FeeController::class);
    Route::get('/progress', [App\Http\Controllers\Student\ProgressController::class, 'index'])->name('student.progress');
    Route::get('/timetable', [App\Http\Controllers\Student\TimetableController::class, 'index'])->name('student.timetable');
});