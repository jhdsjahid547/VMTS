<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
/*use App\Http\Controllers\CreatorController;*/
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ManageExamController;

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
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.list');
    Route::post('/course-info', [UserController::class, 'showData'])->name('show.info');
    Route::post('/user-status', [UserController::class, 'changeStatus'])->name('user.status');
    Route::post('/submit-student', [UserController::class, 'submit'])->name('student.submit');
    Route::post('/submit-teacher', [UserController::class, 'submit'])->name('teacher.submit');
    Route::delete('/user-remove', [UserController::class, 'destroy'])->name('user.remove');
    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
/*  Route::post('/setting/create', [SettingController::class, 'create'])->name('setting.create');
    Route::get('/setting/list', [SettingController::class, 'list'])->name('setting.list');*/
    Route::post('/setting/{id}', [SettingController::class, 'update'])->name('setting.update');
    Route::post('/setting/create/value', [SettingController::class, 'settingPropertyCreate'])->name('setting.property.create');
    Route::delete('/setting/delete/property/{id}', [SettingController::class, 'propertyDestroy'])->name('setting.property.delete');
});
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'role:creator', 'verified',])->name('creator.')->prefix('e')->group(function () {
   Route::get('/exam-panel', [ExamController::class, 'index'])->name('index');
   Route::post('/exam-submit', [ExamController::class, 'examSubmit'])->name('exam.submit');
   Route::get('/exam-manage/{id}', [ExamController::class, 'manage'])->name('exam.manage');
   Route::post('/exam-activity/{id}', [ExamController::class, 'examActivity'])->name('exam.activity');
   Route::delete('/exam-delete/{id}', [ExamController::class, 'distroy'])->name('exam.distroy');
   Route::patch('/exam-update/{id}', [ManageExamController::class, 'update'])->name('exam.update');
   Route::post('/question-submit', [ManageExamController::class, 'createQuestion'])->name('question.submit');
   Route::get('/question-show/{id}', [ManageExamController::class, 'showUpdateQuestion'])->name('question.show');
   Route::get('/question-set/{id}', [ManageExamController::class, 'questionSet'])->name('question.set');
   Route::delete('/question-delete/{id}', [ManageExamController::class, 'distroy'])->name('question.distroy');
});
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'role:subscriber', 'verified',])->name('subscriber.')->prefix('v')->group(function () {
    Route::get('/available-exams', [SubscriberController::class, 'index'])->name('index');
});
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->prefix('user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('user.profile');
    Route::post('/profile/{id}', [ProfileController::class, 'submit'])->name('user.profile.update');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('user.password.change');
    Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('user.password.update');
});

