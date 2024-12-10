<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/auth')->group(function() {
    Route::get('/login', function() {
        return view('pages.auth.login');
    });
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
});