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
    header('Location: ../connexion.php');
    die();
}

$requette = $bdd->prepare('SELECT * FROM user WHERE token = ? AND role = "GERANT"');
$requette->execute(array($_SESSION['token']));
$donnees = $requette->fetch();

if(!$donnees)
{
    header('Location: ../connexion.php');
    die();
}

$ville = $donnees['ville'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paramAdminHeaderFooter.css">
    <link rel="stylesheet" href="css/gerant.css">
    <title>Gerant</title>
</head>
<body>
    <?php include("include/adminheader.php"); ?>
    <main>
        <h2>Suites de <?php echo $donnees['ville'] ?></h2>
        <div class="divParentSuite">
            <div class="ajoutSuite">
                <a id="btnAjoutSuite" href="ajouter-une-suite.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                </a>
            </div>
            <?php

                $requette->closeCursor();

                $requette = $bdd->prepare('SELECT * FROM suites WHERE ville = ?');
                $requette->execute(array($ville));
                while($donnees = $requette->fetch())
                {
                    echo "<div class='divEnfantSuite'>";
                    echo "<h3>". $donnees['titre'] ."</h3>";
                    echo "<p class='pType'>Prix</p>";
                    echo "<p class='pTypeValeur'>". $donnees['prix'] ."</p>";
                    echo "<p class='pType'>Lien Booking.com</p>";
                    echo "<p class='pTypeValeur'>". $donnees['lien'] ."</p>";
                    echo "<p class='pType'>Description</p>";
                    echo "<p class='pTypeValeur'>". $donnees['description'] ."</p>";
                    echo "<p class='pType'>Nombre d'images</p>";
                    echo "<p class='pTypeValeur'>". $donnees['nombre_image'] ."</p>";
                    echo "<p class='pType'>Ville</p>";
                    echo "<p class='pTypeValeur'>". $donnees['ville'] ."</p>";
                    echo "<div class='divModifSuppr'>";
                    echo "<p class='pModifier'><a class='aModif' href='modifier-une-suite.php?id=" . $donnees['id'] . "'>Modifier</a></p>";
                    echo "<p class='pSuppr'><a class='aSuppr' href='supprimer-une-suite.php?id=" . $donnees['id'] . "'>Supprimer</a></p>";
                    echo "</div>";
                    echo "</div>";
                }
                $requette->closeCursor();
            ?>
            
        </div>
    </main>
    <?php include("include/adminFooter.php"); ?>
</body>
</html>