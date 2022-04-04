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

    if(strlen($donneesAjax['nom']) !== 0 && strlen($donneesAjax['ville']) !== 0 && strlen($donneesAjax['adresse'])  !== 0 && strlen($donneesAjax['description']) !== 0 && strlen($donneesAjax['id']) !== 0)
    {
        $nom = htmlspecialchars($donneesAjax['nom']);
        $ville = htmlspecialchars($donneesAjax['ville']);
        $adresse = htmlspecialchars($donneesAjax['adresse']);
        $description = htmlspecialchars($donneesAjax['description']);
        $id = htmlspecialchars($donneesAjax['id']);

        $errorDonnees = [

            "nom" => 0,
            "ville" => 0,
            "adresse" => 0,
            "description" => 0,
            "id" => 0
        ];

        $requette = $bdd->prepare('SELECT * FROM etablissements WHERE id = ?');
        $requette->execute(array($id));
        $donnees = $requette->fetch();

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
        if(strlen($description) > 2000 || strlen($description) < 1)
        {
            $errorDonnees['description'] = 1;
        }
        if($donnees == false)
        {
            $errorDonnees['id'] = 1;
        }

        echo json_encode($errorDonnees);

        if($errorDonnees['nom'] == 0 && $errorDonnees['ville'] == 0 && $errorDonnees['adresse'] == 0 && $errorDonnees['description'] == 0 && $errorDonnees['id'] = 1)
        {
            $requette->closeCursor();

            $requette = $bdd->prepare('UPDATE etablissements SET nom = ?, ville = ?, adresse = ?, description = ? WHERE id = ?');
            $requette->execute(array($nom, $ville, $adresse, $description, $id));

            $requette->closeCursor();
        }
    }
?>