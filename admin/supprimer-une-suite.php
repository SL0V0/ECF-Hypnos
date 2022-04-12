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

if(empty($_SESSION['token']))
{
    header('Location: ../connexion.php');
    die();
}

$requette = $bdd->prepare('SELECT * FROM user WHERE token = ? AND role = "GERANT"');
$requette->execute(array($_SESSION['token']));
$donnees = $requette->fetch();

if(!$donnees)
{
    header('Location: ../connexion.php');
    die();
}

function deleteTree($dir){
    foreach(glob($dir . "/*") as $element){
        if(is_dir($element)){
            deleteTree($element); // On rappel la fonction deleteTree           
            rmdir($element); // Une fois le dossier courant vidé, on le supprime
        } else { // Sinon c'est un fichier, on le supprime
            unlink($element);
        }
        // On passe à l'élément suivant
    }
}

$requette = $bdd->prepare('SELECT * FROM suites WHERE id = ?');
$requette->execute(array($_GET['id']));
$donnees = $requette->fetch();

$dir = "../images/suites/" . $donnees['nom_dossier'];
deleteTree($dir); // On vide le contenu de notre dossier
rmdir($dir); // Et on le supprime

$requette->closeCursor();

$requette = $bdd->prepare('DELETE FROM suites WHERE id = ?');
$requette->execute(array($_GET['id']));

$requette->closeCursor();
?>