<?php

class BookPageView extends BookPage{
    public function generateBookPage($isbn, $email){
        $data = $this->getBookPage($isbn);
        $data_comm = $this->getComments($isbn);
        
        //Zmienna która przechowuje informację o tym, czy dany użytkownik napisał swój komentarz czy nie
        $flag = false;

        if ($data) {
            foreach ($data as $key => $value) {
                echo '<div class="row basic_info">
                    <div class="cover col-md-4 p-2 text-center">
                        <img src="'.$value['cover'].'" alt="'.$value['nazwa'].'" class="img-thumbnail">
                        <div class="item_controls mt-3 px-4">
                            <a href="reserve.php?id='.$value['id'].'" class="btn btn-primary item_page_res">Zarezerwuj</a>
                        </div>
                    </div>

                    <div class="b_info col-md-8 position-relative-parent">

                        <h2 class="title text-left mt-2">'.$value['nazwa'].'</h2>
                        <p class="author text-left">'.$value['autor'].'</p>
                        <p class="publisher text-left"> Wydawnictwo: '.$value['nazwa_wydawnictwa'].'</p>
                        <p class="genre text-left">Gatunek: '.$value['gatunek'].'</p>
                        <p class="oryginal_title text-left">Tytuł oryginału: '.$value['tytul_oryginalu'].'</p>
                        
                        <p class="text-left mt-4 font-weight-bold">Opis</p>
                        <p class="description_page text-justify pr-md-4">'.$value['opis'].'</p>
                    </div>
                </div>
                <section class="comments">
                <h1>Opinie czytelników</h1>';
                
                //Jeśli nie ma żadnych komentarzy w bazie
                if($data_comm===0){
                    echo '
                    <div class="comment row border d-flex p-3">
                        <div class="col-12 align-self-center">
                            <p class="comment-info d-inline-block mx-5">Ta książka nie ma jeszcze żadnych opinii. Czy chcesz napisać pierwszą?</p>
                           <a href="#" class="btn btn-primary d-inline-block write-comment px-4">Napisz</a>
                        </div>
                    </div>
                ';
                $flag = true;
                } else {
                    //Jeśli są komentarze

                    foreach ($data_comm as $key => $value) {
                        //Sprawdzam czy istnieje komentarz napisany przez zalogowanego użytkownika
                        if ($value['email']===$email) {
                            //wypisuję komentarz użytkownika
                            echo '
                        <div class="comment-own row border d-flex p-3">
                               <div class="col-md-2 author text-center align-self-center">
                                    <img src="'.$value['awatar'].'" alt="Avatar" class="mt-2">
                                    <span class="d-block mt-1">'.$value['imie'].' '.$value['nazwisko'].'</span>
                                    <span class="d-block mt-1 add_date">'.$value['data_w'].'</span>
                               </div>
                               <div class="col-md-8 comm-content">
                                    <p>'.$value['tresc'].'</p> 
                               </div>
                               <div class="col-md-2 comm-rating text-center">
                                    <p>Liczba polubień: <span class="text-success">'.$value['za'].'</span></p>
                                    <a href="#" class="btn btn-primary">Edytuj opinię</a>
                               </div> 
                        </div>
                        ';

                        $flag = true;
                        } else {
                            //wypisuję normalne komentarze
                            echo '
                        <div class="comment row border d-flex p-3">
                               <div class="col-md-2 author text-center align-self-center">
                                    <img src="'.$value['awatar'].'" alt="Avatar" class="mt-2">
                                    <span class="d-block mt-1">'.$value['imie'].' '.$value['nazwisko'].'</span>
                                    <span class="d-block mt-1 add_date">'.$value['data_w'].'</span>
                               </div>
                               <div class="col-md-8 comm-content">
                                    <p>'.$value['tresc'].'</p> 
                               </div>
                               <div class="col-md-2 comm-rating text-center">
                                    <p>Liczba polubień: <span class="text-success">'.$value['za'].'</span></p>
                                    <a href="#" class="btn btn-success">Polub opinię</a>
                               </div> 
                        </div>
                        ';
                        }
                        
                    }
                }

                if (!$flag) {
                    echo '<div class="comment row border d-flex p-3">
                    <div class="col-12 align-self-center">
                        <p class="comment-info d-inline-block mx-5">Nie mamy twojej opinii o tej książce. Czy chcesz ją napisać?</p>
                       <a href="#" class="btn btn-primary d-inline-block write-comment px-4">Napisz</a>
                    </div>
                </div>';
                } 


                echo '</section>';

            }
        } else {
            header('Location: katalog.php');
        }
    }
}