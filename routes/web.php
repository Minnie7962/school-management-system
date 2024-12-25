<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\OwnerController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/register', 'register')->name('register');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/attendance', [AdminController::class, 'attendance'])->name('admin.attendance');
    Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
    Route::get('/teachers', [AdminController::class, 'teachers'])->name('admin.teachers');
    Route::get('/subjects', [AdminController::class, 'subjects'])->name('admin.subjects');
    Route::get('/marks', [AdminController::class, 'marks'])->name('admin.marks');
    Route::get('/notes', [AdminController::class, 'notes'])->name('admin.notes');
    Route::get('/noticeboard', [AdminController::class, 'noticeboard'])->name('admin.noticeboard');
    Route::get('/timetable', [AdminController::class, 'timetable'])->name('admin.timetable');
    Route::get('/syllabus', [AdminController::class, 'syllabus'])->name('admin.syllabus');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    // Additional Routes
    Route::get('/search-function', [AdminController::class, 'searchFunction'])->name('admin.search.function');
    Route::post('/verify-role-redirect', [AdminController::class, 'verifyRoleRedirect'])->name('admin.verify.role.redirect');
});

// Student Routes
Route::prefix('student')->middleware(['auth', 'check.role:student'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/fee-payment', [StudentController::class, 'feePayment'])->name('student.fee.payment');
    Route::get('/progress', [StudentController::class, 'progress'])->name('student.progress');
    Route::get('/exam', [StudentController::class, 'exam'])->name('student.exam');
    Route::get('/timetable', [StudentController::class, 'timetable'])->name('student.timetable');
});

// Owner Routes
Route::prefix('owner')->middleware(['auth', 'check.role:owner'])->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    Route::get('/change-password', [OwnerController::class, 'changePassword'])->name('owner.change.password');
    Route::get('/notices', [OwnerController::class, 'notices'])->name('owner.notices');
    Route::get('/payments', [OwnerController::class, 'payments'])->name('owner.payments');
    Route::get('/student-list', [OwnerController::class, 'studentList'])->name('owner.student.list');
    Route::get('/teacher-list', [OwnerController::class, 'teacherList'])->name('owner.teacher.list');
    Route::get('/payment', [OwnerController::class, 'seePayment'])->name('owner.payment');
    Route::post('/logout', [OwnerController::class, 'logout'])->name('owner.logout');
});

// Teacher Routes
Route::prefix('teacher')->middleware(['auth', 'check.role:teacher'])->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/attendance', [TeacherController::class, 'attendance'])->name('teacher.attendance');
    Route::get('/leaves', [TeacherController::class, 'leaves'])->name('teacher.leaves');
    Route::get('/marks', [TeacherController::class, 'marks'])->name('teacher.marks');
    Route::get('/notes', [TeacherController::class, 'notes'])->name('teacher.notes');
    Route::get('/timetable', [TeacherController::class, 'timetable'])->name('teacher.timetable');
    Route::get('/settings', [TeacherController::class, 'settings'])->name('teacher.settings');
});
