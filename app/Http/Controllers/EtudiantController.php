<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EtudiantController extends Controller
{
   public function liste_edudiants()
    {
        $etudiants = [
            [
                'id' => 1,
                'nom' => 'Kabore',
                'email' => 'kabore@example.com'
            ],
            [
                'id' => 2,
                'nom' => 'Traore',
                'email' => 'traore@example.com'
            ],
            [
                'id' => 3,
                'nom' => 'Diarra',
                'email' => 'diarra@example.com'
            ],
            [
                'id' => 4,
                'nom' => 'Coulibaly',
                'email' => 'coulibaly@example.com'
            ]
        ];

        return view('etudiant', compact('etudiants'));
    }
}
