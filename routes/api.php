<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Tasks\TaskController;
use App\Http\Controllers\Api\Tasks\TaskStatisticsController;
use App\Http\Controllers\Api\Tasks\TaskStatusController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register','register');
    Route::post('/login','login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout','logout');
        Route::get('/profile','profile');
    });
    Route::apiResource('tasks', TaskController::class);
    Route::patch('tasks/{task}/status',[TaskStatusController::class, 'update']);
    Route::get('tasks-statistics',[TaskStatisticsController::class, 'index']);
});
