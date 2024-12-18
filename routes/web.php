<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoyageController;
use Illuminate\Support\Facades\Route;

// Accueil
Route::get('/', [VoyageController::class, 'index'])->name('accueil');

// Contact
Route::get('/contact', fn() => view('contact'))->name("contact");

Route::get('/home', [DashboardController::class, 'index'])->name("home")->middleware('auth');

// Redirection de /home vers /dashboard
Route::get('/home', fn() => redirect()->route('dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard")->middleware('auth');

// Voyages
Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');
Route::get('/voyages/{id}', [VoyageController::class, 'show'])->name('voyages.show');

// Création et stockage des voyages
Route::get('/voyages/create', [VoyageController::class, 'create'])->name('voyages.create');
Route::post('/voyages', [VoyageController::class, 'store'])->name('voyages.store');
