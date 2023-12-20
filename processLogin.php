<?php

include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';

$db = new Baza("127.0.0.1", "root", "root", "students", 8889);
$um = new UserManager();

if (filter_input(INPUT_GET, "akcja")=="wyloguj") {
    $um->logout($db);
}

if (filter_input(INPUT_POST, "zaloguj")) {
    $userId=$um->login($db);


    if ($userId > 0) {
        $userDataResult = $db->query("SELECT status FROM users WHERE id = $userId");
        $userData = $userDataResult->fetch_assoc();

        if($userData["status"] == 1){
            header("location:userPage.php");
        }
        if($userData["status"] == 2) {
            header("location:adminPage.php");
        }
    } else if(isset($_SESSION['success']) && $_SESSION['success']==true){
        $msg="juz zalogowano wylogowywanie";
        $_SESSION['success'] = 'false';
        session_destroy();
        header("Location: processLogin.php?Message=".urlencode($msg));
        exit();
    } else {
        $um->loginForm();
        echo '<script type="text/javascript">
           document.querySelector(".eula").innerHTML = "Niepoprawne dane logowania";
            document.querySelector(".eula").style.color="#FF0000";
        </script>';
    }
} else {
    $um->loginForm();
}