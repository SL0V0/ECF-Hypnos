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
    <link rel="stylesheet" href="css/reservation.css">
    <title>Réservation</title>
</head>
<body>
    <?php include("include/header.php"); ?>

    <main>
        <form action="reservation.php" method="POST">
            <h1>Réservation</h1>

            <label for="etablissement">Etablissement</label>
            <select name="etablissement" id="etablissement" onchange="choixEtablissement()">
            <option value="">Choisissez un établissement</option>
                <?php
                    $requette = $bdd->query('SELECT * FROM etablissements');
                    while($donnees = $requette->fetch())
                    {
                        echo "<option value='" . $donnees['ville'] . "'>" . $donnees['ville'] . "</option>";
                    }
                ?>
            </select>
            <div class="divError">Etablissement incorrect</div>

            <label for="suite">Suite</label>
            <select name="suite" id="suite">
                <option value="">ez</option>
            </select>
            <div class="divError">Suite incorrecte</div>

            <label for="adresse">Date d'arrivée</label>
            <input type="date" name="adresse" id="adresse">
            <div class="divError">Date d'arrivée incorrecte</div>

            <label for="description">Date de départ</label>
            <input type="date" name="description" id="description">
            <div class="divError">Date de départ incorrecte</div>

            <div>
                <input id="btnSubmit" type="submit" value="CONFIRMER">
            </div>
        </form>
    </main>

    <?php include("include/footer.php"); ?>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/reservation.js"></script>
</body>
</html>