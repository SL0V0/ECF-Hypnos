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

    if(strlen($donneesAjax['nom']) !== 0 && strlen($donneesAjax['prenom']) !== 0 && strlen($donneesAjax['email'])  !== 0 && strlen($donneesAjax['password']) !== 0 && strlen($donneesAjax['confPass']) !== 0)
    {
        $nom = htmlspecialchars($donneesAjax['nom']);
        $prenom = htmlspecialchars($donneesAjax['prenom']);
        $email = htmlspecialchars($donneesAjax['email']);
        $mdp = htmlspecialchars($donneesAjax['password']);
        $confMdp = htmlspecialchars($donneesAjax['confPass']);

        $errorDonnees = [

            "email" => 0,
            "nom" => 0,
            "prenom" => 0,
            "mdp" => 0,
            "confMdp" => 0
        ];

        $requette = $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $requette->execute(array($email));
        $donnees = $requette->fetch();

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $donnees || strlen($email) > 40 || strlen($email) < 6)
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
        if(strlen($mdp) < 6 || strlen($mdp) > 60)
        {
            $errorDonnees['mdp'] = 1;
        }
        if($mdp !== $confMdp)
        {
            $errorDonnees['confMdp'] = 1;
        }

        echo json_encode($errorDonnees);

        if($errorDonnees['email'] == 0 && $errorDonnees['nom'] == 0 && $errorDonnees['prenom'] == 0 && $errorDonnees['mdp'] == 0 && $errorDonnees['confMdp'] == 0)
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
            $role = "CLIENT";

            $requette = $bdd->prepare('INSERT INTO user(nom, prenom, email, mot_de_passe, token, role) VALUES(:nom, :prenom, :email, :mot_de_passe, :token, :role)');

            $requette->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mot_de_passe' => $mdp,
                'token' => $token,
                'role' => $role
            ));
        }
    }
?>