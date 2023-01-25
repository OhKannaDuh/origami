<?php

use App\Http\Controllers\Clan\IndexController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('/clans')->middleware(['web'])->group(function (Router $router) {
    $router->controller(IndexController::class)->group(function (Router $router) {
        $router->get('/index', 'show')->name('clan.index.show');
    });
});
