<?php

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=hypnos', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paramHeaderFooter.css">
    <link rel="stylesheet" href="css/inscription.css">
    <title>Inscription</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <form action="inscription.php" method="POST">
            <h1>Inscription</h1>
            <div class="divLabInp">
                <label for="nom">Nom</label>
                <input type="text" name="nom" maxlength="40" id="nom" required>
                <div class="divError">2 caractères minimums et 40 maximum</div>

                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" maxlength="40" required>
                <div class="divError">2 caractères minimums et 40 maximum</div>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" maxlength="60" required>
                <div class="divError">E-mail existant ou invalide</div>

                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" maxlength="60" required>
                <div class="divError">6 caractères minimums et 60 caractères maximum</div>

                <label for="confmdp">Confirmation mot de passe</label>
                <input type="password" name="confmdp" id="confmdp" maxlength="60" required>
                <div class="divError">Ne correspond pas au mot de passe</div>
            </div>
            <div class="divBtnLink">
                <input id="btnSubmit" type="submit" value="INSCRIPTION">
                <a href="connexion.php">Se connecter ?</a>
            </div>
        </form>
    </main>
    <?php include("include/footer.php"); ?>
    <script src="js/inscription.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>

</body>
</html>