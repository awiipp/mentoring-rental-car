<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
    Route::apiResource('registers', RegisterController::class);
});
