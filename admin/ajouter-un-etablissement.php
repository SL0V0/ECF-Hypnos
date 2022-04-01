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
    <link rel="stylesheet" href="css/ajoutetablissement.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Aministration</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <form action="administration.php" method="POST">
            <h1>Ajouter un établissement</h1>

            <label for="nom">Nom de l'établissement</label>
            <input type="text" id="nom" name="nom">
            <div class="divError">Nom incorrect</div>

            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville">
            <div class="divError">Ville incorrect</div>

            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse">
            <div class="divError">Adresse incorrect</div>

            <label for="description">Description</label>
            <input type="text" name="description" id="description">
            <div class="divError">Desciption incorrect</div>

            <div>
                <input id="btnSubmit" type="submit" value="CONFIRMER">
            </div>
        </form>
    </main>
    <?php include("include/footer.php"); ?>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/etablissement.js"></script>
</body>
</html>