    <!-- Vérification des entrées utilisateurs et de la table membre-->
    <?php

    if (isset($_POST['connecter']) & !empty($_POST['pseudo']) & !empty($_POST['mot_de_passe'])) {
        //Récuperation de l'utilisateur via son pseudo
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=mydevteam;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $reponse = $bdd->query('SELECT * FROM membre WHERE pseudo ="' . $_POST['pseudo'] . '"');
        while ($donnees = $reponse->fetch()) {
            $pseudo = $donnees['pseudo'];
            $mot_de_passe = $donnees['mot_de_passe'];
            $email = $donnees['email'];
            $date_inscription = $donnees['date_inscription'];
            $id = $donnees['id'];
        }

        //Vérification du mot de passe
        //Si le mot de passe ne correspond pas afficher un message d'erreu
        $mot_de_passe_identique = password_verify($_POST['mot_de_passe'], $mot_de_passe);
        if (!$mot_de_passe_identique) {
            echo 'mauvais mot de passe';
        } else {

            //Si le mot de passe correspond, crée une session et récupérer les données de l'utilisateur 
            //puis le rediriger vers la page d'espace membre
            if ($mot_de_passe_identique) {
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['date_inscription'] = $date_inscription;
                $_SESSION['email'] = $email;
                echo 'vous etes connecté';
                header('location:accueil.php');
            } else {
                echo 'Mauvais identifiants ou mot de passe';
            }
        }
    }?>