<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

// Page d'accueil redirige vers la liste des étudiants
Route::get('/', function () {
    return redirect()->route('etudiants.index');
});

// Routes ressources pour le CRUD complet des étudiants
Route::resource('etudiants', EtudiantController::class);
