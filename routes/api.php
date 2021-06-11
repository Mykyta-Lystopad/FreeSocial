<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// for authentication
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::post('login', [AuthController::class, 'login'])->name('login');



Route::group(['middleware' => ['auth:sanctum']], function () {
    //user
    Route::apiResource('user', UserController::class)->except('store');

});
