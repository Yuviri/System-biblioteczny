<?php

class BookPage extends Dbc{
    protected function getBookPage($isbn){
        $sql = "SELECT min(egzemplarz.id_egzemplarza) as id, szczegoly.nazwa, szczegoly.autor, szczegoly.tytul_oryginalu, szczegoly.opis, szczegoly.gatunek, szczegoly.cover, szczegoly.wydawnictwo FROM szczegoly, egzemplarz WHERE szczegoly.isbn='$isbn' AND egzemplarz.isbn = szczegoly.isbn GROUP BY szczegoly.isbn";

        if($query = $this->connect()->query($sql)){
            
            $result = $query->fetchAll();

            foreach ($result as $key => $value) {
                $data[] = $value;
            }

            return $data;
        } else{
            return false;
        }
    }
    protected function getComments($isbn){
        $sql = "SELECT komentarze.id_komentarza, komentarze.autor, komentarze.data_w, komentarze.za, komentarze.tresc, uzytkownik.email, uzytkownik.imie, uzytkownik.nazwisko, uzytkownik.plec, uzytkownik.awatar FROM uzytkownik, komentarze, szczegoly WHERE uzytkownik.email = komentarze.autor AND komentarze.ksiazka = szczegoly.ISBN AND szczegoly.ISBN='$isbn'";

        if($query = $this->connect()->query($sql)){

            if($query->rowCount()>0){
                $result = $query->fetchAll();
                foreach ($result as $key => $value) {
                    $data_comm[] = $value;
                }
            } else {
                $data_comm = 0;
            }
            return $data_comm;
            
        } else{
            return false;
        }
    }
}