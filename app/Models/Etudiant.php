<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    /**
     * Nom de la table
     */
    protected $table = 'etudiants';

    /**
     * Colonnes assignables en masse
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'filiere',
        'niveau',
        'age',
        'date_naissance',
        'telephone',
        'adresse',
    ];

    /**
     * Casting des attributs
     */
    protected $casts = [
        'date_naissance' => 'date',
        'age' => 'integer',
    ];

    /**
     * Méthodes personnalisées
     */
    public function estMajeur()
    {
        return $this->age >= 18;
    }

    public function nomComplet()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
