<?php

class Statistics extends Dbc
{
    private $date;
    private $d_m;
    private $error;
    private $empty_flag_l;
    private $empty_flag_r;

    public function get_flags(){
        if($this->empty_flag_l || $this->empty_flag_r){
            return true;
        } else{
            return false;
        }   
    }

    public function lend_stats($date){
        $sql = "SELECT wypozyczenie.id_wyp, wypozyczenie.czytelnik, uzytkownik.imie, uzytkownik.nazwisko, szczegoly.nazwa, wypozyczenie.od FROM wypozyczenie, egzemplarz, szczegoly, uzytkownik WHERE wypozyczenie.id_egzemplarza=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND wypozyczenie.od LIKE '%$date%' AND imie in (SELECT imie FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email) AND nazwisko in (SELECT nazwisko FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email)";

        $output = "";

        $query = $this->connect()->query($sql);

        $rows = $query->rowCount();

        if($rows==0){
            $output = "<h3 class='text-center h4 mx-auto col-12'>Brak wypożyczeń na". " ". $date."</h3><br>";
            $this->empty_flag_l = true;
        } else {

            $output = '
            <h1 class="text-center mx-auto">'.$date.'</h1>
            <table class="table text-center my-5 col-12">
                <thead>
                    <tr>
                        <th class="text-center c-bg" colspan="4"><h4 class="font-weight-bold">Wypożyczenia</h4></th>
                    </tr>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Czytelnik</th>
                    <th scope="col">Pracownik</th>
                    <th scope="col">Tytuł</th>
                    </tr>
                </thead>
                <tbody>
                ';

            while($result = $query->fetch()){
                
                $output .= '
                    <tr>
                        <th scope="row">'.$result['id_wyp'].'</th>
                        <td>'.$result['czytelnik'].'</td>
                        <td>'.$result['imie'].' '.$result['nazwisko'].'</td>
                        <td>'.$result['nazwa'].'</td>
                    </tr>';
            }
            $output .= '
             <tr>
                <th colspan="4" class="text-center">Łącznie wyników: '.$rows.'</th>
             </tr>
            </tbody>
            </table>
        ';
        $this->empty_flag_l = false;
        }
        
        return $output;
    }

    public function return_stats($date){
        $sql = "SELECT wypozyczenie.id_wyp, wypozyczenie.czytelnik, uzytkownik.imie, uzytkownik.nazwisko, szczegoly.nazwa, wypozyczenie.od FROM wypozyczenie, egzemplarz, szczegoly, uzytkownik WHERE wypozyczenie.id_egzemplarza=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND wypozyczenie.data_zwrotu LIKE '%$date%' AND imie in (SELECT imie FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email) AND nazwisko in (SELECT nazwisko FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email)";

        $output = "";

        $query = $this->connect()->query($sql);

        $rows = $query->rowCount();

        if($query->rowCount()==0){
            $output = "<h3 class='text-center h4 mx-auto col-12'>Brak zwrotów na". " ". $date."</h3><br>";
            $this->empty_flag_r = true;
        } else {

            $output = '
            <table class="table text-center mb-5 col-12">
                <thead>
                    <tr>
                        <th class="text-center c-bg" colspan="5"><h4 class="font-weight-bold">Zwroty</h4></th>
                    </tr>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Czytelnik</th>
                    <th scope="col">Pracownik</th>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Data wypożyczenia</th>
                    </tr>
                </thead>
                <tbody>
                ';

            while($result = $query->fetch()){
                $output .= '
                    <tr>
                        <th scope="row">'.$result['id_wyp'].'</th>
                        <td>'.$result['czytelnik'].'</td>
                        <td>'.$result['imie'].' '.$result['nazwisko'].'</td>
                        <td>'.$result['nazwa'].'</td>
                        <td>'.$result['od'].'</td>
                    </tr>';
        }

        $output .= '
             <tr>
                <th colspan="5" class="text-center">Łącznie wyników: '.$rows.'</th>
             </tr>
            </tbody>
            </table>
        ';
        $this->empty_flag_r = false;
        }
        
        return $output;
    }


