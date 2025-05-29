<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'store']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate']);
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/logout', function () {
    return redirect()->route('register');
});
