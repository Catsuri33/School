<?php
$dsn = "mysql:dbname=db;host=host";
$user = 'username';
$password = 'password';
$pdo = new PDO($dsn, $user, $password);

$pdo->query('SET CHARSET UTF8');
?>