    //Eksport do excela

    public function export_stats($array1, $array2, $date){
        $output = '
            <table class="table text-center mb-5">
                <thead>
                    <tr>
                        <th class="text-center c-bg" colspan="4"><h4 class="font-weight-bold">Wypożyczenia</h4></th>
                    </tr>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Czytelnik</th>
                    <th scope="col">Pracownik</th>
                    <th scope="col">Tytuł</th>
                    </tr>
                </thead>
                <tbody>
                ';

            while($lends = $array1[0]){
                $output .= '
                    <tr>
                        <th scope="row">'.$lends['id_wyp'].'</th>
                        <td>'.$lends['czytelnik'].'</td>
                        <td>'.$lends['imie'].' '.$lends['nazwisko'].'</td>
                        <td>'.$lends['nazwa'].'</td>
                    </tr>';
        }

        $output .= '
             <tr>
                <th colspan="4" class="text-center">Łącznie wyników: '.sizeof($lends).'</th>
             </tr>
            </tbody>
            </table>
            <br><br>
        ';


        $output .= '
            <table class="table text-center mb-5">
                <thead>
                    <tr>
                        <th class="text-center c-bg" colspan="5"><h4 class="font-weight-bold">Zwroty</h4></th>
                    </tr>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Czytelnik</th>
                    <th scope="col">Pracownik</th>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Data wypożyczenia</th>
                    </tr>
                </thead>
                <tbody>
                ';

            while($returns = $array2[0]){
                $output .= '
                    <tr>
                        <th scope="row">'.$returns['id_wyp'].'</th>
                        <td>'.$returns['czytelnik'].'</td>
                        <td>'.$returns['imie'].' '.$returns['nazwisko'].'</td>
                        <td>'.$returns['nazwa'].'</td>
                        <td>'.$returns['od'].'</td>
                    </tr>';
        }

        $output .= '
             <tr>
                <th colspan="5" class="text-center">Łącznie wyników: '.sizeof($returns).'</th>
             </tr>
            </tbody>
            </table>
        ';

        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=raport_".$date.".xls");

        echo $output;
    }


    public function lend_export($date){
        $sql = "SELECT wypozyczenie.id_wyp, wypozyczenie.czytelnik, uzytkownik.imie, uzytkownik.nazwisko, szczegoly.nazwa, wypozyczenie.od FROM wypozyczenie, egzemplarz, szczegoly, uzytkownik WHERE wypozyczenie.id_egzemplarza=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND wypozyczenie.od LIKE '%$date%' AND imie in (SELECT imie FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email) AND nazwisko in (SELECT nazwisko FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email)";

        $output = "";

        $query = $this->connect()->query($sql);

        $rows = $query->rowCount();

        if($rows==0){
            $output = "<h3 class='text-center h4'>Brak wypożyczeń na". " ". $date."</h3><br>";
            $this->empty_flag_l = true;
        } else {
           
            while($result = $query->fetch()){
                $data[] = $result;
            }
            

            $this->empty_flag_l = false;
            }
        
        return $data;
    }

    public function return_export($date){
        $sql = "SELECT wypozyczenie.id_wyp, wypozyczenie.czytelnik, uzytkownik.imie, uzytkownik.nazwisko, szczegoly.nazwa, wypozyczenie.od FROM wypozyczenie, egzemplarz, szczegoly, uzytkownik WHERE wypozyczenie.id_egzemplarza=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND wypozyczenie.data_zwrotu LIKE '%$date%' AND imie in (SELECT imie FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email) AND nazwisko in (SELECT nazwisko FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email)";

        $output = "";

        $query = $this->connect()->query($sql);

        $rows = $query->rowCount();

        if($rows==0){
            $output = "<h3 class='text-center h4'>Brak zwrotów na". " ". $date."</h3><br>";
            $this->empty_flag_r = true;
        } else {
           
            while($result = $query->fetch()){
                $data[] = $result;
            }
            

            $this->empty_flag_r = false;
            }
        
        return $data;
    }
    



}





