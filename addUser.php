<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Formularz rejestracyjny</title>
        <link rel="stylesheet" href="./sass/main.css">
    </head>
    <body>
<?php
include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';
session_start();
$db = new Baza("127.0.0.1", "root", "root", "tasks",8889);
$um = new UserManager();

$sessionId = session_id();
$loggedUserId = $um->getLoggedInUser($db, $sessionId);

    if ($loggedUserId == 1) {
        include 'klasy/RegistrationForm.php';
        $rf = new RegistrationForm();
            if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                 $user = $rf->checkUser();
                 if ($user === NULL) {
                     echo "<p>Niepoprawne dane rejestracji.</p>";
                 } else{
                     $user->saveDB($db);
                     User::getAllUsersFromDB($db);
                }
            }
    } else {
        session_destroy();
        header("Location: processLogin.php");
        exit();
    }
?>
    </body>
</html>
