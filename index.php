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
    <link rel="stylesheet" href="css/index.css">
    <title>HYPNOS</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <article class="articleMain">
            <section class="sectionH1">
                <h1>Choisissez une destination parmi nos établissements hôteliers</h1>
            </section>
            <section class="sectionArticleMain">
                <?php
                
                    $requette = $bdd->query('SELECT * FROM etablissements');
                    while($donnees = $requette->fetch())
                    {
                        echo "<div class='divChildVille'><a class='aSectionDestination' href='suites.php?ville=" . $donnees['ville'] . "'>" . $donnees['ville'] . "</a></div>";
                    }
                ?>
            </section>
        </article>
    </main>
    <?php include("include/footer.php"); ?>
</body>
</html>