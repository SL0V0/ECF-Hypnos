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
    <link rel="stylesheet" href="css/paramAdminHeaderFooter.css">
    <link rel="stylesheet" href="css/ajoutsuite.css">
    <title>Ajouter une suite</title>
</head>
<body>
    <?php include("include/adminHeader.php"); ?>

    <main>
        <form action="" method="POST" id="form" enctype="multipart/form-data">
            <h1>Ajouter une suite</h1>

            <label for="nom">Titre</label>
            <input type="text" id="titre" name="titre">
            <div class="divError">Titre incorrect</div>

            <label for="prix">Prix</label>
            <input type="number" id="prix" name="prix">
            <div class="divError">Prix incorrect</div>
    
            <label for="lien">Lien Booking.com</label>
            <input type="text" name="lien" id="lien">
            <div class="divError">Lien incorrect</div>

            <label for="couverture">Image de couverture</label>
            <input type="file" accept=".png, .jpg, .jpeg" name="couverture" id="couverture">
            <div class="divError">Aucune image ou format incorrect</div>

            <label for="gallerie">Images de la gallerie</label>
            <input type="file" accept=".png, .jpg, .jpeg" multiple name="gallerie[]" id="gallerie">
            <div class="divError">Aucune image ou format incorrect</div>

            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" placeholder="Description de la suite"></textarea>
            <div class="divError">Desciption incorrecte</div>

            <div>
                <input id="btnSubmit" type="submit" value="CONFIRMER">
            </div>
        </form>
    </main>
    <?php include("include/adminFooter.php"); ?>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/suite.js"></script>
</body>
</html>