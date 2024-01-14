<?php


class RegistrationForm {

    
    protected $user;
    function __construct() {
        ?>
            <div class="whiteBg">
                    <h3> Formularz rejestracji</h3>
                        <form action="addUser.php" method="POST" >
                        <label for="userName">Username:</label><br/>
                        <input type="text" id="userName" name="userName">
                        <br><br>

                        <label for="passwd">Password:</label><br/>
                        <input type="password" id="passwd" name="passwd">
                        <br><br>

                        <label for="fullName">Full Name:</label><br/>
                        <input type="text" id="fullName" name="fullName">
                        <br><br>

                        <label for="email">Email:</label><br/>
                        <input type="email" id="email" name="email">
                        <br><br>

                        <input type="submit" name="submit" value="Rejestruj">
                        <input type="reset" value="Anuluj">
                    </form>
                <a href='processLogin.php?akcja=wyloguj' > <p>Wyloguj</p></a> </p>
                </div>
        <?php
    }

    function checkUser() {
        $args = ['userName' => ['filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'passwd' =>['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\\W_-]).{5,}$/']],
            'email' => FILTER_VALIDATE_EMAIL,
            'fullName'=> ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[A-Za-ząęłńśćźżó\s\'-]+$/']]
        ];
        $dane = filter_input_array(INPUT_POST, $args);
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }
        if ($errors === "") {
            $this->user = new User($dane['userName'], $dane['fullName'],
                $dane['email'],$dane['passwd']);
        } else {
            echo "<p>Błędne dane:$errors</p>";
            $this->user = NULL;
        }
        return $this->user;
    }
}


?>