<?php

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=hypnos', 'root', 'root');
    }
        catch(Exception $e)
    {
    die('Erreur : '.$e->getMessage());
    }

    $donneesAjax = json_decode($_POST['donnees'], true);

    if(strlen($donneesAjax['nom']) !== 0 && strlen($donneesAjax['prenom']) !== 0 && strlen($donneesAjax['email'])  !== 0 && strlen($donneesAjax['sujet']) !== 0 && strlen($donneesAjax['message']) !== 0)
    {
        $nom = htmlspecialchars($donneesAjax['nom']);
        $prenom = htmlspecialchars($donneesAjax['prenom']);
        $email = htmlspecialchars($donneesAjax['email']);
        $sujet = htmlspecialchars($donneesAjax['sujet']);
        $message = htmlspecialchars($donneesAjax['message']);

        $errorDonnees = [

            "email" => 0,
            "nom" => 0,
            "prenom" => 0,
            "sujet" => 0,
            "message" => 0
        ];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255 || strlen($email) < 6)
        {
            $errorDonnees['email'] = 1;
        }
        if(strlen($nom) > 40 || strlen($nom) < 2)
        {
            $errorDonnees['nom'] = 1;
        }
        if(strlen($prenom) > 40 || strlen($prenom) < 2)
        {
            $errorDonnees['prenom'] = 1;
        }
        if($sujet !== "reclamation" && $sujet !== "serviceSupp" && $sujet !== "infoPlusSuite" && $sujet !== "problemeApp")
        {
            $errorDonnees['sujet'] = 1;
        }
        if(strlen($message) > 2000 || strlen($message) < 1)
        {
            $errorDonnees['message'] = 1;
        }

        echo json_encode($errorDonnees);

        if($errorDonnees['email'] == 0 && $errorDonnees['nom'] == 0 && $errorDonnees['prenom'] == 0 && $errorDonnees['sujet'] == 0 && $errorDonnees['message'] == 0)
        {

            $requette = $bdd->prepare('INSERT INTO contact(nom, prenom, email, sujet, message) VALUES(:nom, :prenom, :email, :sujet, :message)');

            $requette->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'sujet' => $sujet,
                'message' => $message
            ));
        }
    }
?>