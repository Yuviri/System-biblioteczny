<?php

    class Collection extends Dbc
    {
        private $error;
        private $list;

        // Funkcja pobiera dane z tabeli szczegoly
        private function get_list(){
            $sql = "SELECT * FROM szczegoly ORDER BY nazwa";
            if($query = $this->connect()->query($sql)){

                $result = $query->fetchAll();
                $this->list = $result;
            } else {
                $this->error = 'Błąd połączenia z bazą';
            }   
        }

        private function generate_table(){

            // Licznik
            $n = 0;

            echo '<table class="table table-striped">
                <thead class="th-custom text-light">
                    <tr>
                        <th>#</th>
                        <th>Tytuł</th>
                        <th>Autor</th>
                        <th>Gatunek</th>
                        <th>ISBN</th>
                    </tr>
                </thead>
                <tbody>
            ';
            foreach ($this->list as $key => $value) {
                
                $n = $n+1;

                echo '
                    <tr>
                        <th>'.$n.'</th>
                        <td>'.$value['nazwa'].'</td>
                        <td>'.$value['autor'].'</td>
                        <td>'.$value['gatunek'].'</td>
                        <td>'.$value['ISBN'].'</td>
                    </tr>
                ';
            }

            echo '</tbody>
                </table>';
        }

        public function generate_list(){
            $this->get_list();

            if ($this->error) {
                return false;
            } else {
                $this->generate_table();
            }
        }
    }
    