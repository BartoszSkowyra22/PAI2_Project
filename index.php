<?php
include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';
require('model/database.php');
require('model/tasks_db.php');
require('model/course_db.php');

session_start();
$db = new Baza("127.0.0.1", "root", "root", "tasks",8889);
$um = new UserManager();

$sessionId = session_id();
$loggedUserId = $um->getLoggedInUser($db, $sessionId);



$assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$course_name = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_STRING);

$course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
if(!$course_id){
    $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if(!$action){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if(!$action){
        $action = 'list_assignments';
    }
}

if ($loggedUserId != -1) {

    switch ($action){
        case "list_courses":
            $courses = get_courses();
            include('view/course_list.php');
            break;

        case "add_course":
            add_course($course_name);
            header("Location: index.php?action=list_courses");
            break;
        case "add_assignment":
            if($course_id && $description) {
                add_assignment($course_id, $description);
                header("Location: index.php?course_id=$course_id");
            } else {
                $error = "Niepoprawne dane. Sprawdź dane i spróbuj ponownie";
                include('view/error.php');
                exit();
            }
            break;
        case "delete_course":
            if ($course_id){
                try {
                    delete_course($course_id);
                } catch (PDOException $e){
                    $error = "Nie można usunąć kategorii, jeżeli są do niej przypisane zadania!";
                    include('view/error.php');
                    exit();
                }
                header("Location: .?action=list_courses");
            }
            break;
        case "delete_assignment":
            if ($assignment_id){
                delete_assignment($assignment_id);
                header("Location: index.php?course_id=$course_id");
            } else {
                $error = "Niepoprawne lub brakujące ID zadania";
                include('view/error.php');
            }
            break;
        default:
            $course_name = get_course_name($course_id);
            $courses = get_courses();
            $assignments = get_assignments_by_course($course_id);
            include('view/assignment_list.php');

    }

} else {
    session_destroy();
    header("Location: processLogin.php"); 
    exit();
}
?>