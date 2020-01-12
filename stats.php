<?php
    session_start();

    $year = date("Y");
    $month = date("m");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    </head>
<body>


<?php
    require_once "includes/navi.inc.php";
?>

<main>
    <section class="main_page">

        <div class="container mt-4 bg-light text-body">
            <header class="pt-1">
                <h1>Statystyki</h1>
            </header>
            <article>
                
            <div class="row justify-content-around pt-2">
                <!-- <input type="date" name="date" id="date" class="form-control col-md-6" onkeyup="day_search()"> -->
                <select name="rok" id="rok" class="form-control col-md-3">
                    <!-- <option value="2019">2019</option> -->

                    <?php

                        for ($i=$year; $i >= 2019 ; $i--) { 
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }

                    ?>
                </select>
                <select name="miesiac" id="miesiac" class="form-control col-md-3">
                    <option value="01" <?=$month==='01' ? 'selected="selected"' : '' ?>>Styczeń</option>
                    <option value="02" <?=$month==='02' ? 'selected="selected"' : '' ?>>Luty</option>
                    <option value="03" <?=$month==='03' ? 'selected="selected"' : '' ?>>Marzec</option>
                    <option value="04" <?=$month==='04' ? 'selected="selected"' : '' ?>>Kwiecień</option>
                    <option value="05" <?=$month==='05' ? 'selected="selected"' : '' ?>>Maj</option>
                    <option value="06" <?=$month==='06' ? 'selected="selected"' : '' ?>>Czerwiec</option>
                    <option value="07" <?=$month==='07' ? 'selected="selected"' : '' ?>>Lipiec</option>
                    <option value="08" <?=$month==='08' ? 'selected="selected"' : '' ?>>Sierpień</option>
                    <option value="09" <?=$month==='09' ? 'selected="selected"' : '' ?>>Wrzesień</option>
                    <option value="10" <?=$month==='10' ? 'selected="selected"' : '' ?>>Październik</option>
                    <option value="11" <?=$month==='11' ? 'selected="selected"' : '' ?>>Listopad</option>
                    <option value="12" <?=$month==='12' ? 'selected="selected"' : '' ?>>Grudzień</option>
                </select>
                <input type="number" class="form-control col-md-3" name="dzien" id="dzien" placeholder="Wpisz dzień">
                <button class="text-center col-md-2 btn btn-primary" onclick='day_search()'>Wyświetl</button>
            </div>
            
            <div id="rep_page" class="pt-5">
                
            </div>

            

            </article>
        </div>
 
    </section>  

</main>

   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap/bootstrap.min.js"></script>
    <script src="scripts/reports.js"></script>


</body>
</html>