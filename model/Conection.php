<?php

class Conection{

    private $dbms = 'mysql';

//    private $host = 'sql309';
//    private $port = '21';
//    private $dbname = 'epiz_25237719_restaurante';
//    private $user = 'epiz_25237719';
//    private $pass = 'obiirYBuviV';

    private $host = 'localhost';
    private $port = '3308';
    private $dbname = 'epiz_25237719_restaurante';
    private $user = 'root';
    private $pass = '';

    protected $con;

    function __construct(){
        //CONEXION PARA SERVIDOR
        //$this->con = new PDO("$this->dbms:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);

        //CONEXION PARA PRUEBAS EN LOCALHOST
        $this->con = new PDO("$this->dbms:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->pass);
    }
    
}

?>