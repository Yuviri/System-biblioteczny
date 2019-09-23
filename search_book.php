<?php
  
    require "database.php";
    
    if(isset($_POST['searchVal'])){
 
        $q = filter_input(INPUT_POST, 'searchVal', FILTER_SANITIZE_SPECIAL_CHARS);

        $searchq = $db->query("SELECT min(egzemplarz.id_egzemplarza) as id, szczegoly.nazwa, szczegoly.autor FROM egzemplarz, szczegoly WHERE egzemplarz.ISBN = szczegoly.ISBN AND egzemplarz.czy_wyp=0 OR(szczegoly.nazwa LIKE '%$q%' OR szczegoly.autor LIKE '%$q%' OR szczegoly.isbn LIKE '%$q%') GROUP BY szczegoly.isbn");

        $output = '<ul class="list-group">';

        if($searchq->rowCount()>0){
            $results = $searchq->fetchAll();

            foreach ($results as $key => $value) {
                $output.= '    
                
                    <li class="list-group-item d-flex book-suggestion" id="'.$value['id'].'">
                        <span class="d-inline-block mr-5">'.$value['nazwa'].'</span>
                        <span class="d-inline-block search-author ml-5 align-self-center">'.$value['autor'].'</span>
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


