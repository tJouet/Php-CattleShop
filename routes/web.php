<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class,'index']);

Route::post('/dashboard/create',[DashboardController::class, 'createAnimal'])
->middleware(['auth', 'verified']);

Route::get('/dashboard/create',[DashboardController::class, 'displayCreateForm'])
->middleware(['auth', 'verified'])
->name('dashboard.create');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('/dashboard/{id}', [DashboardController::class, 'editAnimal'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.edit');

    Route::patch('/dashboard/{id}', [DashboardController::class, 'updateAnimal'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.update');

    Route::delete('/dashboard/{id}', [DashboardController::class, 'putDownAnimal'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
