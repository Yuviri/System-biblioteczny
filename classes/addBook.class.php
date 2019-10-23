<?php


class AddBook extends Dbc {
    
    private $isbn;
    private $title;
    private $author;
    private $o_title;
    private $genre;
    private $description;
    private $publisher;
    private $cover;

    public function __construct($isbn, $title, $author, $o_title, $genre, $description, $publisher, $cover){
        $this->isbn = $isbn;
        $this->title = $title;
        $this->author = $author;
        $this->o_title = $o_title;
        $this->genre = $genre;
        $this->description = $description;
        $this->publisher = $publisher;
        $this->cover = $cover;
    }

    public function addB(){
        $sql = "INSERT INTO szczegoly VALUES('$this->isbn', '$this->title', '$this->author', '$this->o_title', '$this->genre', '$this->description', '$this->publisher', '$this->cover')";
        

        if ($query = $this->connect()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
