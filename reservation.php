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
    <title>Reservation</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>

    </main>
    <?php include("include/footer.php"); ?>
    <script src="js/jquery-3.6.0.min.js"></script>
</body>
</html>