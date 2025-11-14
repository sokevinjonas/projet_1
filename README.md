# Formation Laravel - Séance 1

## Bienvenue dans votre formation Laravel

Cette formation de 3 jours vous permettra de maîtriser les bases essentielles de Laravel, le framework PHP le plus populaire au monde, pour être capable de développer vos propres applications web dynamiques.

---

## Table des matières

1. [Qu'est-ce que Laravel ?](#quest-ce-que-laravel)
2. [Pourquoi utiliser Laravel ?](#pourquoi-utiliser-laravel)
3. [Installation de Laravel](#installation-de-laravel)
4. [Structure d'un projet Laravel](#structure-dun-projet-laravel)
5. [Le concept MVC (Model-View-Controller)](#le-concept-mvc-model-view-controller)
6. [Notre premier projet : Gestion des étudiants](#notre-premier-projet--gestion-des-étudiants)
7. [Exercices pratiques](#exercices-pratiques)

---

## Qu'est-ce que Laravel ?

Laravel est un **framework PHP open-source** créé par Taylor Otwell en 2011. C'est un outil qui fournit une structure et des outils prêts à l'emploi pour développer des applications web de manière rapide, élégante et efficace.

### Définitions importantes

**Framework** : Un ensemble d'outils, de bibliothèques et de conventions qui facilitent le développement d'applications en fournissant une structure de base.

**PHP** : Langage de programmation côté serveur très utilisé pour créer des sites web dynamiques.

**Open-source** : Le code source est accessible à tous, gratuit et peut être modifié.

### Version actuelle

Ce projet utilise **Laravel 12.38.1**, l'une des versions les plus récentes du framework.

---

## Pourquoi utiliser Laravel ?

Laravel offre de nombreux avantages qui en font le choix préféré de millions de développeurs :

### 1. Syntaxe élégante et expressive
```php
// Exemple de route Laravel
Route::get('/etudiants', function () {
    return view('etudiants.index');
});
```

### 2. Architecture MVC claire
Laravel impose une organisation du code qui facilite :
- La maintenance
- La collaboration en équipe
- La scalabilité (faire grandir votre application)

### 3. Écosystème riche
- **Eloquent ORM** : Interaction avec la base de données de manière simple
- **Blade** : Moteur de templates puissant et intuitif
- **Artisan** : Interface en ligne de commande pour automatiser les tâches
- **Migration** : Gestion de la structure de base de données

### 4. Sécurité intégrée
- Protection contre les injections SQL
- Protection CSRF (Cross-Site Request Forgery)
- Hashage de mots de passe
- Validation des données

### 5. Documentation complète
Laravel possède une documentation très détaillée en anglais : [laravel.com/docs](https://laravel.com/docs)

---

## Installation de Laravel

### Prérequis

Avant d'installer Laravel, vous devez avoir sur votre machine :

1. **PHP >= 8.2**
2. **Composer** (gestionnaire de dépendances PHP)
3. **Base de données** (MySQL, PostgreSQL, SQLite...)
4. **Node.js et NPM** (pour la compilation des assets front-end)

### Vérifier les prérequis

```bash
# Vérifier la version de PHP
php --version

# Vérifier Composer
composer --version

# Vérifier Node.js
node --version

# Vérifier NPM
npm --version
```

### Méthodes d'installation

#### Méthode 1 : Via Composer (Recommandée)

```bash
# Créer un nouveau projet Laravel
composer create-project laravel/laravel nom-du-projet

# Accéder au répertoire du projet
cd nom-du-projet

# Lancer le serveur de développement
php artisan serve
```

Votre application sera accessible à l'adresse : `http://localhost:8000`

#### Méthode 2 : Via Laravel Installer

```bash
# Installer l'installateur Laravel globalement
composer global require laravel/installer

# Créer un nouveau projet
laravel new nom-du-projet

# Accéder au répertoire
cd nom-du-projet

# Lancer le serveur
php artisan serve
```

### Configuration de base

#### 1. Fichier .env

Le fichier `.env` contient toutes les configurations de votre application :

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_base
DB_USERNAME=root
DB_PASSWORD=
```

**Important** :
- `APP_KEY` est généré automatiquement (sinon : `php artisan key:generate`)
- Configurez vos informations de base de données dans cette section

#### 2. Créer la base de données

```sql
-- Dans MySQL/phpMyAdmin
CREATE DATABASE gestion_etudiants CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Puis mettez à jour le `.env` :
```env
DB_DATABASE=gestion_etudiants
DB_USERNAME=votre_username
DB_PASSWORD=votre_password
```

#### 3. Installer les dépendances

```bash
# Dépendances PHP
composer install

# Dépendances JavaScript
npm install

# Compiler les assets
npm run dev
```

---

## Structure d'un projet Laravel

Comprendre la structure des dossiers est essentiel pour travailler efficacement avec Laravel.

```
projet_1/
│
├── app/                    # Cœur de l'application
│   ├── Http/
│   │   ├── Controllers/   # Contrôleurs (logique métier)
│   │   └── Middleware/    # Filtres de requêtes
│   ├── Models/            # Modèles (interaction avec la BD)
│   └── Providers/         # Fournisseurs de services
│
├── bootstrap/             # Fichiers de démarrage du framework
│
├── config/                # Fichiers de configuration
│   ├── app.php           # Configuration générale
│   ├── database.php      # Configuration base de données
│   └── ...
│
├── database/
│   ├── migrations/       # Fichiers de migration (structure BD)
│   ├── seeders/          # Données de test
│   └── factories/        # Générateurs de données factices
│
├── public/               # Point d'entrée web (accessible publiquement)
│   ├── index.php        # Fichier d'entrée
│   ├── css/             # Fichiers CSS compilés
│   └── js/              # Fichiers JS compilés
│
├── resources/
│   ├── views/           # Vues (templates Blade)
│   ├── css/             # Fichiers CSS source
│   └── js/              # Fichiers JS source
│
├── routes/
│   ├── web.php          # Routes web (navigation classique)
│   ├── api.php          # Routes API (pour les API REST)
│   └── console.php      # Commandes Artisan personnalisées
│
├── storage/             # Fichiers générés (logs, cache, uploads...)
│   ├── app/
│   ├── framework/
│   └── logs/
│
├── tests/               # Tests automatisés
│
├── vendor/              # Dépendances Composer (ne pas modifier)
│
├── .env                 # Variables d'environnement (configuration)
├── artisan              # CLI Artisan
├── composer.json        # Dépendances PHP
└── package.json         # Dépendances JavaScript
```

### Dossiers principaux à retenir

| Dossier | Utilité | Exemples |
|---------|---------|----------|
| `app/Models/` | Modèles représentant vos tables | `Etudiant.php` |
| `app/Http/Controllers/` | Logique de traitement | `EtudiantController.php` |
| `resources/views/` | Templates HTML | `etudiants/index.blade.php` |
| `routes/web.php` | Définition des URLs | `Route::get('/etudiants', ...)` |
| `database/migrations/` | Structure de la base de données | `create_etudiants_table.php` |
| `public/` | Fichiers accessibles depuis le web | `style.css`, `logo.png` |

---

## Le concept MVC (Model-View-Controller)

MVC est un **patron de conception** (design pattern) qui sépare l'application en trois composants interconnectés.

### Pourquoi MVC ?

L'architecture MVC permet de :
- **Séparer les préoccupations** : Chaque partie a un rôle précis
- **Faciliter la maintenance** : Modifier une partie sans casser les autres
- **Favoriser la réutilisation** : Un même modèle peut servir à plusieurs vues
- **Améliorer la testabilité** : Tester chaque composant indépendamment

### Les 3 composants du MVC

```
┌─────────────┐
│   CLIENT    │
│  (Navigateur)│
└──────┬──────┘
       │ 1. Requête HTTP
       │    (GET /etudiants)
       ▼
┌─────────────────────────────────────────┐
│           CONTROLLER                     │
│  (app/Http/Controllers/EtudiantController)│
│                                          │
│  - Reçoit la requête                    │
│  - Demande les données au Model         │
│  - Passe les données à la View          │
└────┬─────────────────────┬──────────────┘
     │                     │
     │ 2. Demande          │ 4. Envoie
     │    données          │    données
     ▼                     │
┌─────────────┐            │
│   MODEL     │            │
│(app/Models/ │            │
│ Etudiant)   │            │
│             │            │
│ - Interagit │            │
│   avec la BD│            │
│ - Logique   │            │
│   métier    │            │
└──────┬──────┘            │
       │                   │
       │ 3. Retourne       │
       │    données        │
       └───────────────────┘
                           │
                           ▼
                    ┌─────────────┐
                    │    VIEW     │
                    │(resources/  │
                    │ views/)     │
                    │             │
                    │ - Affiche   │
                    │   les       │
                    │   données   │
                    │ - HTML/CSS  │
                    └──────┬──────┘
                           │
                           │ 5. Réponse HTML
                           ▼
                    ┌─────────────┐
                    │   CLIENT    │
                    └─────────────┘
```

### 1. Model (Modèle)

**Rôle** : Représente les données et la logique métier

**Fichier** : `app/Models/Etudiant.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    // Nom de la table (optionnel si respect convention)
    protected $table = 'etudiants';

    // Colonnes modifiables en masse
    protected $fillable = [
        'nom',
        'prenom',
        'filiere',
        'niveau',
        'age'
    ];

    // Exemple de méthode métier
    public function estMajeur()
    {
        return $this->age >= 18;
    }
}
```

**Responsabilités** :
- Interagir avec la base de données (CRUD)
- Contenir la logique métier
- Définir les relations entre tables
- Valider les données

### 2. View (Vue)

**Rôle** : Présentation des données à l'utilisateur

**Fichier** : `resources/views/etudiants/index.blade.php`

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Liste des étudiants</h1>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Filière</th>
                    <th>Niveau</th>
                    <th>Âge</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <td>{{ $etudiant->filiere }}</td>
                    <td>{{ $etudiant->niveau }}</td>
                    <td>{{ $etudiant->age }}</td>
                    <td>
                        <a href="/etudiants/{{ $etudiant->id }}">Voir</a>
                        <a href="/etudiants/{{ $etudiant->id }}/edit">Modifier</a>
                        <form action="/etudiants/{{ $etudiant->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
```

**Responsabilités** :
- Afficher les données
- Présenter l'interface utilisateur
- Utiliser le moteur de template Blade
- Pas de logique métier

### 3. Controller (Contrôleur)

**Rôle** : Gère la logique de l'application et fait le lien entre Model et View

**Fichier** : `app/Http/Controllers/EtudiantController.php`

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
        // 1. Récupère tous les étudiants via le Model
        $etudiants = Etudiant::all();

        // 2. Passe les données à la View
        return view('etudiants.index', [
            'etudiants' => $etudiants
        ]);
    }

    /**
     * Affiche un étudiant spécifique
     */
    public function show($id)
    {
        $etudiant = Etudiant::findOrFail($id);

        return view('etudiants.show', [
            'etudiant' => $etudiant
        ]);
    }
}
```

**Responsabilités** :
- Recevoir les requêtes HTTP
- Appeler les méthodes du Model
- Préparer les données pour la View
- Retourner la réponse appropriée

### Routes : Le point d'entrée

**Fichier** : `routes/web.php`

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

// Route vers la liste des étudiants
Route::get('/etudiants', [EtudiantController::class, 'index'])
    ->name('etudiants.index');

// Route vers un étudiant spécifique
Route::get('/etudiants/{id}', [EtudiantController::class, 'show'])
    ->name('etudiants.show');
```

### Flux complet d'une requête

Prenons l'exemple d'un utilisateur qui visite `/etudiants` :

```
1. L'utilisateur tape : http://localhost:8000/etudiants

2. Laravel vérifie routes/web.php et trouve :
   Route::get('/etudiants', [EtudiantController::class, 'index'])

3. Laravel appelle la méthode index() du EtudiantController

4. Le Controller demande au Model Etudiant :
   $etudiants = Etudiant::all();

5. Le Model Etudiant interroge la base de données :
   SELECT * FROM etudiants

6. Le Model retourne les données au Controller

7. Le Controller passe les données à la View :
   return view('etudiants.index', ['etudiants' => $etudiants]);

8. La View (Blade) génère le HTML en utilisant les données

9. Laravel retourne le HTML au navigateur de l'utilisateur
```

---

## Notre premier projet : Gestion des étudiants

Dans cette séance, nous allons créer une interface simple qui affiche une liste d'étudiants avec leurs informations.

### Objectifs

- Créer une page d'accueil
- Afficher une liste statique d'étudiants
- Comprendre comment les routes, contrôleurs et vues fonctionnent ensemble
- Styliser notre interface avec CSS

### Structure de l'interface

Notre interface affichera pour chaque étudiant :
- **Nom**
- **Prénom**
- **Filière** (ex: Informatique, Gestion, etc.)
- **Niveau** (ex: L1, L2, L3, M1, M2)
- **Âge**
- **Actions** : Voir | Modifier | Supprimer

### Étape 1 : Créer le contrôleur

```bash
php artisan make:controller EtudiantController
```

Cette commande crée le fichier `app/Http/Controllers/EtudiantController.php`

### Étape 2 : Définir la route

Dans `routes/web.php` :

```php
use App\Http\Controllers\EtudiantController;

Route::get('/', [EtudiantController::class, 'index'])->name('home');
Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
```

### Étape 3 : Créer la méthode dans le contrôleur

Dans `app/Http/Controllers/EtudiantController.php`, nous allons créer des données statiques pour le moment :

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EtudiantController extends Controller
{
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
```

**Note** : `compact('etudiants')` est équivalent à `['etudiants' => $etudiants]`

### Étape 4 : Créer la vue

Créez le dossier `resources/views/etudiants/` puis le fichier `index.blade.php`

Cette vue sera créée dans la prochaine section pratique.

---

## Le moteur de template Blade

Blade est le moteur de template de Laravel qui permet d'écrire du code PHP de manière élégante dans les vues.

### Syntaxe de base

```blade
{{-- Commentaire Blade (non visible dans le HTML) --}}

{{-- Afficher une variable (échappée automatiquement) --}}
{{ $variable }}

{{-- Afficher du HTML non échappé (ATTENTION : risque XSS) --}}
{!! $html !!}

{{-- Structures de contrôle --}}
@if($condition)
    <p>Vrai</p>
@elseif($autre_condition)
    <p>Autre cas</p>
@else
    <p>Faux</p>
@endif

{{-- Boucles --}}
@foreach($etudiants as $etudiant)
    <p>{{ $etudiant->nom }}</p>
@endforeach

@for($i = 0; $i < 10; $i++)
    <p>Itération {{ $i }}</p>
@endfor

@while($condition)
    <p>En boucle</p>
@endwhile

{{-- Vérifier si une variable existe --}}
@isset($variable)
    <p>La variable existe</p>
@endisset

@empty($tableau)
    <p>Le tableau est vide</p>
@endempty

{{-- Include d'autres vues --}}
@include('partials.header')

{{-- Héritage de layout --}}
@extends('layouts.app')

@section('content')
    <p>Contenu de la page</p>
@endsection
```

### Helpers de Laravel

Laravel fournit des fonctions utiles :

```blade
{{-- Générer une URL vers un asset --}}
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

{{-- Générer une URL vers une route nommée --}}
<a href="{{ route('etudiants.index') }}">Liste des étudiants</a>

{{-- Générer une URL --}}
<a href="{{ url('/etudiants') }}">Étudiants</a>

{{-- Token CSRF (obligatoire pour les formulaires) --}}
@csrf

{{-- Méthode HTTP (pour PUT, PATCH, DELETE) --}}
@method('DELETE')

{{-- Afficher les erreurs de validation --}}
@error('nom')
    <div class="error">{{ $message }}</div>
@enderror
```

---

## Exercices pratiques

### Exercice 1 : Créer la page d'accueil

1. Créez une route pour la page d'accueil (`/`)
2. Cette route doit pointer vers `EtudiantController@index`
3. Vérifiez que la page s'affiche en visitant `http://localhost:8000`

### Exercice 2 : Créer la vue liste des étudiants

1. Créez le fichier `resources/views/etudiants/index.blade.php`
2. Affichez les étudiants dans un tableau HTML
3. Utilisez la syntaxe Blade (`@foreach`, `{{ }}`)

### Exercice 3 : Ajouter du style

1. Créez un fichier CSS dans `public/css/style.css`
2. Stylisez votre tableau (bordures, couleurs, hover, etc.)
3. Liez le CSS à votre vue avec `{{ asset('css/style.css') }}`

### Exercice 4 : Ajouter un layout

1. Créez `resources/views/layouts/app.blade.php`
2. Ce layout contiendra la structure HTML de base
3. Modifiez `index.blade.php` pour étendre ce layout

---

## Commandes Artisan utiles

Artisan est l'interface en ligne de commande de Laravel. Voici les commandes essentielles :

```bash
# Afficher toutes les commandes disponibles
php artisan list

# Afficher l'aide d'une commande
php artisan help make:controller

# Démarrer le serveur de développement
php artisan serve

# Créer un contrôleur
php artisan make:controller NomController

# Créer un modèle
php artisan make:model NomModele

# Créer un modèle avec migration
php artisan make:model NomModele -m

# Créer une migration
php artisan make:migration create_table_name

# Exécuter les migrations
php artisan migrate

# Annuler la dernière migration
php artisan migrate:rollback

# Effacer le cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Afficher les routes
php artisan route:list

# Générer la clé de l'application
php artisan key:generate
```

---

## Checklist de la séance 1

Avant de passer à la séance 2, assurez-vous de maîtriser :

- [ ] Qu'est-ce qu'un framework et pourquoi utiliser Laravel
- [ ] Comment installer Laravel avec Composer
- [ ] La structure des dossiers d'un projet Laravel
- [ ] Le rôle de chaque composant MVC
- [ ] Comment créer une route dans `routes/web.php`
- [ ] Comment créer un contrôleur avec Artisan
- [ ] Comment créer une vue Blade
- [ ] La syntaxe de base de Blade (@foreach, {{ }}, @if, etc.)
- [ ] Comment passer des données du contrôleur à la vue
- [ ] Comment lier un fichier CSS à une vue
- [ ] Les commandes Artisan de base

---

## Ressources complémentaires

- **Documentation officielle** : [laravel.com/docs](https://laravel.com/docs)
- **Laracasts** : [laracasts.com](https://laracasts.com) - Tutoriels vidéo
- **Laravel News** : [laravel-news.com](https://laravel-news.com) - Actualités
- **Communauté francophone** : [laravel.fr](https://laravel.fr)

---

## Préparation pour la séance 2

Dans la prochaine séance, nous allons :

1. **Découvrir les migrations** : Créer la structure de notre base de données
2. **Créer le modèle Etudiant** : Interagir avec la table `etudiants`
3. **Implémenter le CRUD complet** :
   - **C**reate : Ajouter un étudiant
   - **R**ead : Afficher la liste et les détails
   - **U**pdate : Modifier un étudiant
   - **D**elete : Supprimer un étudiant

Assurez-vous d'avoir bien compris les concepts de cette première séance, car ils sont la fondation de tout ce qui suit !

---

**Bonne formation et bon courage !**
