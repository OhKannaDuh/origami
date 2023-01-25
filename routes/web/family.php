<?php

use App\Http\Controllers\Family\IndexController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('/families')->middleware(['web'])->group(function (Router $router) {
    $router->controller(IndexController::class)->group(function (Router $router) {
        $router->get('/index', 'show')->name('family.index.show');
    });
});
