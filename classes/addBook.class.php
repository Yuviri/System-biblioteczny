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
    private $upload_err;

    public function __construct($isbn, $title, $author, $o_title, $genre, $description, $publisher){
        $this->isbn = $isbn;
        $this->title = $title;
        $this->author = $author;
        $this->o_title = $o_title;
        $this->genre = $genre;
        $this->description = $description;
        $this->publisher = $publisher;
    }

    public function upload_cover($file, $title, $author){

        $fileName =  strtolower($file['name']);
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $actualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($actualExt, $allowed)){
            if ($fileError === 0) {
                // Rozmiar < 20MB
                if($fileSize <= 20000000){
                    $finalName = uniqid('', true).'.'.$actualExt;
                    $fileDestination = '../img/covers/'.$finalName;
                    $nameDb = 'img/covers/'.$finalName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $this->cover = $nameDb;
                    return true;

                } else{
                    $this->upload_err = "Obrazek jest za duży";
                    return false;
                }
            } else {
                $this->upload_err = "Wystąpił problem podczas przesyłania zdjęcia";
                return false;
            }
        } else {
            $this->upload_err = "Przesyłany plik musi być obrazkiem";
            return false;
        }
    }

    public function addB(){
        $sql = "INSERT INTO szczegoly VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $this->connect()->prepare($sql);

        if ($query->execute([$this->isbn, $this->title, $this->author, $this->o_title, $this->genre, $this->description, $this->publisher, $this->cover])) {
            return true;
        } else {
            return false;
        }
    }

    public function get_upload_err(){
        return $this->upload_err;
    }
}
