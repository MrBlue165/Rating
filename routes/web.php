<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;


Route::get('/home', function () {
    return Inertia::render('Home', [
        'title' => 'Home',
    ]);
});
Route::get('/register', function () {
    return Inertia::render('Register');
});
Route::get('/', function () {
    return Inertia::render('Login');
});
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/session', [SessionController::class, 'getSessionData']);
