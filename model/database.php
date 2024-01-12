<?php
    $dsn = 'mysql:host=127.0.0.1;port=8889;dbname=tasks';
    $username = 'root';
    $password = 'root';

try {
    $bd = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error = "Databaase error: ";
    $error .= $e -> getMessage();
    include('view/error.php');
    exit();
}