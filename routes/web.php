<?php

use App\Http\Controllers\AdminController;
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
    Route::get('/dashboard/{id}/edit', [PageController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{id}', [PageController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{id}', [PageController::class, 'destroy'])->name('dashboard.destroy');
    Route::post('/update-hours', [PageController::class, 'updateHours'])->name('update.hours');
    Route::get('/add/volunteers', [PageController::class, 'add_volunteers'])->name('add.volunteers');
    Route::post('/volunteers', [PageController::class, 'store'])->name('volunteers.store');
    Route::put('/volunteer/{volunteer}/update-hours', [PageController::class, 'updateHours'])
        ->name('updated.hours');

    Route::get('/details', [PageController::class, 'showDetails'])->name('details');
    Route::get('/add', [PageController::class, 'add'])->name('add');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/admin/toggle-register-access', [AdminController::class, 'toggleRegisterAccess'])->name('admin.toggleRegisterAccess');

// Route::get('/register', function () {
//     return view('auth.register');
// })->middleware('check.register.access');

require __DIR__ . '/auth.php';
