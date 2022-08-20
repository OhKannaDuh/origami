<?php

use App\Http\Controllers\SourceBook\IndexController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('/source-book')->middleware(['web'])->group(function (Router $router) {
    $router->controller(IndexController::class)->group(function (Router $router) {
        $router->get('/index', 'show')->name('source-book.index.show');
    });
});
