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

        <div class="container mt-2 bg-light text-body">

            <main>

            <nav class="navbar navbar-expand-lg navbar-light bg-light user_subnav">
                
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="user_lends.php" class="nav-link">Aktywne</a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="user_lends_history.php" class="nav-link  active">Historia</a>
                    </li>
                </ul>
                
            </nav>

                <?php
                    require_once "database.php";

                    $email = $_SESSION['email'];

                    $query = $db->query("SELECT wypozyczenie.id_wyp, uzytkownik.imie, uzytkownik.nazwisko, wypozyczenie.od, wypozyczenie.data_zwrotu, szczegoly.nazwa FROM wypozyczenie, szczegoly, egzemplarz, uzytkownik WHERE wypozyczenie.czytelnik='$email' AND wypozyczenie.id_egzemplarza=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND data_zwrotu IS NOT NULL AND imie in (SELECT imie FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email) AND nazwisko in (SELECT nazwisko FROM uzytkownik WHERE wypozyczenie.pracownik = uzytkownik.email)");
                    $result = $query->fetchAll();

                    foreach ($result as $row => $value) {
                    echo '    
                        <div class="book_tab_min row border p-2">

                            <div class="book_info col-2 text-left my-auto">
                                <span class="text-left mt-1">ID: '.$value["id_wyp"].'</span>
                            </div>

                            <div class="book_info col-2 text-left my-auto">
                                <h2 class="h3 text-left mt-1">'.$value["nazwa"].'</h2>
                            </div>

                            <div class="book_info col-4 text-left my-auto">
                                <span class="text-left">Wypożyczone przez: '.$value['imie'].' '.$value['nazwisko'].'</span>
                            </div>

                            <div class="book_info col-4 text-left my-auto">
                                <span class="d-block text-left">Data wypożyczenia: '.$value['od'].'</span>
                                <span class="d-block text-left">Data zwrotu: '.$value['data_zwrotu'].'</span>
                            </div>
                        
                        </div>
                        ';
                    }
                ?>
            </main>
        </div>
 
    </section>

</main>

   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap/bootstrap.min.js"></script>


</body>
</html>