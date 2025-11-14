<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Gestion des Étudiants')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <h1>Gestion des Étudiants</h1>
                <ul>
                    <li><a href="{{ route('home') }}" class="active">Accueil</a></li>
                    <li><a href="{{ route('etudiants.index') }}">Liste des étudiants</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} - Formation Laravel - Séance 1</p>
        </div>
    </footer>
</body>
</html>
