<?php


class AddExBook extends Dbc {
    
    private $isbn;
    private $quantity;
    

    public function __construct($isbn, $quantity){
        $this->isbn = $isbn;
        $this->quantity = $quantity;
    }

    public function addExB(){
        
        $flag = false;
        $sql = "INSERT INTO egzemplarz VALUES(?, ?, ?)";
        $query = $this->connect()->prepare($sql);

        for ($i=0; $i < $this->quantity; $i++) { 
            if (!$query->execute([NULL, $this->isbn, 0])) {
                $flag = true;
            }
        }

        if (!$flag) {
            return true;
        } else {
            return false;
        }
        
    }
}