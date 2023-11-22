<?php
include 'Series.php';

$dsn = "mysql:dbname=db;host=host";
$user = 'username';
$password = 'password';
$pdo = new PDO($dsn, $user, $password);
$pdo->query('SET CHARSET UTF8');

$sql = "SELECT * FROM series WHERE id = :id";    
$query = $pdo->prepare($sql);
$query->setFetchMode(PDO::FETCH_CLASS, "Series");

if ($query->execute(['id' => $_GET['id']])) {
    foreach ($query as $row) {
        header("Content-type: image/jpg");
        echo $row->getPoster();
    }
}

?>