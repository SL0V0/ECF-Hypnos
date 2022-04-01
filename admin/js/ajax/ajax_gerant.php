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

    if(strlen($donneesAjax['nom']) !== 0 && strlen($donneesAjax['prenom'])  && strlen($donneesAjax['email'])  && strlen($donneesAjax['ville'])  && strlen($donneesAjax['mdp'])  && strlen($donneesAjax['confPass']) )
    {
        $nom = htmlspecialchars($donneesAjax['nom']);
        $prenom = htmlspecialchars($donneesAjax['prenom']);
        $email = htmlspecialchars($donneesAjax['email']);
        $ville = htmlspecialchars($donneesAjax['ville']);
        $mdp = htmlspecialchars($donneesAjax['mdp']);
        $confPass = htmlspecialchars($donneesAjax['confPass']);

        $errorDonnees = [

            "nom" => 0,
            "prenom" => 0,
            "email" => 0,
            "ville" => 0,
            "mdp" => 0,
            "confPass" => 0
        ];

        $requette = $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $requette->execute(array($email));
        $donnees = $requette->fetch();

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $donnees || strlen($email) > 255 || strlen($email) < 6)
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

        echo json_encode($errorDonnees);

        if($errorDonnees['nom'] == 0 && $errorDonnees['prenom'] == 0 && $errorDonnees['email'] == 0  && $errorDonnees['ville'] == 0  && $errorDonnees['mdp'] == 0  && $errorDonnees['confPass'] == 0 )
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

            $requette = $bdd->prepare('INSERT INTO user(nom, prenom, email, mot_de_passe, token, ville, role) VALUES(:nom, :prenom, :email, :mot_de_passe, :token, :ville, :role)');

            $requette->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mot_de_passe' => $mdp,
                'token' => $token,
                'ville' => $ville,
                'role' => $role
            ));
        }
    }
?>