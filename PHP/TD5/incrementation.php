<?php
setcookie('views', 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incrémentation Cookie</title>
</head>
<body>

    <?php
    if(isset($_COOKIE['views'])) { ?>
        <p>Je t'ai vu <?= $_COOKIE['views'] ?> fois !</p>
        <?php
        setcookie('views', $_COOKIE['views']+1);
    }
    ?>
    
</body>
</html>