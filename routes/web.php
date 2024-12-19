<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoyageController;
use App\Models\Voyage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvisController;

// Accueil
Route::get('/',  [\App\Repositories\VoyageRepository::class, 'accueil'])->name('accueil');

// Contact
Route::get('/contact', fn() => view('contact'))->name("contact");

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard")->middleware('auth');

// Redirection de /home vers /dashboard
Route::get('/home', fn() => redirect()->route('dashboard'));

// Création et gestion des voyages
Route::middleware('auth')->group(function () {
    Route::get('/voyages/create', [VoyageController::class, 'create'])->name('voyages.create');
    Route::post('/voyages', [VoyageController::class, 'store'])->name('voyages.store');
    Route::patch('/voyages/{id}/activate', [VoyageController::class, 'activate'])->name('voyages.activate');
    Route::post('/voyages/{voyage}/like', [VoyageController::class, 'toggleLike'])->name('voyages.like');
});

// Voyages : lecture publique
Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');
Route::get('/voyages/continent', [VoyageController::class, 'continent'])->name('voyages.continent');
Route::get('/voyages/{id}', [VoyageController::class, 'show'])->name('voyages.show');

// Étapes
Route::get('/etape', [EtapeController::class, 'index'])->name('etapes.index');
Route::get('/etape/{id}', [EtapeController::class, 'show'])->name('etapes.show');
Route::get('/etape/{id}/edit', [EtapeController::class, 'edit'])->name('etapes.edit')->middleware('auth');
Route::put('/etape/{id}', [EtapeController::class, 'update'])->name('etapes.update')->middleware('auth');
Route::delete('/etape/{id}', [EtapeController::class, 'destroy'])->name('etapes.destroy')->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/voyages/{id}/etape/create', [EtapeController::class, 'create'])->name('etapes.create');
    Route::post('/voyages/{id}/etape', [EtapeController::class, 'store'])->name('etapes.store');
});

// Pour stocker les avis
Route::post('/voyages/{voyage}/avis', [AvisController::class, 'store'])->name('avis.store')->middleware('auth');

// À propos
Route::get('/a-propos', fn() => view('a-propos'))->name('a-propos');

// Photo de profile
Route::put('/profile/avatar', [UserController::class, 'updateAvatar'])->name('profile.update-avatar');
