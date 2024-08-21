<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class,'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('/dashboard/{id}', [DashboardController::class, 'editAnimal'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.edit');

    Route::patch('/dashboard/{id}', [DashboardController::class, 'updateAnimal'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/dashboard/{animalId}', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard.details');


// Route::patch('/dashboard/{animalId}', function () {
//     // todo: update
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::delete('/dashboard/{animalId}', function () {
//     // todo: delete
// })->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__.'/auth.php';
