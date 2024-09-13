<?php

use Illuminate\Support\Facades\Route;

Route::get('/questions', 'App\Http\Controllers\Api\QuestionController@index')->name('questions.index');
