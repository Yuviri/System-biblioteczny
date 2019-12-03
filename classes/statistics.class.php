<?php

class Statistics extends Dbc
{
    private $daily_data_lend;
    private $daily_data_return;
    private $monthly_data_lend;
    private $monthly_data_return;
    private $error;

    public function lend_stats($date){
        $sql = "SELECT wypozyczenie.id_wyp, wypozyczenie.czytelnik, pracownik.imie, pracownik.nazwisko, szczegoly.nazwa FROM wypozyczenie, pracownik, egzemplarz, szczegoly WHERE wypozyczenie.pracownik=pracownik.id_pracownika AND wypozyczenie.id_egzemplarza=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND wypozyczenie.od = '$date'";

        $output = "";

        $query = $this->connect()->query($sql);

        $rows = $query->rowCount();

        if($rows==0){
            $output = "Brak wyników". " ". $date;
        } else {

            $output = '
            <h1 class="text-center">'.$date.'</h1>
            <table class="table text-center my-5">
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
        }
        $this->daily_data_lend = $result;
        return $output;
    }

    public function return_stats($date){
        $sql = "SELECT wypozyczenie.id_wyp, wypozyczenie.czytelnik, pracownik.imie, pracownik.nazwisko, szczegoly.nazwa, wypozyczenie.od FROM wypozyczenie, pracownik, egzemplarz, szczegoly WHERE wypozyczenie.pracownik=pracownik.id_pracownika AND wypozyczenie.id_egzemplarza=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND wypozyczenie.data_zwrotu = '$date'";

        $output = "";

        $query = $this->connect()->query($sql);

        $rows = $query->rowCount();

        if($query->rowCount()==0){
            $output = "Brak wyników". " ". $date;
        } else {

            $output = '
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
        }
        
        $this->daily_data_return = $result;
        return $output;
    }

    public function monthly_lends($month){
        $sql = "SELECT wypozyczenie.id_wyp, wypozyczenie.czytelnik, pracownik.imie, pracownik.nazwisko, szczegoly.nazwa FROM wypozyczenie, pracownik, egzemplarz, szczegoly WHERE wypozyczenie.pracownik=pracownik.id_pracownika AND wypozyczenie.id_egzemplarza=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND wypozyczenie.od LIKE '%$month%'";
    
        $output = "";

        $query = $this->connect()->query($sql);

        $rows = $query->rowCount();

        if($query->rowCount()==0){
            $output = "Brak wyników". " ". $month;
        } else {

            $output = '
            <h1 class="text-center">'.substr($month, 0, 7).'</h1>
            <table class="table text-center my-5">
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
        }
        
        $this->monthly_data_lend = $result;
        return $output;
    }

    public function monthly_returns($month){
        $sql = "SELECT wypozyczenie.id_wyp, wypozyczenie.czytelnik, pracownik.imie, pracownik.nazwisko, szczegoly.nazwa, wypozyczenie.od FROM wypozyczenie, pracownik, egzemplarz, szczegoly WHERE wypozyczenie.pracownik=pracownik.id_pracownika AND wypozyczenie.id_egzemplarza=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND wypozyczenie.data_zwrotu LIKE '%$month%'";
    
        $output = "";

        $query = $this->connect()->query($sql);

        $rows = $query->rowCount();

        if($query->rowCount()==0){
            $output = "Brak wyników". " ". $month;
        } else {

            $output = '
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
        }
        
        $this->monthly_data_return = $result;
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


    // Wyświetlanie podsumowań



}





