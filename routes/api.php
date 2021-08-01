<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// for authentication
Route::post('login', [AuthController::class, 'login']);
Route::post('verify_code', [AuthController::class, 'verifyCode']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    //user
    Route::apiResource('user', UserController::class)->except('store');

    //event
    Route::apiResource('event', EventController::class);
});
