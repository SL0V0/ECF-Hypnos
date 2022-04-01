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

    if(strlen($donneesAjax['nom']) !== 0 && strlen($donneesAjax['ville']) !== 0 && strlen($donneesAjax['adresse'])  !== 0 && strlen($donneesAjax['description']) !== 0)
    {
        $nom = htmlspecialchars($donneesAjax['nom']);
        $ville = htmlspecialchars($donneesAjax['ville']);
        $adresse = htmlspecialchars($donneesAjax['adresse']);
        $description = htmlspecialchars($donneesAjax['description']);

        $errorDonnees = [

            "nom" => 0,
            "ville" => 0,
            "adresse" => 0,
            "description" => 0
        ];

        if(strlen($nom) > 255 || strlen($nom) < 1)
        {
            $errorDonnees['nom'] = 1;
        }
        if(strlen($ville) > 255 || strlen($ville) < 1)
        {
            $errorDonnees['ville'] = 1;
        }
        if(strlen($adresse) > 255 || strlen($adresse) < 1)
        {
            $errorDonnees['adresse'] = 1;
        }
        if(strlen($adresse) > 2000 || strlen($adresse) < 1)
        {
            $errorDonnees['description'] = 1;
        }

        echo json_encode($errorDonnees);

        if($errorDonnees['nom'] == 0 && $errorDonnees['ville'] == 0 && $errorDonnees['adresse'] == 0 && $errorDonnees['description'] == 0)
        {

            $requette = $bdd->prepare('INSERT INTO etablissements(nom, ville, adresse, description) VALUES(:nom, :ville, :adresse, :description)');

            $requette->execute(array(
                'nom' => $nom,
                'ville' => $ville,
                'adresse' => $adresse,
                'description' => $description
            ));
        }
    }
?>