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

    if(empty($_GET['ville']))
    {
        header('Location: index.php');
        die();
    }

    $requette = $bdd->prepare('SELECT * FROM etablissements WHERE ville = ?');
    $requette->execute(array($_GET['ville']));
    $donnees = $requette->fetch();

    if(!$donnees)
    {
        header('Location: index.php');
        die();
    }

    $information = $donnees;

    $requette->closeCursor();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paramHeaderFooter.css">
    <link rel="stylesheet" href="css/suites.css">
    <title><?php echo $information['nom']; ?></title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <article class="articleMain">
            <section class="sectionTitre">
                <h1 class="Titre">Suites de l'établissement de <?php echo $information['ville']; ?></h1>
            </section>
            <section class="sectionListeSuites">
                
                <?php
                    $requette = $bdd->prepare('SELECT * FROM suites WHERE ville = ?');
                    $requette->execute(array($information['ville']));
                    while($donnees = $requette->fetch())
                    {
                        echo "<div class='divSuite' href='#'>";
                        echo "<div class='divImgSuites'><img class='imgSuites' src='images/suites/" . $donnees['nom_dossier'] . "/0.png' alt='Couverture de la suite'></div>";
                        echo "<div class='infoSuite'>";
                        echo "<div class='classNomPrix'><p class='pNom'>" . $donnees['titre'] . "</p><p class='pPrix'>" . $donnees['prix'] . "€/nuit</p></div>";
                        echo "<div class='nbPersonne'><p class='pNbPersonne'>2 personnes</p></div>";
                        echo "<div class='descriptionSuite'><p class='pDescriptionSuite'>" . $donnees['description'] . "</p></div>";
                        echo "<div class='btnReserver'><a class='aReserver' href='reservation.php?id=" . $donnees['id'] . "'>Réserver</a></div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
            </section>
        </article>
    </main>
    <?php include("include/footer.php"); ?>
</body>
</html>