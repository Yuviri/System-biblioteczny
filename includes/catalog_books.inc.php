<?php
    // session_start();

    require_once "autoloader.inc.php";
    require_once '../database.php';
                    
    // $query = $db->query("SELECT egzemplarz.id_egzemplarza, szczegoly.nazwa, szczegoly.autor, szczegoly.opis, szczegoly.cover, COUNT(*) as total  FROM egzemplarz, szczegoly WHERE czy_wyp!='1' AND czy_rez!='1' AND szczegoly.ISBN=egzemplarz.ISBN GROUP BY egzemplarz.ISBN ORDER BY szczegoly.nazwa ASC");
    // $result = $query->fetchAll();
    
    // foreach ($result as $row => $value) {
    //     echo '    
    //         <div class="book_tab row border">
    //             <div class="cover col-2 p-2">
    //                 <img src="'.$value["cover"].'" alt="Okładka">
    //             </div>
    //             <div class="book_info col-8">
    //                 <h2 class="h3 text-left mt-4">'.$value["nazwa"].'</h2>
    //                 <h3 class="h4 text-left mt-2">'.$value["autor"].'</h3>
    //                 <p class="description text-justify mt-4">'.substr($value["opis"],0,360)."...".'</p>
    //             </div>
    //             <div class="book_tab_controls col-2 text-center d-flexbox align-self-center">
    //                 <a href="#" class="btn btn-primary mt-5">Zarezerwuj</a>
    //                 <p class="books_counter mt-3">W bibliotece: <span class="font-weight-bold">'.$value["total"].'</span></p>
    //             </div>
    //         </div>
    //         ';
    //     }


    $books = new SimpleSelect("SELECT egzemplarz.id_egzemplarza, szczegoly.nazwa, szczegoly.autor, szczegoly.opis, szczegoly.cover, COUNT(*) as total  FROM egzemplarz, szczegoly WHERE czy_wyp!='1' AND czy_rez!='1' AND szczegoly.ISBN=egzemplarz.ISBN GROUP BY egzemplarz.ISBN ORDER BY szczegoly.nazwa ASC");

    $reservedBooks = new SimpleSelect("SELECT egzemplarz.id_egzemplarza, szczegoly.nazwa, szczegoly.autor, szczegoly.opis, szczegoly.cover FROM egzemplarz, szczegoly WHERE czy_wyp!='1' AND czy_rez='1' AND szczegoly.ISBN=egzemplarz.ISBN GROUP BY egzemplarz.ISBN ORDER BY szczegoly.nazwa ASC");

    echo $books->getQuery();
    echo $books->getResult();
    $books->sendQ();
    echo $books->getResult();

    // if($books->sendQ() && $reservedBooks->sendQ()){
    //     $availableBooks = new AvailableBooks($books->getResult());
    //     echo $availableBooks->getOutput();

    //     $reservedBooks = new ReservedBooks($books->getResult());
    //     echo $reservedBooks->getOutput();
    // } else {
    //     $_SESSION['catalog-err'] = "<div class='alert alert-warning'>Wystąpił problem z wczytaniem pozycji z bazy</div>";
    //     header('Location: ../katalog.php');
    // }