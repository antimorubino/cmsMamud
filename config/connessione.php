<?php

class Connessione {


    protected $host = 'localhost';
    protected $dbname = 'cms2ld';
    protected $username = 'root';
    protected $password = '';
    protected $prefix = 'cld';
    protected $charset = 'utf-8';
    protected $iva = 22;

    public function verConn() {

        try {
            // stringa di connessione al DBMS
            $connessione = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET character_set_results = utf8'
            ));

            return $connessione;

            //$connessione = null;
        }
        catch(PDOException $e)
        {
            // notifica in caso di errore nel tentativo di connessione
            echo $e->getMessage();
        }
    }

}

?>
