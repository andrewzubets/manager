<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-stub-1', fn () => 'test-stub-1 response.')->name('test-stub-1');
Route::get('/test-stub-2', fn () => 'test-stub-2 response.')->name('test-stub-2');
Route::get('/test-stub-arg/{id}', fn ($id) => 'test-stub-arg response: '.$id)->name('test-stub-arg');
