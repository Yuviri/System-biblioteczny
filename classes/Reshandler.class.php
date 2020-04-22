<?php

class Reshandler extends Dbc {
    
    private $id; 
    private $ide;
    private $czytelnik;
    private $pracownik;
    private $egzemplarz;
    private $od;
    private $do;
    private $error;

    public function __construct($id, $pracownik){
        $this->id = $id;
        $this->pracownik = $pracownik;
    }

    public function get_reservation_data(){
        $sql = "SELECT czytelnik, egzemplarz FROM rezerwacja WHERE id_rez='$this->id'";

        if($query = $this->connect()->query($sql)){
            $result = $query->fetchAll();
            $this->czytelnik = $result[0]['czytelnik'];
            $this->egzemplarz = $result[0]['egzemplarz'];
            if(strlen($this->egzemplarz)==1){
                $this->ide = '0'.$this->egzemplarz;
            } else {
                $this->ide = $this->egzemplarz;
            }
        } else {
            return false;
        }
    }

    public function lend(){
        
        try {
            $sql1 = "UPDATE rezerwacja SET status='zakonczona' WHERE id_rez='$this->id'";
            $sql2 = "INSERT INTO wypozyczenie VALUES(NULL, '$this->czytelnik', '$this->pracownik', '$this->egzemplarz', '$this->od', '$this->do', NULL)";

            if(!$this->connect_mysqli()->query($sql1)){
                throw new Exception("Pierwsze zapytanie");
            }
            if(!$this->connect_mysqli()->query($sql2)){
                throw new Exception("Drugie zapytanie");    
            }

            
        } catch (Exception $e) {
            $this->error = $e;
            return false;
        }
    }

    public function getError(){
       return $this->error;
    }
}
