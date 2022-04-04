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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paramAdminHeaderFooter.css">
    <link rel="stylesheet" href="css/administration.css">
    <title>Aministration</title>
</head>
<body>
    <?php include("include/adminheader.php"); ?>
    <main>
        <h2>Etablissements</h2>
        <div class="divParentEtablissement">
            <div class="ajoutEtablissement">
                <a id="btnAjoutEtablissement" href="ajouter-un-etablissement.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                </a>
            </div>
            <?php
                $requette = $bdd->query('SELECT * FROM etablissements');
                while($donnees = $requette->fetch())
                {
                    echo "<div class='divEnfantEtablissement'>";
                    echo "<h3>". $donnees['nom'] ."</h3>";
                    echo "<p class='pType'>Ville</p>";
                    echo "<p class='pTypeValeur'>". $donnees['ville'] ."</p>";
                    echo "<p class='pType'>Adresse</p>";
                    echo "<p class='pTypeValeur'>". $donnees['adresse'] ."</p>";
                    echo "<p class='pType'>Description</p>";
                    echo "<p class='pTypeValeur'>". $donnees['description'] ."</p>";
                    echo "<div class='divModifSuppr'>";
                    echo "<p class='pModifier'><a class='aModif' href='modifier-un-etablissement.php?id=" . $donnees['id'] . "'>Modifier</a></p>";
                    echo "<p class='pSuppr'><a class='aSuppr' href='supprimer-un-etablissement.php?id=" . $donnees['id'] . "'>Supprimer</a></p>";
                    echo "</div>";
                    echo "</div>";
                }
                $requette->closeCursor();
            ?>
            
        </div>
        <h2>Gérants</h2>
        <div class="divGerantParent">
            <div class="ajoutGerant">
                    <a id="btnAjoutGerant" href="ajouter-un-gerant.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                    </a>
            </div>
            <?php
                $requette = $bdd->query('SELECT * FROM user WHERE role = "GERANT"');
                while($donnees = $requette->fetch())
                {
                    echo "<div class='divEnfantGerant'>";
                    echo "<p class='pType'>Nom</p>";
                    echo "<p class='pTypeValeur'>". $donnees['nom'] ."</p>";
                    echo "<p class='pType'>Prénom</p>";
                    echo "<p class='pTypeValeur'>". $donnees['prenom'] ."</p>";
                    echo "<p class='pType'>E-mail</p>";
                    echo "<p class='pTypeValeur'>". $donnees['email'] ."</p>";
                    echo "<p class='pType'>Ville</p>";
                    echo "<p class='pTypeValeur'>". $donnees['ville'] ."</p>";
                    echo "<div class='divModifSuppr'>";
                    echo "<p class='pModifier'><a class='aModif' href='modifier-un-gerant.php?id=" . $donnees['id'] . "'>Modifier</a></p>";
                    echo "<p class='pSuppr'><a class='aSuppr' href='supprimer-un-gerant.php?id=" . $donnees['id'] . "'>Supprimer</a></p>";
                    echo "</div>";
                    echo "</div>";
                } 

                $requette->closeCursor();
            ?>
        </div>
    </main>
    <?php include("include/adminFooter.php"); ?>
</body>
</html>