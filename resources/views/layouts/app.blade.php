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
                    <li><a href="{{ route('etudiants.index') }}" class="{{ request()->routeIs('etudiants.index') ? 'active' : '' }}">Liste des étudiants</a></li>
                    <li><a href="{{ route('etudiants.create') }}" class="{{ request()->routeIs('etudiants.create') ? 'active' : '' }}">Ajouter un étudiant</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            {{-- Messages flash --}}
            @if (session('success'))
                <div class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </svg>
                    {{ session('info') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} - Formation Laravel - Séance 2 (CRUD)</p>
        </div>
    </footer>

    <script>
        // Fermer automatiquement les alerts après 5 secondes
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Confirmation de suppression
        function confirmDelete(event) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')) {
                event.preventDefault();
            }
        }
    </script>
</body>
</html>
