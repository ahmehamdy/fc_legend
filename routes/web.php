<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchEventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public Views
Route::get('/',[HomeController::class,'index'])->name('home');


Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/login-view', [AuthController::class, 'create'])->name('auth.login-view');
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register-view', [AuthController::class, 'registerView'])->name('auth.register-view');

Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::get('/edit-profile',[ProfileController::class,'edit'])->name('edit.profile');
    Route::put('/update-profile',[ProfileController::class,'update'])->name('update.profile');

    Route::get('/players', function () {
        return view('players');
    })->name('players');

    Route::get('/legends', function () {
        return view('legends');
    })->name('legends');

    Route::get('/players/{player}', function ($player) {
        return view('player', compact('player'));
    })->name('players.show');

    Route::get('/matches', [FixtureController::class, 'index'])->name('matches');

    Route::get('/matches/{fixture}', [FixtureController::class, 'show'])->name('matches.show');

    // Route::get('/matches/{fixture}/events', [FixtureController::class,'index'])->name('matches.events');

    Route::get('/matchEvent/{fixture}/create', [MatchEventController::class, 'create'])->name('event.create');


    Route::get('/news', function () {
        return view('news');
    })->name('news');

    Route::get('/news/{news}', function ($news) {
        return view('news-detail', compact('news'));
    })->name('news.show');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    // Admin Management Views
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/players', [PlayerController::class, 'index'])->name('players');

        Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');

        Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');

        Route::get('/players/{player}/edit', [PlayerController::class, 'edit'])->name('players.edit');

        Route::get('/matches', [FixtureController::class, 'index'])->name('matches');

        Route::get('/matches/create', [FixtureController::class, 'create'])->name('matches.create');

        Route::get('/matches/{fixture}/edit', function ($fixture) {
            return view('admin.matches-edit', compact('fixture'));
        })->name('matches.edit');


        Route::get('/news', [NewsController::class, 'index'])->name('news');

        Route::get('/news/create', function () {
            return view('admin.news-create');
        })->name('news.create');

        Route::get('/news/{news}/edit', function ($news) {
            return view('admin.news-edit', compact('news'));
        })->name('news.edit');

        Route::get('/users', function () {
            return view('admin.user');
        })->name('users');

        Route::get('/users/create', function () {
            return view('admin.users-create');
        })->name('users.create');

        Route::get('/users/{user}/edit', function ($user) {
            return view('admin.users-edit', compact('user'));
        })->name('users.edit');

        Route::get('/journalists', function () {
            return view('admin.journalists');
        })->name('journalists');
    });
});
