<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

Route::get('/etudiants', [EtudiantController::class, 'liste_edudiants']);