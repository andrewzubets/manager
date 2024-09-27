<?php

use Illuminate\Support\Facades\Route;

Route::get('/questions', 'App\Http\Controllers\Api\QuestionController@index')->name('questions.index');
Route::post('/questions', 'App\Http\Controllers\Api\QuestionController@store')->name('questions.store');
Route::get('/questions/{question}', 'App\Http\Controllers\Api\QuestionController@show')->name('questions.show');
Route::put('/questions/{question}', 'App\Http\Controllers\Api\QuestionController@update')->name('questions.update');
Route::delete('/questions/{question}', 'App\Http\Controllers\Api\QuestionController@destroy')->name('questions.destroy');
