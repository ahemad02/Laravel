<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/test", function () {
    return ["name" => "ahemad", "age" => 20];
});

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/students', [StudentController::class, 'list']);

    Route::post('/add', [StudentController::class, 'addStudent']);

    Route::put('/update', [StudentController::class, 'updateStudent']);

});

Route::post('/signup', [UserAuthController::class, 'signup']);

Route::post('/login', [UserAuthController::class, 'login']);
