<?php

use App\Http\Controllers\VoyageController;
use Illuminate\Support\Facades\Route;

// Accueil
Route::get('/', [VoyageController::class, 'index'])->name('accueil');

// Contact
Route::get('/contact', fn() => view('contact'))->name("contact");

// Tableau de bord
Route::get('/dashboard', fn() => view('dashboard'))->name("dashboard")->middleware('auth');

// Redirection de /home vers /dashboard
Route::get('/home', fn() => redirect()->route('dashboard'));

// Voyages
Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');
Route::get('/voyages/{id}', [VoyageController::class, 'show'])->name('voyages.show');

// Création et stockage des voyages
Route::get('/voyages/create', [VoyageController::class, 'create'])->name('voyages.create');
Route::post('/voyages', [VoyageController::class, 'store'])->name('voyages.store');
