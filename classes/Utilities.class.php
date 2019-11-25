<?php

class Utilities extends Dbc
{
    private $today;
    private $estimated;
    private $error;

    public function __construct(){
        $this->today = new DateTime();
        $this->estimated = new DateTime();
        $this->today = $this->today->format("Y-m-d");
        $this->estimated = $this->estimated->add(new DateInterval("P01M"));
        $this->estimated = $this->estimated->format("Y-m-d");
    }

    public function get_today(){
        return $this->today;
    }

    public function get_estimated(){
        return $this->estimated;
    }

    public function get_reservations(){

        $query = $this->connect()->query("SELECT rezerwacja.id_rez, rezerwacja.czytelnik, szczegoly.nazwa FROM rezerwacja, szczegoly, egzemplarz WHERE rezerwacja.egzemplarz=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND status='aktywna'");
          
        $result = $query->fetchAll();
          
        $output = "";
          
        foreach ($result as $key => $value) {
        $output.= '<option value="'.$value['id_rez'].'" data-subtext="'.$value['czytelnik'].'">'.$value['nazwa'].'</option>';
        }
          
        return $output;
        }

    public function get_users(){

        $query = $this->connect()->query("SELECT imie, nazwisko, email FROM uzytkownik");

        $result = $query->fetchAll();
      
        $output = "";
      
        foreach ($result as $key => $value) {
          $output.= '<option class="person-item" value="'.$value['email'].'">'.$value['imie'].' '.$value['nazwisko'].'</option>';
        }
      
        return $output;
        }

    public function get_publishers(){

        $query = $this->connect()->query("SELECT id_wydawnictwa, nazwa_wydawnictwa FROM wydawnictwo");

        $result = $query->fetchAll();
      
        $output = "";
      
        foreach ($result as $key => $value) {
          $output.= '<option value="'.$value['id_wydawnictwa'].'">'.$value['nazwa_wydawnictwa'].'</option>';
        }
        
        return $output;
        }

    public function get_books(){

        $query = $this->connect()->query("SELECT min(egzemplarz.id_egzemplarza) as id, szczegoly.nazwa, szczegoly.autor FROM egzemplarz, szczegoly WHERE egzemplarz.ISBN = szczegoly.ISBN AND egzemplarz.czy_wyp=0 GROUP BY szczegoly.isbn");

        $result = $query->fetchAll();
      
        $output = "";
      
        foreach ($result as $key => $value) {
          $output.= '<option class="person-item" value="'.$value['id'].'">'.$value['nazwa'].'</option>';
        }
        
        return $output;
        }

    public function get_books_lended(){

        $query = $this->connect()->query("SELECT egzemplarz.id_egzemplarza, szczegoly.nazwa, szczegoly.autor FROM egzemplarz, szczegoly WHERE egzemplarz.ISBN = szczegoly.ISBN AND egzemplarz.czy_wyp=1");

        $result = $query->fetchAll();
      
        $output = "";
      
        foreach ($result as $key => $value) {
          $output.= '<option class="person-item" value="'.$value['id_egzemplarza'].'">'.$value['nazwa'].'</option>';
        }
        
        return $output;
        }

    public function get_isbns(){

        $query = $this->connect()->query("SELECT ISBN, nazwa FROM szczegoly");

        $result = $query->fetchAll();
        
        $output = "";
        
        foreach ($result as $key => $value) {
            $output.= '<option class="person-item" value="'.$value['ISBN'].'">'.$value['nazwa'].'</option>';
        }
        
        return $output;
        }

    public function checkSessionVar($var){
        if(isset($_SESSION[$var])){
            echo $_SESSION[$var];
            unset($_SESSION[$var]);
            }
        }

}
