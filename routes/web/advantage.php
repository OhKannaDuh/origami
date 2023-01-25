<?php

use App\Http\Controllers\Advantage\IndexController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('/advantages')->middleware(['web'])->group(function (Router $router) {
    $router->controller(IndexController::class)->group(function (Router $router) {
        $router->get('/index', 'show')->name('advantage.index.show');
    });
});
