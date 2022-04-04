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

$requette = $bdd->prepare('SELECT * FROM user WHERE id = ? AND role = "GERANT"');
$requette->execute(array($_GET['id']));
$donnees = $requette->fetch();

if(!$donnees)
{
    header('Location: administration.php');
    die();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paramAdminHeaderFooter.css">
    <link rel="stylesheet" href="css/modifgerant.css">
    <title>Modifier un gérant</title>
</head>
<body>
    <?php include("include/adminHeader.php"); ?>
    <main>
        <form action="administration.php" method="POST">
            <h1>Modifier un gérant</h1>

            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo $donnees['nom']; ?>">
            <div class="divError">Nom incorrect</div>

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="<?php echo $donnees['prenom'] ?>">
            <div class="divError">Prénom incorrect</div>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="<?php echo $donnees['email'] ?>">
            <div class="divError">E-mail incorrect</div>

            <label for="Ville">Ville</label>
            <select name="ville" id="ville">
                <?php
                   
                   echo "<option value=''>Choississez une ville</option>";

                   $requette->closeCursor();

                    $requette = $bdd->query('SELECT ville FROM etablissements');
                    while($donnees = $requette->fetch())
                    {
                        echo "<option value='". $donnees['ville'] ."'>". $donnees['ville'] ."</option>";
                    }
                ?>
            </select>
            <div class="divError">Choississez une ville</div>

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
    <?php include("include/adminFooter.php"); ?>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/modif_gerant.js"></script>
</body>
</html>