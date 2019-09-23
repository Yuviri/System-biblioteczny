<?php
  
    require "database.php";
    
    if(isset($_POST['searchVal'])){
 
        $q = filter_input(INPUT_POST, 'searchVal', FILTER_SANITIZE_SPECIAL_CHARS);

        $searchq = $db->query("SELECT imie, nazwisko, email FROM uzytkownik WHERE imie LIKE '%$q%' OR nazwisko LIKE '%$q%' OR email LIKE '%$q%'");

        $output = '<ul class="list-group">';

        if($searchq->rowCount()>0){
            $results = $searchq->fetchAll();

            foreach ($results as $key => $value) {
                $output.= '    
                
                    <li class="list-group-item d-flex user-suggestion" id="'.$value['email'].'">
                        <span class="d-inline-block mr-5">'.$value['imie'].' '.$value['nazwisko'].'</span>
                        <span class="d-inline-block search-author ml-5 align-self-center">'.$value['email'].'</span>
                    </li>      

                         ';
            }
            $output.= '</ul>';
        } else {
            $output = "<h2 class='my-4'>Brak wyników</h2>";
        }
        echo ($output);
    } 

?>


