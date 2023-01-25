<?php

use App\Http\Controllers\School\IndexController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('/schools')->middleware(['web'])->group(function (Router $router) {
    $router->controller(IndexController::class)->group(function (Router $router) {
        $router->get('/index', 'show')->name('school.index.show');
    });
});
