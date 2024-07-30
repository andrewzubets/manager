<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('test');
})->name('home');

Route::get('/bootstrap-test', function () {
    return view('bootstrap-test');
})->name('bootstrap-test');

if (config('app.env') === 'testing') {
    include base_path('routes/test/web.php');
}
