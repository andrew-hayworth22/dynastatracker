<?php

use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DynastyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\TeamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DynastyController::class, 'index'])->name('dynasty.index');
    Route::get('/dynasty/{id}', [DynastyController::class, 'show'])->name('dynasty.show');
    Route::post('/dynasty', [DynastyController::class, 'store'])->name('dynasty.store');
    Route::delete('/dynasty/{id}', [DynastyController::class, 'destroy'])->name('dynasty.destroy');

    Route::get('/dynasty/{id}/teams', [ConferenceController::class, 'index'])->name('conference.index');
    Route::post('/division/{divisionId}/team', [TeamController::class, 'store'])->name('team.store');
    Route::put('/team/{id}', [TeamController::class, 'update'])->name('team.update');
    Route::post('/conference/{conferenceId}/division', [DivisionController::class, 'store'])->name('division.store');
    Route::post('/dynasty/{dynastyId}/conference', [ConferenceController::class, 'store'])->name('conference.store');
    Route::get('/dynasty/{dynastyId}/seasons', [SeasonController::class, 'index'])->name('season.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
