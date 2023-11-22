<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisons</title>

    <script src="https://kit.fontawesome.com/897a9fa1d8.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $dsn = "mysql:dbname=etu_lmichault;host=info-titania";
        $user = 'lmichault';
        $password = 'eXjtyA6n';
        $pdo = new PDO($dsn, $user, $password);

        $pdo->query('SET CHARSET UTF8');

        $sql = "SELECT season.number, COUNT(*) as nbEpisodes FROM episode INNER JOIN season ON episode.season_id = season.id INNER JOIN series ON season.series_id = series.id WHERE series.id = :id GROUP BY season.number ORDER BY season.number";
        $querySeasons = $pdo->prepare($sql);
    ?>
    
    <?php
    if(isset($_GET['star'])){

        if($_GET['star'] == "yes"){

            $sql = "INSERT INTO user_series(user_id, series_id) VALUES (:user_id, :series_id);";
            $query = $pdo->prepare($sql);
            $query->execute(['user_id' => $_SESSION['user_id'], 'series_id' => $_GET['id']]);

        } else {

            $sql = "DELETE FROM user_series WHERE user_id = " . $_SESSION['user_id'] . " AND series_id = " . $_GET['id'] . ";";
            $query = $pdo->prepare($sql);
            $query->execute();

        }

    }

    if(isset($_GET['id']) && isset($_GET['title'])){ ?>

        <h2 style="display: inline;"><?= $_GET['title'] ?></h2>
        
        <?php
        $sql = "SELECT * FROM user_series WHERE user_id = " . $_SESSION['user_id'] . " AND series_id = " . $_GET['id'] . ";";
        $queryGetStarred = $pdo->prepare($sql);
        $queryGetStarred->execute();

        if($queryGetStarred->rowCount() == 1){ ?>

            <a href="?id=<?= $_GET['id'] ?>&title=<?= $_GET['title'] ?>&star=no"><i class="fa-solid fa-star" style="display: inline; color: #f1c40f;"></i></a>

        <?php
        } else { ?>

            <a href="?id=<?= $_GET['id'] ?>&title=<?= $_GET['title'] ?>&star=yes"><i class="fa-solid fa-star" style="display: inline; color: #95a5a6;"></i></a>

        <?php
        }
        ?>

        <ul>

            <?php
            if ($querySeasons->execute(['id' => $_GET['id']])) {
                foreach ($querySeasons as $row) { ?>
                    <li>
                        Saison <?= $row['number'] ?> (<?= $row["nbEpisodes"] ?> épisode(s))
                    </li>
                <?php
                }
            } ?>

        </ul>

    <?php
    }
    ?>

</body>
</html>