<?php

class SessionController extends Connessione {

    public function sessionStart() {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql="SELECT * FROM ".$this->prefix."_utenti WHERE Username = '$username' AND Password='$password'";
        $rs = $this->verConn()->query($sql);

        $righe = $rs->rowCount();

        return $righe;

        //var_dump($righe);

    }


}
?>
