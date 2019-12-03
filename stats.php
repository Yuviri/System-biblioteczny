<?php
    session_start();
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
                <select name="rok" id="rok" disabled="disabled" class="form-control col-md-3">
                    <option value="2019">2019</option>
                </select>
                <select name="miesiac" id="miesiac" class="form-control col-md-3">
                    <option value="01">Styczeń</option>
                    <option value="02">Luty</option>
                    <option value="03">Marzec</option>
                    <option value="04">Kwiecień</option>
                    <option value="05">Maj</option>
                    <option value="06">Czerwiec</option>
                    <option value="07">Lipiec</option>
                    <option value="08">Sierpień</option>
                    <option value="09" selected="selected">Wrzesień</option>
                    <option value="10">Październik</option>
                    <option value="11">Listopad</option>
                    <option value="12">Grudzień</option>
                </select>
                <input type="number" class="form-control col-md-3" name="dzien" id="dzien" placeholder="Wpisz dzień">
                <button class="text-center col-md-2 btn btn-primary" onclick='day_search()'>Wyświetl</button>
            </div>
            
            <div id="rep_page" class="pt-5">
                
            <!-- <a href='scripts/testy.php'>Test</a> -->
                
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