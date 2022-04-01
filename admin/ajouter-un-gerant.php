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

if(empty($_SESSION['token']))
{
    header('Location: connexion.php');
}else
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/ajoutgerant.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Ajouter un gérant</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <form action="administration.php" method="POST">
            <h1>Ajouter un gérant</h1>

            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom">
            <div class="divError">Nom incorrect</div>

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom">
            <div class="divError">Prénom incorrect</div>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email">
            <div class="divError">E-mail incorrect</div>

            <label for="Ville">Ville</label>
            <select name="ville" id="ville">
                <?php
                    $requette = $bdd->query('SELECT ville FROM etablissements');
                    while($donnees = $requette->fetch())
                    {
                        echo "<option value='". $donnees['ville'] ."'>". $donnees['ville'] ."</option>";
                    }
                ?>
            </select>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
            <div class="divError">Mot de passe incorrect</div>

            <label for="confPass">Confimation du mot de passe</label>
            <input type="password" name="confPass" id="confPass">
            <div class="divError">Confimation du mot de passe incorrect</div>

            <div>
                <input id="btnSubmit" type="submit" value="CONFIRMER">
            </div>
        </form>
    </main>
    <?php include("include/footer.php"); ?>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/gerant.js"></script>
</body>
</html>