<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FixtureController;
use App\Http\Controllers\Api\JournalistController;
use App\Http\Controllers\Api\Match_eventsController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/{admin}', [AdminController::class, 'show']);
        Route::post('/', [AdminController::class, 'store']);
        Route::put('/{admin}', [AdminController::class, 'update']);
        Route::delete('/{admin}', [AdminController::class, 'delete']);
    });
    Route::prefix('jour')->group(function () {
        Route::get('/', [JournalistController::class, 'index']);
        Route::get('/{jour}', [JournalistController::class, 'show']);
        Route::post('/', [JournalistController::class, 'store']);
        Route::put('/{jour}', [JournalistController::class, 'update']);
        Route::delete('/{jour}', [JournalistController::class, 'delete']);
    });
    Route::prefix('player')->group(function () {
        Route::get('/', [PlayerController::class, 'index']);
        Route::get('/{player}', [PlayerController::class, 'show']);
        Route::post('/', [PlayerController::class, 'store']);
        Route::put('/{player}', [PlayerController::class, 'update']);
        Route::delete('/{player}', [PlayerController::class, 'delete']);
    });
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index']);
        Route::get('/showNews/{news}', [NewsController::class, 'show']);
        Route::get('/jourNews/{jour}', [NewsController::class, 'newsOfJournalist']);
        Route::post('/', [NewsController::class, 'store']);
        Route::post('/{news}', [NewsController::class, 'update']);
        Route::delete('/news-images/{newsImage}', [NewsController::class, 'deleteNewsImages']);
        Route::delete('/{news}', [NewsController::class, 'deleteNews']);
    });
    Route::prefix('fixture')->group(function () {
        Route::get('/', [FixtureController::class, 'index']);
        Route::get('/{fixture}', [FixtureController::class, 'show']);
        Route::post('/', [FixtureController::class, 'store']);
        Route::put('/upcomingFixture/{fixture}', [FixtureController::class, 'updateUpcomingFixture']);
        Route::put('/start/{fixture}', [FixtureController::class, 'start']);
        Route::put('/finish/{fixture}', [FixtureController::class, 'finish']);
    });
    Route::prefix('matchEvent')->group(function () {
        Route::post('/store/{fixture}',[Match_eventsController::class,'store']);
    });
});
