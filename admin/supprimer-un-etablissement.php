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

$requette = $bdd->prepare('DELETE FROM etablissements WHERE id = ?');
$requette->execute(array($_GET['id']));

$requette->closeCursor();

header('Location: administration.php');

?>