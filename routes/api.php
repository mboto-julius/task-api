<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Tasks\DailyLogController;
use App\Http\Controllers\Api\Tasks\SubtaskController;
use App\Http\Controllers\Api\Tasks\TaskController;
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

    Route::controller(SubtaskController::class)->group(function () {
        Route::get('tasks/{task}/subtasks', 'index');
        Route::post('tasks/{task}/subtasks', 'store');
    });
    Route::apiResource('subtasks', SubtaskController::class)->except(['index', 'store']);


    Route::controller(DailyLogController::class)->group(function () {
        Route::get('subtasks/{subtask}/logs', 'index');
        Route::post('subtasks/{subtask}/logs', 'store');
    });
    Route::apiResource('logs', DailyLogController::class)->except(['index', 'store']);
});

