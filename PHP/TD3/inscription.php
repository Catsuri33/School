<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <?php
        include 'Series.php';

        $dsn = "mysql:dbname=db;host=host";
        $user = 'username';
        $password = 'password';
        $pdo = new PDO($dsn, $user, $password);

        $pdo->query('SET CHARSET UTF8');
    ?>
    
    <h1>Inscription</h1>
    <form method="post" action="./inscription.php">

        <input type="text" placeholder="Nom" required>
        <input type="email" placeholder="Email" required>
        <input type="password" placeholder="Mot de passe" required>

        <input type="submit">

    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
    }
    ?>

</body>
</html>