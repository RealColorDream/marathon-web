<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JourneyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JourneyController::class, 'index'])->name('accueil');

Route::get('/contact', function () {
    return view('contact');
})->name("contact");

Route::get('/test-vite', function () {
    return view('test-vite');
})->name("test-vite");

Route::get('/home', [DashboardController::class])->name("home")->middleware('auth');

Route::get('/dashboard', [DashboardController::class])->name("dashboard")->middleware('auth');

Route::get('/journeys', [JourneyController::class, 'index'])->name('journeys.index');

Route::get('/voyages/{id}', [JourneyController::class, 'show'])->name('voyages.show');

Route::get('/voyage/create', [JourneyController::class, 'create'])->name('journeys.create')->middleware('auth');
Route::post('/voyage', [JourneyController::class, 'store'])->name('journeys.store')->middleware('auth');
