<?php
session_start();

if(!isset($_SESSION["online"])){

    $_SESSION["online"] = false;

}

if(!$_SESSION["online"]){

    header("Location: http://127.0.0.1:8080/PHP/TD5/connexion.php");
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires</title>
</head>
<body>

<?php
if(isset($_GET["online"])){

    $_SESSION["online"] = false;
    header("Refresh:0");

}
?>

<header>

<ul style="display: inline;">

    <li style="display: inline;"><a href="../TD3/formulaire.php">Liste des séries</a></li>
    <li style="display: inline;"><a href="?online=false">Déconnexion</a></li>

</ul>

</header>

<form method="get" action="./formulaires_rep.php">
    Recherche&nbsp;:
    <input type="text" name="recherche" /><br />

    <hr />
    <input type="submit" value="Envoyer" />

</form>
    
</body>
</html>