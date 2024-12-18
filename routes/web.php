<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoyageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VoyageController::class, 'index'])->name('accueil');

Route::get('/contact', function () {
    return view('contact');
})->name("contact");

/*Route::get('/test-vite', function () {
    return view('test-vite');
})->name("test-vite");*/

Route::get('/home', [DashboardController::class, 'index'])->name("home")->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard")->middleware('auth');

Route::get('/journeys', [VoyageController::class, 'index'])->name('journeys.index');

Route::get('/voyages/{id}', [VoyageController::class, 'show'])->name('voyages.show');

Route::get('/voyages/create', [VoyageController::class, 'create'])->name('voyages.create');
Route::post('/voyages', [VoyageController::class, 'store'])->name('voyages.store');

