<?php

class AvailableBooks
{
    private $input;

    function __construct($result){
        $this->input = $result;
    }

    public function getInput(){
        return $this->input;
    }

    public function getOutput(){

        $output = '';
        foreach ($this->input as $key => $value) {
            $output .= '    
            <div class="book_tab row border">
                <div class="cover col-2 p-2">
                    <img src="'.$value["cover"].'" alt="Okładka">
                </div>
                <div class="book_info col-8">
                    <h2 class="h3 text-left mt-4">'.$value["nazwa"].'</h2>
                    <h3 class="h4 text-left mt-2">'.$value["autor"].'</h3>
                    <p class="description text-justify mt-4">'.substr($value["opis"],0,360)."...".'</p>
                </div>
                <div class="book_tab_controls col-2 text-center d-flexbox align-self-center">
                    <a href="#" class="btn btn-primary mt-5">Zarezerwuj</a>
                    <p class="books_counter mt-3">W bibliotece: <span class="font-weight-bold">'.$value["total"].'</span></p>
                </div>
            </div>
            ';
        }
        return $output;
    }
}
