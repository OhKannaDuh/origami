<?php

use App\Http\Controllers\Campaign\ConflictController;
use App\Http\Controllers\Campaign\CreateController;
use App\Http\Controllers\Campaign\DeleteController;
use App\Http\Controllers\Campaign\IndexController;
use App\Http\Controllers\Campaign\JoinController;
use App\Http\Controllers\Campaign\OverviewController;
use App\Http\Controllers\Campaign\UpdateController;
use App\Http\Controllers\Campaign\ViewController;
use Illuminate\Routing\Router;

assert($router instanceof Router);
$router->prefix('/campaign')->middleware(['auth', 'web'])->group(function (Router $router) {
    $router->controller(ConflictController::class)->group(function (Router $router) {
        $router->get('/conflict/{campaign}', 'show')->name('campaign.conflict.show');
    });

    $router->controller(CreateController::class)->group(function (Router $router) {
        $router->get('/create', 'show')->name('campaign.create.show');
        $router->post('/create', 'create')->name('campaign.create.create');
    });

    $router->controller(DeleteController::class)->group(function (Router $router) {
        $router->post('/delete/{campaign:uuid}', 'delete')->name('campaign.delete.delete');
    });

    $router->controller(IndexController::class)->group(function (Router $router) {
        $router->get('/index', 'show')->name('campaign.index.show');
    });

    $router->controller(JoinController::class)->group(function (Router $router) {
        $router->get('/join/{campaign:uuid}', 'join')->name('campaign.join.join');
    });

    $router->controller(OverviewController::class)->group(function (Router $router) {
        $router->get('/overview/{campaign}', 'show')->name('campaign.overview.show');
    });

    $router->controller(UpdateController::class)->group(function (Router $router) {
        $router->post('/update/{campaign:uuid}', 'update')->name('campaign.update.update');
        $router->post('/add/{campaign}/{character}', 'add')->name('campaign.update.add');
        $router->post('/remove/{campaign}/{character}', 'remove')->name('campaign.update.remove');
    });

    $router->controller(ViewController::class)->group(function (Router $router) {
        $router->get('/{campaign}', 'show')->name('campaign.view.show');
    });
});
