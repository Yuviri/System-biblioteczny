<?php

class Comments extends Dbc 
{
    private $error;
    private $edit;

    public function addComment($email, $book, $date, $content){
        $sql = "INSERT INTO komentarze VALUES (NULL, ?, ?, ?, ?)";
        $query = $this->connect()->prepare($sql);
        if ($query->execute([$email, $book, $date, $content])) {
            return true;
        } else {
            $this->error = $query->errorInfo();
            return false;
        }
    }

    public function editComment($email, $book, $content){
        $sql = "UPDATE komentarze SET tresc = ? WHERE autor=? AND ksiazka=?";
        $query = $this->connect()->prepare($sql);
        if ($query->execute([$content, $email, $book])) {
            $this->edit = $content;
            return true;
        } else {
            $this->error = $query->errorInfo();
            return false;
        }
    }

    public function get_error(){
        return $this->error;
    }

    public function get_edit(){
        return $this->edit;
    }

}
