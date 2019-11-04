<?php

class Dbc{
    private $server;
    private $username;
    private $password;
    private $db_name;

    protected function connect(){
        $this->server = "localhost";
        $this->username = 'root';
        $this->password = '';
        $this->db_name = 'library';

        try {
            $db = new PDO("mysql:host={$this->server}; dbname={$this->db_name}; charset=utf8", 
            $this->username, 
            $this->password, 
            [   
                PDO::ATTR_EMULATE_PREPARES=>false,
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ]);
            return $db;
        } catch (PDOException $e) {
            exit("Database connection error");
        }
    }
    protected function connect_mysqli(){
        $this->server = "localhost";
        $this->username = 'root';
        $this->password = '';
        $this->db_name = 'library';

        try {
            $conn = mysqli_connect($this->server, $this->username, $this->password, $this->db_name);
            mysqli_report(MYSQLI_REPORT_STRICT);
            return $conn;
        } catch (Exception $e) {
            exit("Database connection error");
        }
    }
}