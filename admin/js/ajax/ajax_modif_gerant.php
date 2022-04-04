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

    if(strlen($donneesAjax['nom']) !== 0 && strlen($donneesAjax['prenom']) !== 0  && strlen($donneesAjax['email']) !== 0  && strlen($donneesAjax['ville']) !== 0 && strlen($donneesAjax['mdp']) !== 0 && strlen($donneesAjax['confPass']) !== 0 && strlen($donneesAjax['id']) !== 0)
    {
        $nom = htmlspecialchars($donneesAjax['nom']);
        $prenom = htmlspecialchars($donneesAjax['prenom']);
        $email = htmlspecialchars($donneesAjax['email']);
        $ville = htmlspecialchars($donneesAjax['ville']);
        $mdp = htmlspecialchars($donneesAjax['mdp']);
        $confPass = htmlspecialchars($donneesAjax['confPass']);
        $id = htmlspecialchars($donneesAjax['id']);

        $errorDonnees = [

            "nom" => 0,
            "prenom" => 0,
            "email" => 0,
            "ville" => 0,
            "mdp" => 0,
            "confPass" => 0,
            "id" => 0
        ];

        $requette = $bdd->prepare('SELECT * FROM user WHERE id = ? AND role = "GERANT"');
        $requette->execute(array($id));
        $donnees = $requette->fetch();

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
        if(strlen($ville) > 255 || strlen($ville) < 1)
        {
            $errorDonnees['ville'] = 1;
        }
        if(strlen($mdp) > 60 || strlen($mdp) < 6)
        {
            $errorDonnees['mdp'] = 1;
        }
        if($mdp !== $confPass)
        {
            $errorDonnees['confPass'] = 1;
        }
        if($donnees == false)
        {
            $errorDonnees['id'] = 1;
        }

        echo json_encode($errorDonnees);

        if($errorDonnees['nom'] == 0 && $errorDonnees['prenom'] == 0 && $errorDonnees['email'] == 0  && $errorDonnees['ville'] == 0  && $errorDonnees['mdp'] == 0  && $errorDonnees['confPass'] == 0 && $errorDonnees['id'] == 0)
        {
            $requette->closeCursor();

            function token($length=60){
                $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.-_';
                $string = '';
                for($i=0; $i<$length; $i++){
                    $string .= $chars[rand(0, strlen($chars)-1)];
                }
                return $string;
            }
        
              $donnees = true;
        
              while($donnees) {
        
              $token = token();
        
              $requette = $bdd->prepare('SELECT * FROM user WHERE token = ?');
              $requette->execute(array($token));
              $donnees = $requette->fetch();
        
            }

            $requette->closeCursor();

            $mdp = password_hash($mdp, PASSWORD_DEFAULT);
            $role = "GERANT";

            $requette = $bdd->prepare('UPDATE user SET nom = ?, prenom = ?, email = ?, mot_de_passe = ?, token = ?, ville = ?, role = ? WHERE id = ? AND role = "GERANT"');

            $requette->execute(array($nom, $prenom, $email, $mdp, $token, $ville, $role, $id));
        }
    }
?>