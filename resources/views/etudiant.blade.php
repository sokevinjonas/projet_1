<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .actions button {
            margin-right: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Voici la liste des étudiants</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom complet</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($etudiants as $etudiant)
            <tr>
                <td>{{ $etudiant['id'] }}</td>
                <td>{{ $etudiant['nom'] }}</td>
                <td>{{ $etudiant['email'] }}</td>
                <td class="actions">
                    <button onclick="alert('Voir étudiant')">Voir</button>
                    <button onclick="alert('Modifier étudiant')">Modifier</button>
                    <button onclick="alert('Supprimer étudiant')">Supprimer</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
