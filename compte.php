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
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paramHeaderFooter.css">
    <link rel="stylesheet" href="admin/css/administration.css">
    <title>Aministration</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <form action="administration.php">
            <label for="nom">Nom de l'établissement</label>
            <input type="text" id="nom" name="nom">

            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville">

            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse">

            <label for="description">Description</label>
            <input type="text" name="description" id="description">

            <div>
                <input type="submit" value="confirmer">
            </div>
        </form>
    </main>
    <?php include("include/footer.php"); ?>
    <script src="admin/js/administration.js"></script>
</body>
</html>