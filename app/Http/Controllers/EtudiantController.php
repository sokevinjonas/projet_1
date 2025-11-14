<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Affiche la liste des étudiants
     */
    public function index()
    {
        $etudiants = Etudiant::latest()->paginate(10);
        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('etudiants.create');
    }

    /**
     * Enregistre un nouvel étudiant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:etudiants,email',
            'filiere' => 'required|string|max:100',
            'niveau' => 'required|string|max:10',
            'age' => 'required|integer|min:16|max:100',
            'date_naissance' => 'required|date',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'filiere.required' => 'La filière est obligatoire.',
            'niveau.required' => 'Le niveau est obligatoire.',
            'age.required' => 'L\'âge est obligatoire.',
            'age.min' => 'L\'âge minimum est 16 ans.',
            'date_naissance.required' => 'La date de naissance est obligatoire.',
        ]);

        Etudiant::create($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant ajouté avec succès !');
    }

    /**
     * Affiche les détails d'un étudiant
     */
    public function show(Etudiant $etudiant)
    {
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Affiche le formulaire de modification
     */
    public function edit(Etudiant $etudiant)
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    /**
     * Met à jour un étudiant
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:etudiants,email,' . $etudiant->id,
            'filiere' => 'required|string|max:100',
            'niveau' => 'required|string|max:10',
            'age' => 'required|integer|min:16|max:100',
            'date_naissance' => 'required|date',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'filiere.required' => 'La filière est obligatoire.',
            'niveau.required' => 'Le niveau est obligatoire.',
            'age.required' => 'L\'âge est obligatoire.',
            'age.min' => 'L\'âge minimum est 16 ans.',
            'date_naissance.required' => 'La date de naissance est obligatoire.',
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant modifié avec succès !');
    }

    /**
     * Supprime un étudiant
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès !');
    }
}
