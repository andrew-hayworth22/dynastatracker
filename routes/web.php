<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DynastyController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\TeamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/dynasties');
    })->name('dashboard');

    Route::resource('dynasties', DynastyController::class)->only(['index', 'show', 'create', 'store']);
    Route::resource('dynasties.conferences', ConferenceController::class)->shallow()->only(['index', 'store']);
    Route::resource('conferences.divisions', DivisionController::class)->shallow()->only(['store']);
    Route::resource('divisions.teams', TeamController::class)->shallow()->only(['store']);

    Route::resource('dynasties.seasons', SeasonController::class)->shallow()->only(['index', 'store', 'show']);
    Route::get('seasons/{season}/roster', [SeasonController::class, 'roster'])->name('seasons.roster');

    Route::resource('seasons.games', GameController::class)->shallow()->only(['create', 'store', 'show']);

    Route::resource('dynasties.players', PlayerController::class)->shallow()->only(['index', 'store', 'update']);
});
