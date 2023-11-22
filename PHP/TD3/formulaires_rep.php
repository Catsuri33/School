<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires Réponse</title>
</head>
<body>

<header>

    <ul style="display: inline;">

        <li style="display: inline;"><a href="../TD3/formulaire.php">Liste des séries</a></li>
        <li style="display: inline;"><a href="#">Déconnexion</a></li>

    </ul>

    </header>

    <?php
        include 'Series.php';

        $dsn = "mysql:dbname=db;host=host";
        $user = 'username';
        $password = 'password';
        $pdo = new PDO($dsn, $user, $password);

        $pdo->query('SET CHARSET UTF8');
    ?>

    <p>Série(s) commençant par <?= $_GET['recherche'] ?></p>

    <ul>

        <?php
        if(isset($_GET['page']) && $_GET['page'] > 0){

            $minAct = $_GET['page'];

        } else {

            $minAct = 0;

        }

        $sql = "SELECT * FROM series WHERE title LIKE :title LIMIT $minAct,10";
        $query = $pdo->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Series");
        ?>

        <?php
        if ($query->execute(['title' => $_GET['recherche'] . "%"])) {
            foreach ($query as $row) { ?>
                <li>
                    <a href="./seasons.php?id=<?= $row->getId() ?>&title=<?= $row->getTitle() ?>"><?= $row->getTitle() ?></a>
                </li>

                <img src="./poster.php?id=<?= $row->getId() ?>">
                <?php
            }
        }
        ?>

        <br>

        <?php 
        $sqlnbseries = "SELECT COUNT(*) AS nbSeries FROM series WHERE title LIKE :title";
        $querynbseries = $pdo->prepare($sqlnbseries);

        $nbSeries = 0;

        if ($querynbseries->execute(['title' => $_GET['recherche'] . "%"])) {
            foreach ($querynbseries as $row) {
                $nbSeries = $row['nbSeries'];
            }
        }

        for($i = 0; $i < $nbSeries / 10; $i++){ ?>

            <p style="display: inline;"><a href="?page=<?= $i * 10?>&recherche=<?= $_GET['recherche'] ?>"><?= $i ?></a></p>

        <?php
        }

        if($query->rowCount() < 10){ ?>

            <h2><a href="?page=<?= $minAct - 10 ?>&recherche=<?= $_GET['recherche'] ?>"><</a> <a href="?page=<?= $minAct ?>&recherche=<?= $_GET['recherche'] ?>">></a></h2>

        <?php
        } else { ?>

            <h2><a href="?page=<?= $minAct - 10 ?>&recherche=<?= $_GET['recherche'] ?>"><</a> <a href="?page=<?= $minAct + 10 ?>&recherche=<?= $_GET['recherche'] ?>">></a></h2>

        <?php
        }
        ?>

    </ul>
    
</body>
</html>