<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Formularz rejestracyjny</title>
    </head>
    <body>
    <?php
        include 'klasy/User.php';
        include 'klasy/RegistrationForm.php';
        include 'klasy/Baza.php';
        $db = new Baza("127.0.0.1", "root", "root", "tasks", 8889);
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
    ?>
    </body>
</html>
