<?php

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=hypnos', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

?>