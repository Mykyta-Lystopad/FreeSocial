<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// for authentication
Route::post('register', [AuthController::class, 'register']);

Route::post('verify_code', [AuthController::class, 'verifyCode']);
Route::post('login', [AuthController::class, 'login']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    //user
    Route::apiResource('user', UserController::class)->except('store');

});
