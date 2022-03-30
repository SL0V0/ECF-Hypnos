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
    header('Location: connexion.php');
}else
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/administration.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Aministration</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <h1>ADMINISTRATION</h1>
        <h2>Etablissements</h2>
        <div class="divParentEtablissement">
            <div class="ajoutEtablissement">
                <a id="btnAjoutEtablissement" href="ajouter-un-etablissement.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                </a>
            </div>
            <div class="divEnfantEtablissement">
                <h3>Marseille</h3>
                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <p class="pType">Adresse</p>
                <p class="pTypeValeur">123 rue de l'adresse</p>

                <p class="pType">Description</p>
                <p class="pTypeValeur">etablissement tres sympatique pouvant acceuiller de nombreux visiteur il est vraiment génial</p>
                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
            <div class="divEnfantEtablissement">
                <h3>Marseille</h3>
                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <p class="pType">Adresse</p>
                <p class="pTypeValeur">123 rue de l'adresse</p>

                <p class="pType">Description</p>
                <p class="pTypeValeur">etablissement tres sympatique pouvant acceuiller de nombreux visiteur il est vraiment génial</p>
                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
            <div class="divEnfantEtablissement">
                <h3>Marseille</h3>
                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <p class="pType">Adresse</p>
                <p class="pTypeValeur">123 rue de l'adresse</p>

                <p class="pType">Description</p>
                <p class="pTypeValeur">etablissement tres sympatique pouvant acceuiller de nombreux visiteur il est vraiment génial</p>
                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
            <div class="divEnfantEtablissement">
                <h3>Marseille</h3>
                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <p class="pType">Adresse</p>
                <p class="pTypeValeur">123 rue de l'adresse</p>

                <p class="pType">Description</p>
                <p class="pTypeValeur">etablissement tres sympatique pouvant acceuiller de nombreux visiteur il est vraiment génial</p>
                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
            <div class="divEnfantEtablissement">
                <h3>Marseille</h3>
                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <p class="pType">Adresse</p>
                <p class="pTypeValeur">123 rue de l'adresse</p>

                <p class="pType">Description</p>
                <p class="pTypeValeur">etablissement tres sympatique pouvant acceuiller de nombreux visiteur il est vraiment génial</p>
                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
        </div>
        <h2>Gérants</h2>
        <div class="divGerantParent">
            <div class="ajoutGerant">
                    <a id="btnAjoutGerant" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                    </a>
            </div>
            <div class="divEnfantGerant">
                <p class="pType">Nom</p>
                <p class="pTypeValeur">Baigneux</p>

                <p class="pType">Prénom</p>
                <p class="pTypeValeur">gerard</p>

                <p class="pType">E-mail</p>
                <p class="pTypeValeur">emailgerant@gmail.com</p>

                <p class="pType">Mot de passe</p>
                <p class="pTypeValeur">dsgrgrfdgreeqgfd</p>

                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
            <div class="divEnfantGerant">
                <p class="pType">Nom</p>
                <p class="pTypeValeur">Baigneux</p>

                <p class="pType">Prénom</p>
                <p class="pTypeValeur">gerard</p>

                <p class="pType">E-mail</p>
                <p class="pTypeValeur">emailgerant@gmail.com</p>

                <p class="pType">Mot de passe</p>
                <p class="pTypeValeur">dsgrgrfdgreeqgfd</p>

                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
            <div class="divEnfantGerant">
                <p class="pType">Nom</p>
                <p class="pTypeValeur">Baigneux</p>

                <p class="pType">Prénom</p>
                <p class="pTypeValeur">gerard</p>

                <p class="pType">E-mail</p>
                <p class="pTypeValeur">emailgerant@gmail.com</p>

                <p class="pType">Mot de passe</p>
                <p class="pTypeValeur">dsgrgrfdgreeqgfd</p>

                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
            <div class="divEnfantGerant">
                <p class="pType">Nom</p>
                <p class="pTypeValeur">Baigneux</p>

                <p class="pType">Prénom</p>
                <p class="pTypeValeur">gerard</p>

                <p class="pType">E-mail</p>
                <p class="pTypeValeur">emailgerant@gmail.com</p>

                <p class="pType">Mot de passe</p>
                <p class="pTypeValeur">dsgrgrfdgreeqgfd</p>

                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
            <div class="divEnfantGerant">
                <p class="pType">Nom</p>
                <p class="pTypeValeur">Baigneux</p>

                <p class="pType">Prénom</p>
                <p class="pTypeValeur">gerard</p>

                <p class="pType">E-mail</p>
                <p class="pTypeValeur">emailgerant@gmail.com</p>

                <p class="pType">Mot de passe</p>
                <p class="pTypeValeur">dsgrgrfdgreeqgfd</p>

                <p class="pType">Ville</p>
                <p class="pTypeValeur">Marseille</p>

                <div class="divModifSuppr">
                    <p class="pModifier">Modifier</p>
                    <p class="pSuppr">Supprimer</p>
                </div>
            </div>
            
        </div>
    </main>
    <?php include("include/footer.php"); ?>
    <script src="js/administration.js"></script>
</body>
</html>