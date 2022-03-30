<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=hypnos', 'root', 'root');
}
    catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}

if(!empty($_SESSION['token']))
{
    $requette = $bdd->prepare('SELECT * FROM user WHERE token = ?');
    $requette->execute(array($_SESSION['token']));
    $donnees = $requette->fetch();
}else
{
    $donnees = false;
}

?>
<header>
        <a href="index.php"><img class="imgLogo" src="images/logo.png" alt="logo"></a>
        <nav>
            <span class="spanNav"><h2 class="h2Nav"><a class="aNav" href="reservation.php">RESERVER</a></h2></span>
            <span class="spanNav"><h2 class="h2Nav"><a class="aNav" href="contact.php">CONTACT</a></h2></span>
            <?php

                if($donnees)
                {
                    echo "<span class='spanNav'><h2 class='h2Nav'><a class='aNav' href='compte.php'>MON COMPTE</a></h2></span>";
                }else
                {
                    echo "<span class='spanNav'><h2 class='h2Nav'><a class='aNav' href='inscription.php'>S'INSCRIRE</a></h2></span>";
                    echo "<span class='spanNav'><h2 class='h2Nav'><a class='aNav' href='connexion.php'>SE CONNECTER</a></h2></span>";
                }
            ?>
        </nav>
    </header>