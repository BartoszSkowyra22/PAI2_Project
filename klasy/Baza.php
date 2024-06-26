<?php

class Baza {
     private $mysqli;
     public function __construct($serwer, $user, $pass, $baza, $port) {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza, $port);
        if ($this->mysqli->connect_errno) {
           printf("Nie udało sie połączenie z serwerem: %s\n", $this->mysqli->connect_error);
            exit();
      }
     }
     function __destruct() {
        $this->mysqli->close();
     }

     public function select($sql, $pola) {
         $tresc = "";
         if ($result = $this->mysqli->query($sql)) {
         $ilepol = count($pola); //ile pól
         $ile = $result->num_rows; //ile wierszy
         $tresc.="<table><tbody>";
         while ($row = $result->fetch_object()) {
             $tresc.="<tr>";
             for ($i = 0; $i < $ilepol; $i++) {
                $p = $pola[$i];
                $tresc.="<td>" . $row->$p . "</td>";
             }
             $tresc.="</tr>";
         }
         $tresc.="</table></tbody>";
         $result->close(); /* zwolnij pamięć */
         }
         return $tresc;
     }

     public function delete($sql) {
     if ($this->mysqli->query($sql)) return true; else return false;
     }

     public function insert($sql) {
        if( $this->mysqli->query($sql)) return true; else return false;
     }

     public function realSelect($sql) {
        if( $this->mysqli->query($sql)) return true; else return false;
     }

     public function getMysqli() {
        return $this->mysqli;
     }
     public function query($sql) {
         $result = $this->mysqli->query($sql);
         return $result;
     }

     public function selectUser($login, $passwd, $tabela){
         $id = -1;
         $sql = "SELECT * FROM $tabela WHERE userName='$login'";
         if ($result = $this->mysqli->query($sql)) {
             $ile = $result->num_rows;
             if ($ile == 1) {
                $row = $result->fetch_object();
                $hash = $row->passwd;
                if (password_verify($passwd, $hash))
                    $id = $row->id;
             }
         }
         return $id;
     }
}
?>