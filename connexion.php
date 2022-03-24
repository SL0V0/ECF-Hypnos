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

    if(!empty($_SESSION['token']))
    {
        header('Location: compte.php');

    }else if(!empty($_POST['email']) && !empty($_POST['mdp'])) {
        
        $email = htmlspecialchars($_POST['email']);
        $mdp = htmlspecialchars($_POST['mdp']);

        $requette = $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $requette->execute(array($email));
        $donnees = $requette->fetch();

        if(!$donnees) {

            include("include/error_connexion.php");
            include("include/main.connexion.php");

        }else if(!password_verify($mdp, $donnees['mot_de_passe'])) {

            include("include/error_connexion.php");
            include("include/main.connexion.php");

        }else {

            session_start();
            $_SESSION['token'] = $donnees['token'];
            include("include/succes_connexion.php");
            header('Refresh: 3; compte.php');
        }

    }else {

        include("include/main.connexion.php");
    }

    ?>
