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
    die();

}else if(empty($_GET['id']))
{
    header('Location: administration.php');
    die();
}

$requette = $bdd->prepare('SELECT * FROM etablissements WHERE id = ?');
$requette->execute(array($_GET['id']));
$donnees = $requette->fetch();

if(!$donnees)
{
    header('Location: administration.php');
    die();
}

$requette->closeCursor();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paramAdminHeaderFooter.css">
    <link rel="stylesheet" href="css/modifetablissement.css">
    <title>Modifier un établissement</title>
</head>
<body>
    <?php include("include/adminHeader.php"); ?>
    <main>
        <form action="administration.php" method="POST">
            <h1>Modifier un établissement</h1>

            <label for="nom">Nom de l'établissement</label>
            <input type="text" id="nom" name="nom" value="<?php echo $donnees['nom']; ?>">
            <div class="divError">Nom incorrect</div>

            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" value="<?php echo $donnees['ville']; ?>">
            <div class="divError">Ville incorrect</div>

            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" value="<?php echo $donnees['adresse']; ?>">
            <div class="divError">Adresse incorrect</div>

            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="<?php echo $donnees['description']; ?>">
            <div class="divError">Desciption incorrect</div>

            <div>
                <input id="btnSubmit" type="submit" value="CONFIRMER">
            </div>
        </form>
    </main>
    <?php include("include/adminFooter.php"); ?>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/modif_etablissement.js"></script>
</body>
</html>