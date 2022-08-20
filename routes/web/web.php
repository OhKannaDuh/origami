<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::routes(['reset' => false, 'verify' => false]);

Route::get('/', [IndexController::class, 'show'])->name('index.show');
