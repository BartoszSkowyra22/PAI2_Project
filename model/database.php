<?php
    $dsn = 'mysql:host=127.0.0.1;port=8889;dbname=tasks';
    $username = 'root';
    $password = 'root';

try {
    $bd = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error = "Błąd bazy danych: ";
    $error .= $e -> getMessage();
    include('view/error.php');
    exit();
}