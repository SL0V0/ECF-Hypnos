<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paramHeaderFooter.css">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Connexion</title>
</head>
<body>
    <?php include("include/header.php"); ?>
    <main>
        <form class="formMain" action="" method="post">
            <h1 class="h1Main">Connexion</h1>
            <div class="parentDivLabInp">
                <div class="divLabInp">
                    <label class="label" for="email">E-mail</label><br>
                    <input class="input" type="text" name="email" id="mdp" required>
                </div>
                <div class="divLabInp">
                    <label class="label" for="mdp">Mot de passe</label><br>
                    <input class="input" type="password" name="mdp" id="mdp" required>
                </div>
            </div>
            <div class="divBtn"><input class="btn" type="submit" value="CONNEXION"></div>
            <div class="divLienExterne">
                <p class="lienMdpForgot"><a class="aLink" href="#">Mot de passe oublié ?</a></p>
                <p class="lienInscription">Pas encore membre ? <a class="aLink" href="#">S'inscrire</a></p>
            </div>
        </form>
    </main>
    <?php include("include/footer.php"); ?>
</body>
</html>