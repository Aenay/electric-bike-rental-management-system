<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('stations', StationController::class)->except(['show']);
    Route::resource('bikes', BikeController::class)->except(['show']);
    Route::resource('maintenance', MaintenanceController::class)->except(['show']);
    Route::resource('rentals', RentalController::class)->except(['show']);
});

require __DIR__.'/auth.php';
