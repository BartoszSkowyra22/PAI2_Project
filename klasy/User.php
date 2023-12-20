<?php

class User {
    
    protected $userName;
    protected $passwd;
    protected $fullName;
    protected $email;
    protected $date;
    protected $status;

    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;

    function __construct($userName, $fullName, $email, $passwd ){
        $this->status=User::STATUS_USER;
        $this->userName=$userName;
        $this->fullName=$fullName;
        $this->email=$email;
        $this->passwd=password_hash($passwd,PASSWORD_DEFAULT);
        $this->date=new DateTime('now');
        
    }

    public function show() {
        echo "User Details:\n";
        echo "Username: " . $this->userName . "\n";
        echo "Full Name: " . $this->fullName . "\n";
        echo "Email: " . $this->email . "\n";
        echo "Date Created: " . $this->date->format('Y-m-d') . "\n";
        echo "Status: " . $this->getStatusAsString() . "\n";
    }

    private function getStatusAsString() {
        return ($this->status == self::STATUS_ADMIN) ? 'Admin' : 'User';
    }

    /**
    //     * @return mixed
    //     */
    public function getUserName(){
        return $this->userName;
    }

    /**
     * @return false|string|null
     */
    public function getPasswd(){
        return $this->passwd;
    }

    /**
     * @return mixed
     */
    public function getFullName(){
        return $this->fullName;
    }

    /**
     * @return mixed
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @return DateTime
     */
    public function getDate(){
        return $this->date;
    }

    /**
     * @return int
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName){
        $this->userName = $userName;
    }

    /**
     * @param false|string|null $passwd
     */
    public function setPasswd($passwd){
        $this->passwd = $passwd;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName){
        $this->fullName = $fullName;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date){
        $this->date = $date;
    }

    /**
     * @param int $status
     */

    public function setStatus($status): void {
        if ($status === self::STATUS_ADMIN) {
            $this->status = self::STATUS_ADMIN;
        } else {
            $this->status = self::STATUS_USER;
        }
    }
    
    function saveDB($db){
        $result = $db->query("SELECT id FROM users WHERE userName = '$this->userName'");
        if($result->num_rows ==0) {
            $dat=date_format($this->date,'Y-m-d H:i:s');
            $sql="INSERT INTO users VALUES (NULL, '$this->userName' , '$this->fullName',"
                    . "'$this->email' ,'$this->passwd' , '$this->status','$dat' )";
             $db->insert($sql);
            echo "<p>Poprawne dane rejestracji:</p>";
        } else {
            echo "<p>Użytkownik o takim loginie istnieje</p>";
        }
    }
static function getAllUsersFromDB($db) {
    echo $db->select("SELECT id, userName, fullName, email, status, "
            . "DATE_FORMAT(date, '%Y-%m-%d') AS formattedDate FROM users", 
            ["id", "userName", "fullName", "email", "status", "formattedDate"]);

}
}
?>