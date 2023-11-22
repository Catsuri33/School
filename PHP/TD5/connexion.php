<?php
session_start();

if(!isset($_SESSION["online"])){

    $_SESSION["online"] = false;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification</title>
</head>
<body>

    <br>

    <?php
    include '../BDD.php';

    $sql = "SELECT * FROM user WHERE NAME = :username AND PASSWORD = :password";
    $query = $pdo->prepare($sql);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['username']) && isset($_POST['password'])){

            $query->execute(['username' => $_POST['username'], 'password' => $_POST['password']]);

            if ($query->rowCount() == 1) { 

                foreach ($query as $row) {

                    $_SESSION["user_id"] = $row['id'];

                }

                $_SESSION["online"] = true;
                ?>

                <header>

                <ul style="display: inline;">

                    <li style="display: inline;"><a href="../TD3/formulaire.php">Liste des séries</a></li>
                    <li style="display: inline;"><a href="?online=false">Déconnexion</a></li>

                </ul>

                </header>

                <h1>Connexion</h1>

                <p>Vous êtes connecté</p>
                <?php

            } else { ?>

                <header>

                <ul style="display: inline;">

                    <li style="display: inline;"><a href="../TD4/index.php">Inscription</a></li>
                    <li style="display: inline;"><a href="#">Connexion</a></li>

                </ul>

                </header>

                <h1>Connexion</h1>

                <p style="color: red;">Mauvais identifiants !</p>
                <?php

            }
    
        }
    
    } else { ?>

        <header>

        <ul style="display: inline;">

            <li style="display: inline;"><a href="../TD4/index.php">Inscription</a></li>
            <li style="display: inline;"><a href="#">Connexion</a></li>

        </ul>

        </header>

        <h1>Connexion</h1>

    <?php
    }
    ?>

    <form method="POST" action="#">

        <input type="text" name="username" placeholder="Identifiant" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="submit" value="Connexion">

    </form>

</body>
</html>