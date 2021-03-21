<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyDevTeam inscription</title>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include('menu.php');
    ?>

    <!-- Formulaire d'inscription -->
    <form class="formulaire_inscription" method="post">

    <!-- titre du formulaire -->
        <h2 class="titre_formulaire">Inscrivez vous</h2>
        <!-- Logo du formulaire -->
        <div class="formulaire_logo">
            <img src="image/logo_light.png" alt="logo du menu">
        </div>

        <!-- Pseudo-->
        <label class="label" for="pseudo">Pseudo<br>
            <input class="input_formulaire" id="pseudo" type="text" name="pseudo" pattern="^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$"><br />
        </label>
        <!-- Mot de passe-->
        <label class="label" for="mot_de_passe">Mot de passe<br> 
            <input class="input_formulaire" id="mot_de_passe" type="password" name="mot_de_passe"><br />
        </label>
        <!-- Confirmation du mot de passe-->
        <label class="label" for="mot_de_passe_conf">Confirmez votre mot de passe<br>
            <input class="input_formulaire" id="mot_de_passe_conf" type="password" name="mot_de_passe_conf" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"><br />
        </label>
        <!-- Email-->
        <label class="label" for="email">E-mail<br>
            <input class="input_formulaire" id="email" type="email" name="email"><br />
        </label>

        <!-- Bouton d'enregistrement-->
        <input class="formulaire_bouton" type="submit" value="S'inscrire" name="enregistrer">
    </form>
    <!-- Fin du formulaire d'inscription -->

    <!-- Vérification des entrées de l'utilisateur et insertion des données dans la table si elles sont valides-->
    <?php

    // Connexion à la base de données
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=mydevteam;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $reponse = $bdd->query('SELECT * FROM membre');

    // Si les champs sont remplis et que l'utilisateur clique sur le bouton
    if (
        isset($_POST['enregistrer'])
        & !empty($_POST['pseudo'])
        & !empty($_POST['mot_de_passe'])
        & !empty($_POST['mot_de_passe_conf'])
        & !empty($_POST['email'])
    ) {

        //Si les mots de passe sont identiques
        if ($_POST['mot_de_passe'] == $_POST['mot_de_passe_conf']) {

            //Vérification des entrées de l'utilisateur
            $_POST['pseudo'] = htmlentities($_POST['pseudo']);
            $_POST['mot_de_passe'] = htmlentities($_POST['mot_de_passe']);
            $_POST['email'] = htmlentities($_POST['email']);

            //Cryptage du mot de passe et récupération de la date actuelle
            $mot_de_passe_crypte = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
            $date_inscription = date("Y-m-d");

            // Requete d'insertion des données dans la table 'membre'
            $requete = 'INSERT INTO membre VALUES(NULL, "' . $_POST['pseudo'] . '", "' . $mot_de_passe_crypte . '", "' . $_POST['email'] . '", "' . $date_inscription . '")';
            $resultat = $bdd->query($requete);

            //Redirection vers la page de connexion
            header('location:connexion.php');
        }
    }
    ?>
</body>

</html>