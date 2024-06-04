<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrawController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/player', [PlayerController::class, 'index'])->name('player');
    Route::get('player/add', [PlayerController::class, 'create'])->name('player.create');
    Route::post('/player', [PlayerController::class, 'store'])->name('player.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/', [DrawController::class, 'index'])->name('draw');
    Route::get('/draw/add', [DrawController::class, 'create'])->name('draw.create');
    Route::post('/draw', [DrawController::class, 'store'])->name('draw.store');
});

require __DIR__.'/auth.php';
