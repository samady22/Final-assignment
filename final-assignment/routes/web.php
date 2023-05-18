<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::prefix('teacher')->middleware(['auth', 'isTeacher'])->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('teacher');

    //here
});
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::post('/questions/get-random-question', [QuestionController::class, 'getRandomQuestion'])->name('getRandomQuestion');
Route::post('/assignments/update', [QuestionController::class, 'update'])->name('assignments.update');






