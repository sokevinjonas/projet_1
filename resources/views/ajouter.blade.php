<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un étudiant</title>
    <style>
        form {
            width: 50%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        button {
            padding: 10px 15px;
            cursor: pointer;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Ajouter un étudiant</h2>

<form action="#" method="POST">

    <label>Nom complet</label>
    <input type="text" name="nom" placeholder="Ex: Jean Kaboré" required>

    <label>Email</label>
    <input type="email" name="email" placeholder="Ex: jean@example.com" required>

    <button type="submit">Enregistrer</button>
</form>

</body>
</html>
