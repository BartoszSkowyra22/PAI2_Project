<?php
include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';
session_start();
$db = new Baza("127.0.0.1", "root", "root", "tasks",8889);
$um = new UserManager();

$sessionId = session_id();
$loggedUserId = $um->getLoggedInUser($db, $sessionId);

if ($loggedUserId != -1) {



    $userDataResult = $db->query("SELECT * FROM users WHERE id = $loggedUserId");
    $userData = $userDataResult->fetch_assoc();
    echo "<h3>ADMIN: </h3>";
    echo $userData['id'] . " ".$userData['userName']." ".$userData['email'].$userData['status'];
    echo "<a href='processLogin.php?akcja=wyloguj' > <p>Wyloguj</p></a> </p>";






} else {
    session_destroy();
    header("Location: processLogin.php"); 
    exit();
}
?>