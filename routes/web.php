<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\VoyageController;
use Illuminate\Support\Facades\Route;

// Accueil
Route::get('/', fn() => view('statiques.accueil') )->name('accueil');

// Contact
Route::get('/contact', fn() => view('contact'))->name("contact");

Route::get('/home', [DashboardController::class, 'index'])->name("home")->middleware('auth');

// Redirection de /home vers /dashboard
Route::get('/home', fn() => redirect()->route('dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard")->middleware('auth');

// Création et stockage des voyages
Route::get('/voyages/create', [VoyageController::class, 'create'])->name('voyages.create');
Route::post('/voyages', [VoyageController::class, 'store'])->name('voyages.store');

// Voyages par continent
Route::get('/voyages/continent', [VoyageController::class, 'continent'])->name('voyages.continent');

// Voyages
Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');
Route::get('/voyages/{id}', [VoyageController::class, 'show'])->name('voyages.show');
Route::patch('/voyages/{id}/activate', [VoyageController::class, 'activate'])->name('voyages.activate');

Route::get('/etape', [EtapeController::class, 'index'])->name('etape.index');
Route::get('/etape/{id}', [EtapeController::class, 'show'])->name('etape.show');
Route::get('/etape/{id}/edit', [EtapeController::class, 'edit'])->name('etape.edit');
Route::put('/etape/{id}', [EtapeController::class, 'update'])->name('etape.update');
Route::delete('/etape/{id}', [EtapeController::class, 'destroy'])->name('etape.destroy');
