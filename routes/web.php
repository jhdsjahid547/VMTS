<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'role:admin', 'verified',])->name('admin.')->prefix('o')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
    Route::resource('course', CourseController::class)->except(['show', 'edit', 'update']);
    Route::get('/student', [StudentController::class, 'index'])->name('student.list');
    Route::get('/teacher', [StudentController::class, 'index'])->name('teacher.list');
    Route::post('/course-info', [StudentController::class, 'showData'])->name('show.info');
    Route::post('/student-status', [StudentController::class, 'changeStatus'])->name('student.status');
    Route::post('/student-submit', [StudentController::class, 'submit'])->name('student.submit');
    Route::delete('/student-remove', [StudentController::class, 'destroy'])->name('student.remove');
});
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'role:creator', 'verified',])->name('creator.')->prefix('e')->group(function () {
   Route::get('/exam-panel', [CreatorController::class, 'index'])->name('index');

});
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'role:subscriber', 'verified',])->name('subscriber.')->prefix('v')->group(function () {
    Route::get('/available-exams', [SubscriberController::class, 'index'])->name('index');
});

