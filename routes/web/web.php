<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::routes(['reset' => false, 'verify' => false]);

Route::get('/', [IndexController::class, 'show'])->name('index.show');
Route::get('/parsed-techniques', function () {
    $techniques = json_decode(file_get_contents(base_path('data/exports/parsed-techniques.json')), true);
    return view('parsed-techniques', [
        'techniques' => $techniques,
    ]);
});
