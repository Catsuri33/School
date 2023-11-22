<?php

function getFirstIndice()
{
    $indice = 0;

    switch(date('D',mktime(0, 0, 0, date('m'), 1))){

        case "Mon":
            $indice = 1;
            break;
        case "Tue":
            $indice = 2;
            break;
        case "Wed":
            $indice = 3;
            break;
        case "Thu":
            $indice = 4;
            break;
        case "Fri":
            $indice = 5;
            break;
        case "Sat":
            $indice = 6;
            break;
        case "Sun":
            $indice = 7;
            break;

    }

    return $indice;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>

    <link rel="stylesheet" href="./calendrier.css">
</head>
<body>

<?php 
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');
?>

<table>

    <tr id="dark">
        <td><</td>
        <td><?= date('F') ?></td>
        <td>></td>
        <td></td>
        <td></td>
        <td><</td>
        <td><?= date('Y') ?></td>
        <td>></td>
    </tr>

    <tr id="blue">

        <td></td>
        <td>lun.</td>
        <td>mar.</td>
        <td>mer.</td>
        <td>jeu.</td>
        <td>ven.</td>
        <td>sam.</td>
        <td>dim.</td>

    </tr>

    <?php
    $week = date('W');
    $nbDays = date('t');
    $days = 1;
    for($i = 1; $i <= 6; $i++){ ?>

        <tr>

            <td id="blue"><?= $week ?></td>

            <?php
            for($y = 1; $y <= 7; $y++){ 
                
                if(($i == 1 && $y < getFirstIndice()) || $days > $nbDays){ ?>

                    <td></td>

                <?php
                } else { ?>

                    <td id="day"><?= $days ?></td>

                    <?php
                    $days++;
                }
                ?>

                <?php
            }
            ?>

        </tr>
            
        <?php
        $week++;
    }
    ?>

</table>
    
</body>
</html>