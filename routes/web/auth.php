<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function (Router $router) {
    $router->middleware('guest')->controller(LoginController::class)->group(function (Router $router) {
        $router->get('/login', 'show')->name('auth.login.show');
        $router->post('/login', 'login')->name('auth.login.login');
    });

    $router->middleware('auth')->controller(LogoutController::class)->group(function (Router $router) {
        $router->post('/logout', 'logout')->name('auth.logout.logout');
    });

    $router->controller(RegisterController::class)->group(function (Router $router) {
        $router->get('/register', 'show')->name('auth.register.show');
        $router->post('/register', 'register')->name('auth.register.register');
    });
});
