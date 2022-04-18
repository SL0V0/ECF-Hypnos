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

    $requette = $bdd->prepare('SELECT * FROM suites WHERE id = ?');
    $requette->execute(array($_GET['id']));
    $donnees = $requette->fetch();

    $information = $donnees;

    $requette->closeCursor();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paramHeaderFooter.css">
    <link rel="stylesheet" href="css/detail-suite.css">
    <title><?php echo $information['titre']; ?></title>
</head>
<body>
    <div id="galerie">
        <div id="close">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </a>
        </div>
        <div class="divTitreGalerie">
            <h3><?php echo $information['titre']; ?></h3>
        </div>

        <div id="divCarousel" class="divCarousel">
            <div class="divImgCarousel">
                <?php
                    $compteurImg = 1;
                    for($c = 0; $c < $information['nombre_image']; $c++)
                    {
                        echo "<img class='imgCarousel' style='display: none;' src='images/suites/" . $information['nom_dossier'] . "/" . $compteurImg . ".png' alt='Images du carrousel'>";
    
                        $compteurImg++;
                    }
                ?>
            </div>
            <div class="arrow">
                <div id="arrowGauche">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                </div>
                <div id="arrowDroite">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                    <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="parentGalerie" id="pg" style="display: none;">
            <?php
                
                $compteur = 1;
                for($i = 0; $i < $information['nombre_image']; $i++)
                {
                    echo "<div><img class='imgGalerie' src='images/suites/" . $information['nom_dossier'] . "/" . $compteur . ".png' alt='Images de la galerie'></div>";

                    $compteur++;
                }
            ?>
        </div>
    </div>
    <div id="background"></div>

    <?php include("include/header.php"); ?>
    <main>
        
        <article>
            <div class="divImgCouverture">
                <img class="imgCouverture" src="<?php echo "images/suites/" . $information['nom_dossier'] . "/0.png"; ?>" alt="Image de couverture">
            </div>
            <div class="galerie">
                <a id="couverture" href="#" id="aGalerie">Voir la galerie d'image (<?php echo $information['nombre_image']; ?>)</a>
            </div>
            <div class="titre">
                <h1><?php echo $information['titre']; ?></h1>
            </div>
            <div class="information">
                <div>
                    <h2>Information</h2>
                </div>
                <div class="divPersonnes">
                    <p>2 personnes</p>
                </div>
                <div class="divPrix">
                    <p><?php echo $information['prix']; ?>€/nuit</p>
                </div>
                <div>
                    <p>Lien de la suite sur booking.com <a href="https://booking.com">ici</a></p>
                </div>
            </div>
            <div class="description">
                <div>
                    <h2>Description</h2>
                </div>
                <div>
                    <p class="pDescription"><?php echo $information['description']; ?></p>
                </div>
            </div>
            <div class="btnReserver">
                <a class="aBtn" href="reservation.php?id=<?php echo $information['id']; ?>">RESERVER</a>
            </div>            
        </article>
    </main>
    <?php include("include/footer.php"); ?>

    <script src="js/detail-suite.js"></script>
</body>
</html>