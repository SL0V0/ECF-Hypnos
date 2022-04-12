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

    $donneesAjax = json_decode($_POST['donnees'], true);
    $couverture = $_FILES['couverture'];
    $gallerie = $_FILES['gallerie'];

    function str_to_noaccent($str)
    {
        $url = $str;
        $url = preg_replace('#Ç#', 'C', $url);
        $url = preg_replace('#ç#', 'c', $url);
        $url = preg_replace('#è|é|ê|ë#', 'e', $url);
        $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
        $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
        $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
        $url = preg_replace('#ì|í|î|ï#', 'i', $url);
        $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
        $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
        $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
        $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
        $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
        $url = preg_replace('#ý|ÿ#', 'y', $url);
        $url = preg_replace('#Ý#', 'Y', $url);
        $url = preg_replace('# #', '_', $url);
        
        return ($url);
    }

    $requette = $bdd->prepare('SELECT * FROM user WHERE token = ? AND role = "GERANT"');
    $requette->execute(array($_SESSION['token']));
    $donnees = $requette->fetch();

    if(!empty($donneesAjax['titre']) && !empty($donneesAjax['prix']) && !empty($donneesAjax['lien']) && !empty($donneesAjax['description']) && !empty($couverture) && $couverture['error'] == 0 && !empty($gallerie) && $donnees)
    {
        $titre = htmlspecialchars($donneesAjax['titre']);
        $prix = htmlspecialchars($donneesAjax['prix']);
        $lien = htmlspecialchars($donneesAjax['lien']);
        $description = htmlspecialchars($donneesAjax['description']);

        $errorDonnees = [

            "titre" => 0,
            "prix" => 0,
            "lien" => 0,
            "description" => 0,
            "couverture" => 0,
            "gallerie" => 0
        ];

        if(strlen($titre) > 255 || strlen($titre) < 1)
        {
            $errorDonnees['titre'] = 1;
        }
        if(strlen($prix) > 5 || strlen($prix) < 1)
        {
            $errorDonnees['prix'] = 1;
        }
        if(strlen($lien) < 1)
        {
            $errorDonnees['lien'] = 1;
        }
        if(strlen($description) > 2000 || strlen($description) < 1)
        {
            $errorDonnees['description'] = 1;
        }

        $infosfichier = pathinfo($couverture['name']);
        $extensionImage = $infosfichier['extension'];
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $nomDossier = str_to_noaccent($titre);

        if($couverture['size'] > 10000000 || !in_array($extensionImage, $allowedExtensions))
        {
            $errorDonnees['couverture'] = 1;
        }

        $totalGalerie = count($gallerie['tmp_name']);

        for($i = 0; $i < $totalGalerie; $i++)
        {
            $infosFichierGallerie = pathinfo($gallerie['name'][$i]);
            $extensionImageGallerie = $infosFichierGallerie['extension'];

            if($gallerie['size'][$i] > 10000000 || !in_array($extensionImageGallerie, $allowedExtensions))
            {
                $errorDonnees['gallerie'] = 1;
            }
        }

        echo json_encode($errorDonnees);

        if($errorDonnees['titre'] == 0 && $errorDonnees['prix'] == 0 && $errorDonnees['lien'] == 0 && $errorDonnees['description'] == 0 && $errorDonnees['couverture'] == 0 && $errorDonnees['gallerie'] == 0)
        {
            mkdir("../../../images/suites/" . $nomDossier, 0777);
            move_uploaded_file($couverture['tmp_name'], '../../../images/suites/' . $nomDossier . '/0.png');

            $compteur = 1;

            for($g = 0; $g < $totalGalerie; $g++)
            {
                move_uploaded_file($gallerie['tmp_name'][$g], '../../../images/suites/' . $nomDossier . '/' . $compteur . '.png');
                $compteur++;
            }
            
            $ville = $donnees['ville'];

            $requette->closeCursor();

            $requette = $bdd->prepare('INSERT INTO suites(titre, prix, lien, description, nom_dossier, nombre_image, ville) VALUES(:titre, :prix, :lien, :description, :nom_dossier, :nombre_image, :ville)');
            $requette->execute(array(
                'titre' => $titre,
                'prix' => $prix,
                'lien' => $lien,
                'description' => $description,
                'nom_dossier' => $nomDossier,
                'nombre_image' => $totalGalerie,
                'ville' => $ville
            ));
        }
    }
?>