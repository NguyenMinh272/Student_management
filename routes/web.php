<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SocialAuthController;
use Faker\Factory as Faker;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('welcome');
});


Route::resource('faculties', FacultyController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('students', StudentController::class);
Route::get('students/{student:slug}',[StudentController::class, 'show'])->name('students.slug');


Route::get('students/subjects/{student}',
    [StudentController::class, 'createSubject'])->name('students.subjects.createSubject');
Route::post('students/subjects',
    [StudentController::class, 'storeSubject'])->name('students.subjects.storeSubject');

Route::get('students/{student_id}/subjects/mark',
    [StudentController::class, 'createMark'])->name('students.subjects.createMark');
Route::post('students/{student_id}/subjects/save-mark',
    [StudentController::class, 'storeMark'])->name('students.subjects.storeMark');

Route::post('students/{student}/update', [StudentController::class, 'updateApi'])->name('student_update_api');

Route::get('mail/test',[MailController::class,'sendMail'])->name('students.sendMail');
Route::get('redirect/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('login/callback/{provider}', [SocialAuthController::class,'callback']);

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('Language')->get('change-language/{locale}',[App\Http\Controllers\HomeController::class, 'setLocale'])->name('locale');

Auth::routes();
