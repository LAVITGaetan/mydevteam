<?php
session_start();
if (isset($_POST['deconnexion'])) {
    header('Refresh:0;');
    echo 'Vous êtes déconnecté';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyDevTeam</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include('menu.php');
    ?>
    <!-- Formulaire de connexion -->

    <form class="formulaire_connexion" method="post">

        <!-- titre du formulaire -->
        <h2 class="formulaire_titre">Connectez vous</h2>

        <!-- Logo du formulaire -->
        <div class="formulaire_logo">
            <img src="image/user.png" alt="logo du formulaire">
        </div>
        <label class="label" for="pseudo">Pseudo<br />
            <input class="formulaire_entrees" id="pseudo" type="text" name="pseudo">
        </label>
        <br />
        <div>
            <label class="label" for="mot_de_passe">Mot de passe<br />
                <input class="formulaire_entrees" id="mot_de_passe" type="password" name="mot_de_passe">
            </label>
            <br />
        </div>
        <input class="formulaire_bouton" type="submit" value="Se connecter" name="connecter">
    </form>
    <!-- Fin du formulaire de connexion -->

    <?php
    include('connexion.php');
    ?>
</body>

</html>