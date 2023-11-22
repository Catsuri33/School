<?php
session_start();

if($_SESSION["connected"] == 1){

    header("Location: http://127.0.0.1:8080/PHP/TD3/formulaire.php", true, 301);  
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <style>
        #other_country {

            display: none;

        }
    </style>
</head>
<body>

    <br>

    <header>

    <ul style="display: inline;">

        <li style="display: inline;"><a href="#">Inscription</a></li>
        <li style="display: inline;"><a href="../TD5/connexion.php">Connexion</a></li>

    </ul>

    </header>

    <?php
        include '../BDD.php';

        $sql = "INSERT INTO user(name, email, password, register_date, country_id) VALUES (:fullname, :email, :pass, :rdate, :country_id);";
        $query = $pdo->prepare($sql);

        $sqlcountrys = "SELECT * FROM country;";

        $sqlicountrys = "INSERT INTO country(name) VALUES (:country);";
        $queryicountrys = $pdo->prepare($sqlicountrys);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){

                if($_POST['country'] != "other"){

                    if ($query->execute(['fullname' => $_POST['name'], 'email' => $_POST['email'], 'pass' => $_POST['password'], 'rdate' => date("Y-m-d H:i:s"), 'country_id' => $_POST['country']])) { ?>
                        <p>Vous êtes inscrit.</p>
                        <?php
                    }

                } else {

                    if ($queryicountrys->execute(['country' => $_POST['other_country']])) { ?>
                        <p>Votre pays a été ajouté.</p>
                        <?php
                    }

                    if ($query->execute(['fullname' => $_POST['name'], 'email' => $_POST['email'], 'pass' => $_POST['password'], 'rdate' => date("Y-m-d H:i:s"), 'country_id' => $pdo->lastInsertId()])) { ?>
                        <p>Vous êtes inscrit.</p>
                        <?php
                    }
                    
                }
        
            }
        
        }
    ?>

    <form method="POST" action="#">

        <h1>Inscription</h1>
        <input type="text" placeholder="Nom" name="name" required>
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Mot de passe" name="password" required>
        <select id="country" name="country" onchange="showInput()">
            <?php
            $querycountrys = $pdo->query($sqlcountrys);
            foreach ($querycountrys as $row) { ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php
            }
            ?>
            <option value="other">Autre</option>
        </select>
        <input type="text" id="other_country" name="other_country" placeholder="Autre Pays">
        <input type="submit" value="S'inscrire">

    </form>

    <script>
    function showInput(){

        selectElement = document.querySelector('#country');
        input = document.querySelector('#other_country');
        output = selectElement.value;

        if(output == "other"){

            input.style.display = 'inline';

        } else {

            input.style.display = 'none';

        }

    }
    </script>
    
</body>
</html>