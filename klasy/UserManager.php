<?php

class UserManager {
    
    function loginForm() {
     ?>
        <!DOCTYPE html>
        <html lang="pl" >
        <head>
            <meta charset="UTF-8">
            <title> Logowanie </title>
            <link rel="stylesheet" href="./css/loginForm.css">

        </head>
        <body>
        <div class="page">
            <div class="container">
                <div class="left">
                    <div class="login">Login</div>
                    <div class="eula">Zaloguj się na swoje konto, aby zagłosować na Samorząd!</div>
                </div>
                <div class="right">
                    <svg viewBox="0 0 320 300">
                        <defs>
                            <linearGradient
                                    inkscape:collect="always"
                                    id="linearGradient"
                                    x1="13"
                                    y1="193.49992"
                                    x2="307"
                                    y2="193.49992"
                                    gradientUnits="userSpaceOnUse">
                                <stop
                                        style="stop-color:#ff00ff;"
                                        offset="0"
                                        id="stop876" />
                                <stop
                                        style="stop-color:#ff0000;"
                                        offset="1"
                                        id="stop878" />
                            </linearGradient>
                        </defs>
                        <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
                    </svg>
                    <div class="form">
                        <form action="processLogin.php" method="post">
                            <label for="login">Login</label>
                            <input type="text" id="login" name="login" required>
                            <label for="passwd">Password</label>
                            <input type="password" id="passwd" name="passwd" required>
                            <input type="submit" id="submit" value="Zaloguj" name="zaloguj">
                        </form>
                    </div>
                </div>
            </div>
        </div>
         partial
        <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script><script  src="./js/loginForm.js"></script>

        </body>
        </html>
    <?php
    }
    function login($db) {
        $args = [
            'login' => FILTER_SANITIZE_ADD_SLASHES,
            'passwd' => FILTER_SANITIZE_ADD_SLASHES
        ];
        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0) {
            session_start();
            session_regenerate_id(true);
            $result = $db->query("SELECT sessionId FROM logged_in_users WHERE userId = $userId");
            if($result->num_rows == 1) {
                $_SESSION['success'] = true;
            } else {
                $_SESSION['success'] = false;
            }

            $db->delete("DELETE FROM logged_in_users WHERE userId = $userId");
            $this->date=new DateTime('now');
            $currentDateTime =date_format($this->date,'Y/m/d H:i:s');
            $sessionId = session_id();
            $db->insert("INSERT INTO logged_in_users (sessionId ,userId , lastUpdate) VALUES ( '$sessionId',$userId, '$currentDateTime')");
        }
        return $userId;
}

    function logout($db) {
        session_start();
        $sessionId = session_id();
        session_destroy();
        $db->delete("DELETE FROM logged_in_users WHERE sessionId = '$sessionId'");
    }

    function getLoggedInUser($db, $sessionId) {
        $sql = "SELECT userId FROM logged_in_users WHERE sessionId = '$sessionId'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['userId'];
            $result->close();
            return $userId;
        } else {
            $result->close();
            return -1;
        }
    }
}
?>
