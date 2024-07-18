<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{id}', [PageController::class, 'show'])->name('dashboard.show');
    Route::post('/update-hours', [PageController::class, 'updateHours'])->name('update.hours');
    Route::put('/volunteer/{volunteer}/update-hours', [PageController::class, 'updateHours'])
        ->name('update.hours');

    Route::get('/details', [PageController::class, 'showDetails'])->name('details');
    Route::get('/add', [PageController::class, 'add'])->name('add');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
