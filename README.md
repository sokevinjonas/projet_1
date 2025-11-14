# Formation Laravel - Séance 2

## Migrations, Models, Controllers et CRUD

Bienvenue à la séance 2 ! Aujourd'hui, nous allons apprendre à interagir avec une base de données et créer un système CRUD complet pour gérer les étudiants.

---

## Table des matières

1. [Rappel de la séance 1](#rappel-de-la-séance-1)
2. [Les Migrations](#les-migrations)
3. [Les Models (Eloquent ORM)](#les-models-eloquent-orm)
4. [Le CRUD complet](#le-crud-complet)
5. [Validation des données](#validation-des-données)
6. [Messages Flash](#messages-flash)
7. [Exercices pratiques](#exercices-pratiques)

---

## Rappel de la séance 1

Dans la séance précédente, nous avons appris :
- Ce qu'est Laravel et pourquoi l'utiliser
- La structure d'un projet Laravel
- L'architecture MVC (Model-View-Controller)
- Comment créer des routes, contrôleurs et vues
- La syntaxe Blade pour les templates

Aujourd'hui, nous allons passer au niveau supérieur en travaillant avec une vraie base de données !

---

## Les Migrations

### Qu'est-ce qu'une migration ?

Une **migration** est comme un système de versioning pour votre base de données. C'est un fichier PHP qui décrit la structure d'une table (colonnes, types, contraintes, etc.).

### Pourquoi utiliser les migrations ?

**Avantages** :
- **Versioning** : Historique complet des modifications de la base de données
- **Collaboration** : Partager la structure de la BD avec votre équipe via Git
- **Portabilité** : Recréer la BD sur n'importe quel environnement
- **Rollback** : Annuler des changements facilement
- **Automatisation** : Pas besoin de créer manuellement les tables

### Structure d'une migration

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécuté quand on lance la migration (php artisan migrate)
     */
    public function up(): void
    {
        Schema::create('nom_table', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('colonne'); // Colonne varchar
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Exécuté quand on annule la migration (php artisan migrate:rollback)
     */
    public function down(): void
    {
        Schema::dropIfExists('nom_table');
    }
};
```

### Créer une migration

```bash
# Syntaxe de base
php artisan make:migration nom_de_la_migration

# Exemple pour créer une table
php artisan make:migration create_etudiants_table

# Avec options utiles
php artisan make:migration create_etudiants_table --create=etudiants
```

**Convention de nommage** :
- Créer une table : `create_nom_tables_table`
- Modifier une table : `add_column_to_nom_table`
- Supprimer une colonne : `remove_column_from_nom_table`

### Types de colonnes courantes

| Méthode | Type SQL | Description | Exemple |
|---------|----------|-------------|---------|
| `$table->id()` | BIGINT UNSIGNED | Clé primaire auto-incrémentée | `$table->id();` |
| `$table->string('nom', 100)` | VARCHAR(100) | Chaîne de caractères | `$table->string('nom');` |
| `$table->text('description')` | TEXT | Texte long | `$table->text('bio');` |
| `$table->integer('age')` | INT | Nombre entier | `$table->integer('age');` |
| `$table->boolean('actif')` | TINYINT(1) | Booléen (0 ou 1) | `$table->boolean('is_active');` |
| `$table->date('naissance')` | DATE | Date (YYYY-MM-DD) | `$table->date('birth_date');` |
| `$table->datetime('heure')` | DATETIME | Date et heure | `$table->datetime('published_at');` |
| `$table->timestamps()` | TIMESTAMP | created_at, updated_at | `$table->timestamps();` |
| `$table->softDeletes()` | TIMESTAMP | deleted_at | `$table->softDeletes();` |
| `$table->foreignId('user_id')` | BIGINT UNSIGNED | Clé étrangère | `$table->foreignId('user_id');` |

### Modificateurs de colonnes

```php
// Rendre une colonne nullable (accepte NULL)
$table->string('telephone')->nullable();

// Valeur par défaut
$table->boolean('actif')->default(true);
$table->string('role')->default('etudiant');

// Unique (pas de doublons)
$table->string('email')->unique();

// Index (pour optimiser les recherches)
$table->string('nom')->index();

// Commentaire
$table->string('code')->comment('Code unique de l\'étudiant');

// Unsigned (uniquement positif)
$table->integer('age')->unsigned();

// Combinaisons
$table->string('email')->unique()->nullable();
$table->decimal('note', 5, 2)->default(0)->comment('Note sur 20');
```

### Créer la migration pour les étudiants

```bash
php artisan make:migration create_etudiants_table --create=etudiants
```

Fichier généré : `database/migrations/2024_xx_xx_xxxxxx_create_etudiants_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('email')->unique();
            $table->string('filiere', 100);
            $table->string('niveau', 10);
            $table->integer('age')->unsigned();
            $table->date('date_naissance');
            $table->string('telephone', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
```

### Exécuter les migrations

```bash
# Exécuter toutes les migrations en attente
php artisan migrate

# Voir le statut des migrations
php artisan migrate:status

# Annuler la dernière migration
php artisan migrate:rollback

# Annuler toutes les migrations
php artisan migrate:reset

# Annuler et re-exécuter toutes les migrations
php artisan migrate:refresh

# Supprimer toutes les tables et re-exécuter les migrations
php artisan migrate:fresh

# Avec seed (données de test)
php artisan migrate:fresh --seed
```

**Important** : Avant d'exécuter les migrations, assurez-vous que :
1. Votre base de données est créée
2. Le fichier `.env` contient les bonnes informations de connexion

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_etudiants
DB_USERNAME=root
DB_PASSWORD=
```

---

## Les Models (Eloquent ORM)

### Qu'est-ce qu'un Model ?

Un **Model** est une classe PHP qui représente une table de la base de données. C'est le **M** dans MVC.

**ORM** (Object-Relational Mapping) : Permet de manipuler la base de données avec des objets PHP au lieu d'écrire du SQL brut.

### Eloquent : L'ORM de Laravel

Eloquent est l'ORM intégré à Laravel. Il rend l'interaction avec la base de données extrêmement simple et élégante.

**Sans Eloquent (SQL brut)** :
```php
$result = DB::select('SELECT * FROM etudiants WHERE age > ?', [20]);
```

**Avec Eloquent** :
```php
$etudiants = Etudiant::where('age', '>', 20)->get();
```

### Créer un Model

```bash
# Créer uniquement le model
php artisan make:model Etudiant

# Créer le model avec la migration
php artisan make:model Etudiant -m

# Créer le model avec migration, controller et factory
php artisan make:model Etudiant -mcf

# Créer tout (model, migration, controller, seeder, factory, requests)
php artisan make:model Etudiant --all
```

### Structure d'un Model

Fichier : `app/Models/Etudiant.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    /**
     * Nom de la table (optionnel si respect de la convention)
     * Convention : pluriel en minuscules du nom du model
     * Etudiant -> etudiants
     */
    protected $table = 'etudiants';

    /**
     * Clé primaire (optionnel si c'est 'id')
     */
    protected $primaryKey = 'id';

    /**
     * Colonnes assignables en masse (Mass Assignment)
     * IMPORTANT : Pour la sécurité !
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
     * Colonnes cachées (non visibles dans le JSON)
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Casting des attributs
     * Convertir automatiquement les types
     */
    protected $casts = [
        'date_naissance' => 'date',
        'age' => 'integer',
    ];

    /**
     * Activer/désactiver les timestamps
     */
    public $timestamps = true;

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
```

### Conventions Eloquent

Laravel suit des conventions pour simplifier le code :

| Convention | Exemple | Si différent |
|------------|---------|--------------|
| **Nom de la table** | `Etudiant` → `etudiants` | `protected $table = 'students';` |
| **Clé primaire** | `id` | `protected $primaryKey = 'etudiant_id';` |
| **Auto-incrémentée** | Oui | `public $incrementing = false;` |
| **Timestamps** | `created_at`, `updated_at` | `public $timestamps = false;` |

### Opérations CRUD avec Eloquent

#### **CREATE** - Créer un enregistrement

```php
// Méthode 1 : Création manuelle
$etudiant = new Etudiant();
$etudiant->nom = 'DIALLO';
$etudiant->prenom = 'Mamadou';
$etudiant->email = 'mamadou@example.com';
$etudiant->filiere = 'Informatique';
$etudiant->niveau = 'L3';
$etudiant->age = 22;
$etudiant->save();

// Méthode 2 : Mass Assignment (plus simple)
$etudiant = Etudiant::create([
    'nom' => 'DIALLO',
    'prenom' => 'Mamadou',
    'email' => 'mamadou@example.com',
    'filiere' => 'Informatique',
    'niveau' => 'L3',
    'age' => 22,
]);

// Méthode 3 : firstOrCreate (créer si n'existe pas)
$etudiant = Etudiant::firstOrCreate(
    ['email' => 'mamadou@example.com'], // Critère de recherche
    ['nom' => 'DIALLO', 'prenom' => 'Mamadou'] // Données à créer
);
```

#### **READ** - Lire les données

```php
// Récupérer tous les enregistrements
$etudiants = Etudiant::all();

// Récupérer avec condition
$etudiants = Etudiant::where('filiere', 'Informatique')->get();

// Récupérer un seul enregistrement
$etudiant = Etudiant::find(1); // Par ID
$etudiant = Etudiant::where('email', 'mamadou@example.com')->first();

// Trouver ou échouer (throw 404 si non trouvé)
$etudiant = Etudiant::findOrFail(1);

// Compter
$total = Etudiant::count();
$total_info = Etudiant::where('filiere', 'Informatique')->count();

// Pagination
$etudiants = Etudiant::paginate(10); // 10 par page

// Tri
$etudiants = Etudiant::orderBy('nom', 'asc')->get();
$etudiants = Etudiant::latest()->get(); // Par created_at DESC

// Conditions multiples
$etudiants = Etudiant::where('filiere', 'Informatique')
                     ->where('age', '>', 20)
                     ->orderBy('nom')
                     ->get();

// Select spécifique
$etudiants = Etudiant::select('nom', 'prenom', 'email')->get();
```

#### **UPDATE** - Mettre à jour

```php
// Méthode 1 : Trouver puis modifier
$etudiant = Etudiant::find(1);
$etudiant->age = 23;
$etudiant->save();

// Méthode 2 : update() avec where
Etudiant::where('id', 1)->update([
    'age' => 23,
    'niveau' => 'M1'
]);

// Méthode 3 : Mise à jour ou création
Etudiant::updateOrCreate(
    ['email' => 'mamadou@example.com'], // Critère
    ['age' => 23, 'niveau' => 'M1'] // Données
);

// Incrémenter/Décrémenter
$etudiant->increment('age'); // age = age + 1
$etudiant->increment('age', 5); // age = age + 5
$etudiant->decrement('age'); // age = age - 1
```

#### **DELETE** - Supprimer

```php
// Méthode 1 : Trouver puis supprimer
$etudiant = Etudiant::find(1);
$etudiant->delete();

// Méthode 2 : Suppression directe
Etudiant::destroy(1); // Par ID
Etudiant::destroy([1, 2, 3]); // Plusieurs IDs

// Méthode 3 : Avec condition
Etudiant::where('age', '<', 18)->delete();

// Soft Delete (suppression douce - garder en BD mais marquer comme supprimé)
// Nécessite $table->softDeletes() dans la migration
// Et use SoftDeletes; dans le model
$etudiant->delete(); // Met deleted_at à la date actuelle

// Récupérer les éléments soft deleted
$etudiants = Etudiant::withTrashed()->get();
$etudiants = Etudiant::onlyTrashed()->get();

// Restaurer un élément soft deleted
$etudiant->restore();

// Suppression définitive
$etudiant->forceDelete();
```

---

## Le CRUD complet

Maintenant que nous connaissons les migrations et les models, créons un système CRUD complet !

### Les 7 méthodes RESTful d'un contrôleur

Laravel suit les conventions REST (Representational State Transfer) :

| Méthode | Route | Action | Description |
|---------|-------|--------|-------------|
| `index()` | GET `/etudiants` | Afficher la liste | Liste tous les étudiants |
| `create()` | GET `/etudiants/create` | Formulaire de création | Affiche le formulaire |
| `store()` | POST `/etudiants` | Enregistrer | Enregistre un nouvel étudiant |
| `show()` | GET `/etudiants/{id}` | Afficher un | Affiche les détails |
| `edit()` | GET `/etudiants/{id}/edit` | Formulaire de modification | Affiche le formulaire |
| `update()` | PUT/PATCH `/etudiants/{id}` | Mettre à jour | Met à jour l'étudiant |
| `destroy()` | DELETE `/etudiants/{id}` | Supprimer | Supprime l'étudiant |

### Créer un contrôleur ressource

```bash
# Créer un contrôleur avec toutes les méthodes RESTful
php artisan make:controller EtudiantController --resource

# Créer un contrôleur avec model
php artisan make:controller EtudiantController --resource --model=Etudiant
```

### Définir les routes ressources

Dans `routes/web.php` :

```php
use App\Http\Controllers\EtudiantController;

// Une seule ligne pour toutes les routes CRUD !
Route::resource('etudiants', EtudiantController::class);

// Équivalent à :
// Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
// Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
// Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');
// Route::get('/etudiants/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');
// Route::get('/etudiants/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
// Route::put('/etudiants/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');
// Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
```

Voir toutes les routes :
```bash
php artisan route:list
```

### Implémentation du contrôleur

`app/Http/Controllers/EtudiantController.php`

```php
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
        // Validation
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
        ]);

        // Création
        Etudiant::create($validated);

        // Redirection avec message
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
        // Validation
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
        ]);

        // Mise à jour
        $etudiant->update($validated);

        // Redirection
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
```

**Note** : Laravel utilise le **Route Model Binding**. Quand vous typez `Etudiant $etudiant`, Laravel récupère automatiquement l'étudiant par son ID depuis l'URL.

---

## Validation des données

La validation est **cruciale** pour la sécurité et l'intégrité des données.

### Règles de validation courantes

| Règle | Description | Exemple |
|-------|-------------|---------|
| `required` | Champ obligatoire | `'nom' => 'required'` |
| `nullable` | Peut être null | `'telephone' => 'nullable'` |
| `string` | Doit être une chaîne | `'nom' => 'string'` |
| `integer` | Doit être un entier | `'age' => 'integer'` |
| `numeric` | Nombre (int ou float) | `'note' => 'numeric'` |
| `email` | Email valide | `'email' => 'email'` |
| `date` | Date valide | `'naissance' => 'date'` |
| `min:x` | Minimum (taille ou valeur) | `'age' => 'min:18'` |
| `max:x` | Maximum (taille ou valeur) | `'nom' => 'max:100'` |
| `between:x,y` | Entre deux valeurs | `'age' => 'between:18,100'` |
| `unique:table,column` | Valeur unique dans la table | `'email' => 'unique:etudiants,email'` |
| `exists:table,column` | Doit exister dans une table | `'user_id' => 'exists:users,id'` |
| `confirmed` | Confirmation (ex: password) | `'password' => 'confirmed'` |
| `in:val1,val2` | Dans une liste de valeurs | `'niveau' => 'in:L1,L2,L3,M1,M2'` |

### Combinaison de règles

```php
$request->validate([
    'nom' => 'required|string|max:100',
    'email' => 'required|email|unique:etudiants,email',
    'age' => 'required|integer|min:16|max:100',
    'niveau' => 'required|in:L1,L2,L3,M1,M2',

    // Ignorer l'email actuel lors de la modification
    'email' => 'required|email|unique:etudiants,email,' . $id,

    // Tableau de règles
    'email' => ['required', 'email', 'unique:etudiants,email'],
]);
```

### Messages d'erreur personnalisés

```php
$request->validate([
    'nom' => 'required|max:100',
    'email' => 'required|email|unique:etudiants',
], [
    'nom.required' => 'Le nom est obligatoire.',
    'nom.max' => 'Le nom ne peut pas dépasser 100 caractères.',
    'email.required' => 'L\'adresse email est obligatoire.',
    'email.email' => 'L\'adresse email doit être valide.',
    'email.unique' => 'Cette adresse email est déjà utilisée.',
]);
```

### Afficher les erreurs dans la vue

```blade
{{-- Afficher toutes les erreurs --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Afficher l'erreur d'un champ spécifique --}}
@error('nom')
    <div class="error">{{ $message }}</div>
@enderror

{{-- Conserver la valeur saisie après erreur --}}
<input type="text" name="nom" value="{{ old('nom') }}">
```

---

## Messages Flash

Les **messages flash** sont des messages temporaires stockés en session, affichés une seule fois.

### Envoyer un message flash

```php
// Dans le contrôleur
return redirect()->route('etudiants.index')
    ->with('success', 'Étudiant créé avec succès !');

return redirect()->back()
    ->with('error', 'Une erreur est survenue.');

return redirect()->route('etudiants.show', $etudiant)
    ->with('info', 'Informations mises à jour.');
```

### Afficher le message flash

Dans le layout (`resources/views/layouts/app.blade.php`) :

```blade
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif
```

---

## Exercices pratiques

### Exercice 1 : Créer la migration et le model

1. Créez la migration pour la table `etudiants` avec toutes les colonnes
2. Créez le model `Etudiant` avec les propriétés `$fillable`
3. Exécutez la migration

### Exercice 2 : Implémenter le CRUD complet

1. Créez le contrôleur ressource `EtudiantController`
2. Définissez la route ressource dans `web.php`
3. Implémentez toutes les méthodes du contrôleur

### Exercice 3 : Créer les vues

1. `index.blade.php` : Liste des étudiants avec pagination
2. `create.blade.php` : Formulaire de création
3. `edit.blade.php` : Formulaire de modification
4. `show.blade.php` : Affichage des détails

### Exercice 4 : Ajouter la validation

1. Ajoutez la validation dans `store()` et `update()`
2. Affichez les erreurs dans les formulaires
3. Conservez les valeurs saisies avec `old()`

### Exercice 5 : Tester le CRUD

1. Créez plusieurs étudiants
2. Modifiez-en quelques-uns
3. Affichez les détails
4. Supprimez-en un
5. Testez la pagination

---

## Commandes Artisan utiles

```bash
# Migrations
php artisan make:migration create_etudiants_table
php artisan migrate
php artisan migrate:rollback
php artisan migrate:fresh

# Models
php artisan make:model Etudiant
php artisan make:model Etudiant -m
php artisan make:model Etudiant -mcf

# Controllers
php artisan make:controller EtudiantController
php artisan make:controller EtudiantController --resource

# Routes
php artisan route:list
php artisan route:clear

# Base de données
php artisan db:show
php artisan db:table etudiants

# Tinker (Console interactive)
php artisan tinker
>>> Etudiant::all()
>>> Etudiant::create(['nom' => 'DIALLO', ...])
>>> Etudiant::find(1)
```

---

## Tinker : Console interactive

Tinker permet d'interagir avec votre application en temps réel :

```bash
php artisan tinker
```

```php
// Créer un étudiant
>>> $etudiant = new App\Models\Etudiant();
>>> $etudiant->nom = 'DIALLO';
>>> $etudiant->prenom = 'Mamadou';
>>> $etudiant->save();

// Récupérer tous les étudiants
>>> App\Models\Etudiant::all();

// Compter
>>> App\Models\Etudiant::count();

// Rechercher
>>> App\Models\Etudiant::where('filiere', 'Informatique')->get();

// Supprimer
>>> App\Models\Etudiant::find(1)->delete();
```

---

## Checklist de la séance 2

Avant de passer à la séance 3, assurez-vous de maîtriser :

- [ ] Qu'est-ce qu'une migration et comment la créer
- [ ] Les types de colonnes courants et les modificateurs
- [ ] Comment exécuter et annuler des migrations
- [ ] Qu'est-ce qu'un Model Eloquent et son rôle
- [ ] Les opérations CRUD avec Eloquent
- [ ] Les 7 méthodes RESTful d'un contrôleur
- [ ] Comment créer une route ressource
- [ ] La validation des données avec les règles courantes
- [ ] L'affichage des erreurs de validation
- [ ] L'utilisation des messages flash
- [ ] Le Route Model Binding
- [ ] La convention de nommage Laravel

---

## Préparation pour la séance 3

Dans la prochaine séance, nous allons :

1. **Les relations Eloquent** :
   - One-to-One (Un à Un)
   - One-to-Many (Un à Plusieurs)
   - Many-to-Many (Plusieurs à Plusieurs)

2. **L'authentification** :
   - Créer un système de connexion/inscription
   - Middleware d'authentification
   - Gestion des rôles (admin, étudiant)

3. **Protéger les routes** :
   - Middleware `auth`
   - Vérification des permissions

4. **Intégrer un template admin** :
   - AdminLTE ou un autre template
   - Dashboard professionnel

---

**Excellent travail ! Vous maîtrisez maintenant les bases du développement avec Laravel !**
