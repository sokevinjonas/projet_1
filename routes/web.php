<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

Route::get('/', [EtudiantController::class, 'index'])->name('home');
Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
