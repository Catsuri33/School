<?php

function traitement($prenom, $nom, $email, $genre, $languages)
{
    echo 'Vous vous nommez ' . htmlspecialchars($prenom) . ' ' . htmlspecialchars($nom) . '<br/>';
    if(filter_var($email, FILTER_VALIDATE_EMAIL) != false){

        echo 'Votre email est ' . htmlspecialchars($email) . '<br/>';

    }
    if($genre != ""){

        echo 'Votre genre est ' . htmlspecialchars($genre) . '<br/>';

    }

    echo 'Vos compétences sont : <br/>';
    foreach($languages as $l){

        echo $l . ", ";

    }

    echo '<hr/>';
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8" />
        <title>Formulaire</title>
    </head>
    <body>
        <h1>Formulaire</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['genre']) && isset($_POST['languages'])) 
    {
        // Le formulaire est valide et bien rempli, appel du traitement
        // sur les données
        traitement($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['genre'], $_POST['languages']);
    }
}
?>

<form method="post">
    Votre prénom&nbsp;:
    <input type="text" name="prenom" value="<?= $_POST['prenom'] ?>" /><br />
    Votre nom&nbsp;:
    <input type="text" name="nom" value="<?= $_POST['nom'] ?>" /><br />
    Votre email&nbsp;:
    <input type="email" name="email" value="<?= $_POST['email'] ?>" /><br />
    Votre genre&nbsp;:
    <select name="genre">
        <option value="">--Choisissez un genre--</option>
        <option value="homme">Homme</option>
        <option value="femme">Femme</option>
    </select>

    <br/>

    <input type="checkbox" name="languages[]" value="html">HTML
    <input type="checkbox" name="languages[]" value="css">CSS
    <input type="checkbox" name="languages[]" value="js">JS
    <input type="checkbox" name="languages[]" value="php">PHP

    <hr />
    <input type="submit" value="Envoyer" />
</form>
</body>
</html>