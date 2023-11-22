<?php
function setStartPlayer(){

    if(rand(1,2) == 1){

        $_SESSION['actual_player'] = "O";
    
    } else {
    
        $_SESSION['actual_player'] = "X";
    
    }

}

function initGrid(){

    $_SESSION['grid'] = [['jouer', 'jouer', 'jouer'], ['jouer', 'jouer', 'jouer'], ['jouer', 'jouer', 'jouer']];

}

function checkGrid(){

    $grid = $_SESSION['grid'];
    $i = 0;
    $end = false;

    while($i < count($grid) && !$end){

        $y = 0;

        while($y < count($grid[$i]) && !$end){

            if($grid[$i][$y] == "jouer"){

                $end = true;

            }

            $y++;
    
        }

        $i++;

    }

    return $end;

}

function checkWin(){

    $grid = $_SESSION['grid'];

    if(($grid[0][0] == "X" && $grid[0][1] == "X"  && $grid[0][2] == "X") ||
       ($grid[1][0] == "X" && $grid[1][1] == "X"  && $grid[1][2] == "X") ||
       ($grid[2][0] == "X" && $grid[2][1] == "X"  && $grid[2][2] == "X") ||
       ($grid[0][0] == "X" && $grid[1][0] == "X"  && $grid[2][0] == "X") ||
       ($grid[0][1] == "X" && $grid[1][1] == "X"  && $grid[2][1] == "X") ||
       ($grid[0][2] == "X" && $grid[1][2] == "X"  && $grid[2][2] == "X") ||
       ($grid[0][0] == "X" && $grid[1][1] == "X"  && $grid[2][2] == "X") ||
       ($grid[0][2] == "X" && $grid[1][1] == "X"  && $grid[2][0] == "X")
    ){

        $_SESSION['state'] = false;
        return "X";

    } else if(($grid[0][0] == "O" && $grid[0][1] == "O"  && $grid[0][2] == "O") ||
        ($grid[1][0] == "O" && $grid[1][1] == "O"  && $grid[1][2] == "O") ||
        ($grid[2][0] == "O" && $grid[2][1] == "O"  && $grid[2][2] == "O") ||
        ($grid[0][0] == "O" && $grid[1][0] == "O"  && $grid[2][0] == "O") ||
        ($grid[0][1] == "O" && $grid[1][1] == "O"  && $grid[2][1] == "O") ||
        ($grid[0][2] == "O" && $grid[1][2] == "O"  && $grid[2][2] == "O") ||
        ($grid[0][0] == "O" && $grid[1][1] == "O"  && $grid[2][2] == "O") ||
        ($grid[0][2] == "O" && $grid[1][1] == "O"  && $grid[2][0] == "O")
    ){

        $_SESSION['state'] = false;
        return "O";

    }

}

session_start();

if(!isset($_SESSION['user'])){

    $_SESSION['user'] = substr(sha1(mt_rand()),17,9);

}

if(!isset($_SESSION['state'])){

    $_SESSION['state'] = true;

}

if(!isset($_SESSION['grid'])){

    initGrid();

}

if(!isset($_SESSION['actual_player'])){

    setStartPlayer();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morpion</title>

    <style>
        table {

            table-layout: fixed;
            width: 500px;
            text-align: center;

        }

        td {

            font-size: 30px;
            border: 1px solid black;
            padding: 10px;
            width: 75px;

        }
    </style>
</head>
<body>

    <?php

    if (isset($_SESSION['user'])) { ?>
        <p>Bienvenue <?= $_SESSION['user'] ?> !</p>
    <?php
    } else {
        header('location: login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        if(isset($_GET['row']) && isset($_GET['col'])){

            if($_GET['row'] != -1 && $_GET['col'] != -1){

                $_SESSION['grid'][$_GET['row']][$_GET['col']] = $_SESSION['actual_player'];
                if($_SESSION['actual_player'] == "X"){

                    $_SESSION['actual_player'] = "O";
            
                } else {
            
                    $_SESSION['actual_player'] = "X";
            
                }

            } else {

                $_SESSION['state'] = true;
                initGrid();
                setStartPlayer();

            }

        }
    }

    checkWin();
    ?>

    <?php
    $i = 0;
    ?>
    <table>
    <?php
    foreach($_SESSION['grid'] as $row){

        $y = 0; ?>

        <tr>

        <div class="row"> <?php

            foreach($row as $case){

                if($case == "jouer") { 
                    
                    if($_SESSION['state']){ ?>

                        <td>
                            <p class="morpion" id="<?= $i ?> <?= $y ?>"><a href="?row=<?= $i ?>&col=<?= $y ?>"><?= $case ?></a></p>
                        </td>

                    <?php
                    } else { ?>

                        <td>
                            <p class="morpion" id="<?= $i ?> <?= $y ?>"><?= $case ?></p>
                        </td>

                    <?php
                    }
                    ?>

                <?php
                } else { ?>

                    <td>
                        <p class="morpion"><?= $case ?></p>
                    </td>

                <?php
                }

                $y++;

            } 
            $i++;
            ?>
        </div>

        </tr>
        <?php

    } ?>

    </table>

    <?php
    $end = checkGrid();
    if(!$end){ ?>

        <p>Aucun joueur n'a gagné !</p>

    <?php
    }

    $win = checkWin();
    if($win != null){ ?>

        <p>Le joueur <?= $win ?> a gagné !</p>

    <?php
    }
    ?>

    <p><a href="?row=-1&col=-1">Réinitialiser la grille</a></p>
    
</body>
</html>