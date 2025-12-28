<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarReturnController;
use App\Http\Controllers\PenaltiesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RentController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
    Route::apiResource('registers', RegisterController::class);
    Route::apiResource('cars', CarController::class);
    Route::apiResource('rents', RentController::class);
    Route::apiResource('penalties', PenaltiesController::class);
    Route::apiResource('return', CarReturnController::class);
});
