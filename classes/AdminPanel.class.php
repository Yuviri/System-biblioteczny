<?php

class AdminPanel extends Dbc
{
    
    private $error;


    public function generate_workers(){
        $sql = "SELECT * FROM uzytkownik WHERE uprawnienia='P'";
        $counter = 1;

        if(!$query = $this->connect()->query($sql)){
            $this->error = "Błąd połączenia z bazą danych";
        } else {
            if($query->rowCount()==0){
                echo "Brak kadry pracowniczej";
            } else {
                $result = $query->fetchAll();
                
                echo '<table class="table w_table">
                            <thead class="thead-dark">
                                <tr><th>#</th><th>Imię</th><th>Nazwisko</th><th>Email</th><th>Telefon</th></tr>
                            </thead>
                            <tbody>';

                foreach ($result as $key => $value) {
                    echo '<tr>
                            <td>'.$counter.'</td>
                            <td>'.$value['imie'].'</td>
                            <td>'.$value['nazwisko'].'</td>
                            <td>'.$value['email'].'</td>
                            <td>'.$value['telefon'].'</td>
                        </tr>';
                        $counter++;
                }
                echo '</tbody>
                    </table>';
            }
        }
    }

    public function checkWorker($email){
        // Funkcja sprawdza, czy istnieje uzytkownik o podanym mailu

        $sql = "SELECT * FROM uzytkownik WHERE email=?";

        $query = $this->connect()->prepare($sql);
        $query->execute([$email]);

        if($query->rowCount()>0){
            return false;
        } else{
            return true;
        }
    }

    public function add_worker($email, $password, $name, $surname, $gender, $phone){
        $sql = "INSERT INTO uzytkownik VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        if($gender==='K'){
            $avatar = 'img/avatars/defaultK.png';
        } else {
            $avatar = 'img/avatars/defaultM.png';
        }

        $query = $this->connect()->prepare($sql);
        
        if($query->execute([$email, $password, $name, $surname, $gender, $phone, $avatar, 'P'])){
            $_SESSION['reg_a_success'] = '<div class="alert alert-success">Pomyślnie dodano pracownika</div>';
            header('Location: ../admin_panel.php?success');
        } else {
            $_SESSION['reg_a_error'] = '<div class="alert alert-danger">Wystąpił problem połączenia z bazą danych</div>';
            header('Location: ../admin_panel.php?error');
        }
    }
}
