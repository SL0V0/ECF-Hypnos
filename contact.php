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
    <link rel="stylesheet" href="css/contact.css">
    <title>Nous contacter</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <form action="" method="post">
            <h1>Nous contacter</h1>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom">
            <div class="divError">Nom invalide</div>

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom">
            <div class="divError">Prénom invalide</div>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email">
            <div class="divError">E-mail invalide</div>

            <label for="sujet">Sujet</label>
            <select name="sujet" id="sujet">
                <option value="reclamation">Je souhaite poser une réclamation</option>
                <option value="serviceSupp">Je souhaite commander un service supplémentaire</option>
                <option value="infoPlusSuite">Je souhaite en savoir plus sur une suite</option>
                <option value="problemeApp">J’ai un souci avec cette application</option>
            </select>

            <label for="message">Message</label>
            <textarea name="message" id="message" rows="5"  placeholder="Ecrivez votre message"></textarea>
            <div class="divError">2000 caractères maximum</div>

            <div class="divBtnSubmit">
                <input id="btnSubmit" type="submit" value="CONFIRMER">
            </div>
        </form>
    </main>
    <?php include("include/footer.php"); ?>
    <script src="js/contact.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
</body>
</html>