<?php

class AdminPanel extends Dbc
{
    
    private $error;


    public function generate_workers(){
        $sql = "SELECT * FROM pracownik";

        if(!$query = $this->connect()->query($sql)){
            $this->error = "Błąd połączenia z bazą danych";
        } else {
            if($query->rowCount()==0){
                echo "Brak kadry pracowniczej";
            } else {
                $result = $query->fetchAll();
                
                echo '<table class="table w_table">
                            <thead class="thead-dark">
                                <tr><th>#</th><th>Imię</th><th>Nazwisko</th><th>Email</th><th>Telefon</th><th>Akcja</th></tr>
                            </thead>
                            <tbody>';

                foreach ($result as $key => $value) {
                    echo '<tr>
                            <td>'.$value['id_pracownika'].'</td>
                            <td>'.$value['imie'].'</td>
                            <td>'.$value['nazwisko'].'</td>
                            <td>'.$value['email'].'</td>
                            <td>'.$value['telefon'].'</td>
                            <td><a href="#" class="btn btn-danger">Usuń</a></td>
                        </tr>';
                }
                echo '</tbody>
                    </table>';
            }
        }
    }


    public function add_worker($name, $surname, $email, $password, $gender, $phone){
        $sql = "INSERT INTO pracownik VALUES(NULL, ?, ?, ?, ?, ?, ?)";

        $query = $this->connect()->prepare($sql);
        
        if($query->execute([$name, $surname, $email, $password, $gender, $phone])){
            $_SESSION['reg_a_success'] = '<div class="alert alert-success">Pomyślnie dodano pracownika</div>';
            header('Location: ../admin_panel.php?success');
        } else {
            $_SESSION['reg_a_error'] = '<div class="alert alert-danger">Wystąpił problem połączenia z bazą danych</div>';
            header('Location: ../admin_panel.php?error');
        }
    }
}
