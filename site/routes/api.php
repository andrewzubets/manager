<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::middleware('web')->group(function () {
    Route::get('/csrf-token',function (){
        return csrf_token();
    });
});

Route::get('/questions', 'App\Http\Controllers\Api\QuestionController@index')->name('questions.index');
Route::post('/questions', 'App\Http\Controllers\Api\QuestionController@store')->name('questions.store');
Route::get('/questions/{questionId}', 'App\Http\Controllers\Api\QuestionController@show')->name('questions.show');
Route::put('/questions/{questionId}', 'App\Http\Controllers\Api\QuestionController@update')->name('questions.update');
Route::delete('/questions/{questionId}', 'App\Http\Controllers\Api\QuestionController@destroy')->name('questions.destroy');

Route::prefix('auth')->group(function (){
    Route::post('/login', AuthController::class.'@login')->middleware('web');
    Route::get('/user', AuthController::class.'@currentUser')->middleware(['auth','web']);
    Route::get('/logout', AuthController::class.'@logout')->middleware(['web']);
});

