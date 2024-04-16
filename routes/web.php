<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerQuestionController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/ask', [IndexController::class, 'ask'])->name('ask');
Route::post('/ask/store', [QuestionController::class, 'store'])->name('ask.store');

Route::get('/answer/{questionId}', [IndexController::class, 'answerQuestion'])->name('answer');
Route::post('/answer/{questionId}', [IndexController::class, 'answerQuestion'])->name('answer');
Route::get('/answer/{questionId}', [AnswerQuestionController::class, 'showQuestion'])->name('answer.show');
Route::post('/answer', [AnswerQuestionController::class, 'store'])->name('answer.store');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
