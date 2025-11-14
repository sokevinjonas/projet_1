<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Affiche la liste des étudiants
     */
    public function index()
    {
        // Données statiques temporaires (en attendant la base de données)
        $etudiants = [
            [
                'id' => 1,
                'nom' => 'DIALLO',
                'prenom' => 'Mamadou',
                'filiere' => 'Informatique',
                'niveau' => 'L3',
                'age' => 22
            ],
            [
                'id' => 2,
                'nom' => 'TRAORE',
                'prenom' => 'Fatoumata',
                'filiere' => 'Gestion',
                'niveau' => 'M1',
                'age' => 24
            ],
            [
                'id' => 3,
                'nom' => 'KONE',
                'prenom' => 'Ibrahim',
                'filiere' => 'Droit',
                'niveau' => 'L2',
                'age' => 20
            ],
            [
                'id' => 4,
                'nom' => 'CAMARA',
                'prenom' => 'Aissata',
                'filiere' => 'Informatique',
                'niveau' => 'L3',
                'age' => 21
            ],
            [
                'id' => 5,
                'nom' => 'SYLLA',
                'prenom' => 'Mohamed',
                'filiere' => 'Économie',
                'niveau' => 'M2',
                'age' => 25
            ]
        ];

        return view('etudiants.index', compact('etudiants'));
    }
}
