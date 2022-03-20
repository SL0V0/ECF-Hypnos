<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/inscription.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Inscription</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <form action="inscription.php" method="POST">
            <h1>Inscription</h1>
            <div class="divLabInp">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" required>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" required>
                <label for="confmdp">Confirmation mot de passe</label>
                <input type="password" name="confmdp" id="confmdp" required>
            </div>
            <div class="divBtnLink">
                <input type="submit" value="INSCRIPTION">
                <a href="connexion.php">Se connecter ?</a>
            </div>
        </form>
    </main>
    <?php include("include/footer.php"); ?>
</body>
</html>