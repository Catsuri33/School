<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplications</title>
</head>
<body>

    <table>

        <tr>
            <?php
            for($i = 1; $i < 10; $i++){ ?>

                <?php
                if(isset($_GET['column']) && isset($_GET['column'])){

                    if($_GET['column'] == $i){ ?>

                        <th style="background-color: yellow;"><?= $i ?></th>

                    <?php
                    } else { ?>

                        <th><?= $i ?></th>

                    <?php
                    }

                }
                ?>

            <?php
            }
            ?>
        </tr>

        <?php
        for($i = 2; $i < 10; $i++){ ?>

            <tr>

                <?php
                if(isset($_GET['row']) && isset($_GET['column'])){

                    if($_GET['row'] == $i){ ?>

                        <th style="background-color: yellow;"><?= $i ?></th>

                    <?php
                    } else { ?>

                        <th><?= $i ?></th>

                    <?php
                    }

                }
                ?>
                
                <?php
                for($y = 2; $y < 10; $y++){ ?>

                    <?php
                    if(isset($_GET['row']) && isset($_GET['column'])){

                        if($_GET['row'] == $i || $_GET['column'] == $y){ ?>

                            <td style="background-color: yellow;"><a href="?row=<?= $i ?>&column=<?= $y ?>"><?= $i*$y ?></a></td>

                        <?php
                        } else { ?>

                            <td><a href="?row=<?= $i ?>&column=<?= $y ?>"><?= $i*$y ?></a></td>

                        <?php
                        }

                    }
                    ?>

                <?php
                }
                ?>

            </tr>

        <?php
        }
        ?>

    </table>
    
</body>
</html>