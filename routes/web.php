<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login-view', [AuthController::class, 'create'])->name('auth.login-view');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/players', [PlayerController::class, 'index'])->name('admin.players');
        Route::get('/add_players', [PlayerController::class, 'create'])->name('admin.players.create');
        Route::post('/store_players', [PlayerController::class, 'store'])->name('admin.players.store');
        Route::get('/show_players/{player}', [PlayerController::class, 'show'])->name('admin.players.show');
        Route::get('/edit_players/{player}', [PlayerController::class, 'edit'])->name('admin.players.edit');
        Route::put('/update_players/{player}', [PlayerController::class, 'update'])->name('admin.players.update');
        Route::delete('/delete_players/{player}', [PlayerController::class, 'destroy'])->name('admin.players.delete');

        Route::get('/news', [NewsController::class, 'index'])->name('admin.news');
    });
});
