<?php
  
    require "database.php";
    
    if(isset($_POST['searchVal'])){
 
        $q = filter_input(INPUT_POST, 'searchVal', FILTER_SANITIZE_SPECIAL_CHARS);
        $asc_desc = filter_input(INPUT_POST, 'asc_desc', FILTER_SANITIZE_SPECIAL_CHARS);
        $alpha_num = filter_input(INPUT_POST, 'alpha_num', FILTER_SANITIZE_SPECIAL_CHARS);

        $searchq = $db->query("SELECT egzemplarz.id_egzemplarza, szczegoly.isbn, szczegoly.nazwa, szczegoly.autor, szczegoly.opis, szczegoly.cover, COUNT(*) as total  FROM egzemplarz, szczegoly WHERE czy_wyp!='1' AND szczegoly.ISBN=egzemplarz.ISBN AND (szczegoly.nazwa LIKE '%$q%' OR szczegoly.autor LIKE '%$q%' OR szczegoly.opis LIKE '%$q%') GROUP BY egzemplarz.ISBN ORDER BY $alpha_num $asc_desc");

        $output = "";

        if($searchq->rowCount()>0){
            $results = $searchq->fetchAll();

            foreach ($results as $key => $value) {
                $output.= '    
                        <div class="book_tab row border">
                            <div class="cover col-12 col-lg-2 p-2">
                                <img src="'.$value["cover"].'" alt="Okładka">
                            </div>
                            <div class="book_info col-12 col-lg-8">
                                <h2 class="h3 text-left mt-4">'.$value["nazwa"].'</h2>
                                <h3 class="h4 text-left mt-2">'.$value["autor"].'</h3>
                                <p class="description text-justify mt-4">'.$value["opis"]."...".'</p>
                            </div>
                            <div class="book_tab_controls col-12 col-lg-2 text-center d-flexbox align-self-center">
                                <a href="reserve.php?id='.$value['id_egzemplarza'].'" class="btn btn-primary mb-1 mb-lg-0 mt-0 mt-lg-5">Zarezerwuj</a>
                                <a href="book_item.php?isbn='.$value['isbn'].'" class="btn btn-primary mb-1 mb-lg-0 mt-0 mt-lg-1">Zobacz więcej</a>
                                <p class="books_counter mt-3">W bibliotece: <span class="font-weight-bold">'.$value["total"].'</span></p>
                            </div>
                        </div>
                         ';
            }
        } else {
            $output = "<h2 class='my-4'>Brak wyników</h2>";
        }
        echo ($output);
    } 

?>


