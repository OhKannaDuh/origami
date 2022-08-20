<?php

use App\Http\Controllers\Character\CopyController;
use App\Http\Controllers\Character\CreateController;
use App\Http\Controllers\Character\DeleteController;
use App\Http\Controllers\Character\IndexController;
use App\Http\Controllers\Character\UpdateController;
use App\Http\Controllers\Character\ViewController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('/character')->middleware(['auth', 'web'])->group(function (Router $router) {
    $router->controller(CopyController::class)->group(function (Router $router) {
        $router->post('/copy/{character}', 'copy')->name('character.copy.copy');
    });

    $router->controller(CreateController::class)->group(function (Router $router) {
        $router->get('/create', 'show')->name('character.create.show');
        $router->post('/create', 'store')->name('character.create.store');
    });

    $router->controller(DeleteController::class)->group(function (Router $router) {
        $router->post('/delete/{character}', 'delete')->name('character.delete.delete');
    });

    $router->controller(IndexController::class)->group(function (Router $router) {
        $router->get('/index', 'show')->name('character.index.show');
    });

    $router->controller(UpdateController::class)->group(function (Router $router) {
        $router->get('/update/{character}', 'show')->name('character.update.show');
        $router->post('/update/{character}', 'update')->name('character.update.update');
    });

    $router->controller(ViewController::class)->group(function (Router $router) {
        $router->get('/{character}', 'show')->name('character.view.show');
        $router->get('/{character}/{campaign}', 'campaign')->name('character.view.campaign');
    });
});
