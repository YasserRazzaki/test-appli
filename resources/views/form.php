<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <form method="post" action="/inscription">
        @csrf
        <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <input type="text" name="first_name" placeholder="Prénom" required><br>
        <input type="text" name="last_name" placeholder="Nom" required><br>
        <input type="date" name="date_of_birth" placeholder="Date de naissance" required><br>
        <input type="text" name="gender" placeholder="Genre" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
