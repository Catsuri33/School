<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculatrice</title>
</head>
<body>

<h1>Calculatrice</h1>

<form action="#" method="post">

<input type="text" name="n1" />
<p>+</p>
<input type="text" name="n2" />
<p>=</p>
<input type="submit" value="Calculer" />

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['n1']) && isset($_POST['n2'])){?>

        <p><?= $_POST['n1'] + $_POST['n2'] ?></p>

    <?php
    } else {?>

        <p>0</p>
        
    <?php
    }

}
?>

</form>
    
</body>
</html>