<?php
class db
{
    private $dbHost;
    private $db_name;
    private  $user_name;
    private  $user_password;

    public function __construct($dbHost, $dbName, $userName, $userPassword) {
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->userName = $userName;
        $this->userPassword = $userPassword;

    }

    function connect(){

        $db_link = new PDO("mysql:host={$this->dbHost};dbname={$this->dbName}", $this->userName, $this->userPassword);
        $db_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db_link->query("SET NAMES 'utf8';");
        $db_link->query("SET CHARACTER SET 'utf8';");
        $db_link->query("SET SESSION collation_connection = 'utf8_general_ci';");

        return $db_link;
    }
}