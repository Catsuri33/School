<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Séries</title>
</head>
<body>
    <?php
        $dsn = "mysql:dbname=db;host=host";
        $user = 'username';
        $password = 'password';
        $pdo = new PDO($dsn, $user, $password);

        $pdo->query('SET CHARSET UTF8');
    ?>

    <ul>

        <?php
            $sql = "SELECT * FROM series WHERE title LIKE 'L%'";
            $query = $pdo->query($sql);
        ?>

        <?php
        foreach ($query as $row) { ?>
            <li>
                <?= $row['title'] ?>
            </li>
        <?php
        }
        ?>

    </ul>
</body>
</html>