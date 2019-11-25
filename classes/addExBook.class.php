<?php


class AddExBook extends Dbc {
    
    private $isbn;
    private $quantity;
    

    public function __construct($isbn, $quantity){
        $this->isbn = $isbn;
        $this->quantity = $quantity;
    }

    public function addExB(){
        // $sql = "INSERT INTO szczegoly VALUES('$this->isbn', '$this->title', '$this->author', '$this->o_title', '$this->genre', '$this->description', '$this->publisher', '$this->cover')";
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