<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/bootstrap-test', function () {
    return view('bootstrap-test');
})->name('bootstrap-test');

// Vue simple routes.
$vueRoutes = include 'vue.php';
foreach ($vueRoutes as $uri => $vueRoute) {
    [$actionName, $alias] = $vueRoute;
    Route::get($uri, HomeController::class.'@'.$actionName)->name($alias);
}
