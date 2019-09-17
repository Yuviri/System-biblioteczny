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
        <link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    </head>
<body>


<header>

    <nav class="navbar navbar-dark navbar-expand-lg">
        <a href="index.php" class="navbar-brand d-inline-block">System Biblioteczny</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainmenu">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="katalog.php" class="nav-link">Katalog książek</a>
                </li>

                 <?php
                    if(isset($_SESSION["zalogowany"]) && $_SESSION['uprawnienia']=='pracownik'){
                        echo "
                        <li class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggl' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false' id='submenu'>Wypożyczenia i zwroty</a>
                           
                            <div class='dropdown-menu' aria-labelledby='submenu'>
                                <a href='lend_form.php' class='dropdown-item'>Wypożyczenia</a>
                                <div class='dropdown-divider'></div>
                                <a href='return_form.php' class='dropdown-item'>Zwroty</a>
                            </div>
                        </li>";
                    }
                ?>

                <li class="nav-item">
                    <a href="register.php" class="nav-link">Rejestracja</a>
                </li>


                <?php

                    if(isset($_SESSION["zalogowany"])){
                        echo "
                        <li class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggl' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false' id='submenu'>".
                            $_SESSION['imie']." ".$_SESSION['nazwisko']."</a>
                           
                            <div class='dropdown-menu' aria-labelledby='submenu'>
                                <a href='user_lends.php' class='dropdown-item'>Moje wypożyczenia</a>
                                <a href='settings.php' class='dropdown-item'>Ustawiena konta</a>
                                <div class='dropdown-divider'></div>
                                <a href='logout.php' class='dropdown-item'>Wyloguj się </a>
                            </div>
                        </li>";
                    }else {
                        echo "
                            <li class='nav-item'>
                                <a href='login_form.php' class='nav-link'>Logowanie</a>
                            </li>
                        ";
                    }

                ?>
            </ul>

        </div>
    </nav>

</header>
<main>
    <section class="main_page">

        <div class="container mt-2 bg-light text-body">

            <main>

                <div class="row">
                
                    <div class="filters_pane col-12 p-2">
                        
                        <form method="get" class="form-inline float-left">
                            <select name="asc_desc" id="asc_desc" class="form-control mx-2">
                                <option value="asc" <?= isset($_GET['asc_desc']) && $_GET['asc_desc'] == "asc" ? "selected": ""?> >Rosnąco</option>
                                <option value="desc" <?= isset($_GET['asc_desc']) && $_GET['asc_desc'] == "desc" ? "selected": ""?> >Malejąco</option>
                            </select>
                            <select name="alpha_num" id="alpha_num" class="form-control mx-2">
                                <option value="szczegoly.nazwa" <?= isset($_GET['alpha_num']) && $_GET['alpha_num'] == "szczegoly.nazwa" ? "selected": ""?> >Alfabetycznie</option>
                                <option value="total" <?= isset($_GET['alpha_num']) && $_GET['alpha_num'] == "total" ? "selected": ""?> >Wg sztuk</option>
                            </select>
                            <button type="submit" class="btn btn-primary ml-2">Filtruj</button>
                        </form>

                        <form action="" method="get" class="form-inline float-right">
                            <input type="text" name="search_input" id="search_input" class="form-control" placeholder="wpisz szukaną frazę">
                            <button type="submit" class="btn btn-success ml-2">Szukaj</button>
                        </form>

                    </div>
                </div>
<!-- 
                <div class="book_tab row">
                    <div class="cover col-2 p-2">
                        <img src="img/covers/example.jpg" alt="Test">
                    </div>
                    <div class="book_info col-8">
                        <h2 class="h3 text-left mt-4">Lewa Ręka Boga</h2>
                        <h3 class="h4 text-left mt-2">Paul Hoffman</h3>
                        <p class="description text-justify mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum elit a tortor bibendum lobortis. In pellentesque gravida augue. Morbi vel eros nec dolor ornare hendrerit. Nullam semper hendrerit tincidunt. Morbi pellentesque viverra accumsan. Ut id ante scelerisque, accumsan sapien dapibus, pharetra ex. Sed consectetur metus non erat pulvinar molestie. Donec commodo enim et cursus mollis. Aliquam erat volutpat. Integer.</p>
                    </div>
                    <div class="book_tab_controls col-2 text-center d-flexbox align-self-center">
                        <a href="#" class="btn btn-primary mt-5">Zarezerwuj</a>
                        <a href="#" class="btn btn-primary mt-2">Wypożycz</a>
                        <p class="books_counter mt-3">W bibliotece: <span class="font-weight-bold">2</span></p>
                    </div>
                </div> -->
                <?php
                    require_once "database.php";

                    if(!isset($_GET["asc_desc"]) || !isset($_GET["alpha_num"])){
                        $asc_desc = "asc";
                        $alpha_num = "szczegoly.nazwa";
                    }else {
                        $asc_desc = $_GET["asc_desc"];
                        $alpha_num = $_GET["alpha_num"];
                    }

                    $query = $db->query("SELECT egzemplarz.id_egzemplarza, szczegoly.nazwa, szczegoly.autor, szczegoly.opis, szczegoly.cover, COUNT(*) as total  FROM egzemplarz, szczegoly WHERE czy_wyp!='1' AND szczegoly.ISBN=egzemplarz.ISBN GROUP BY egzemplarz.ISBN ORDER BY $alpha_num $asc_desc");
                    $result = $query->fetchAll();

                    foreach ($result as $row => $value) {
                    echo '    
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
                                <a href="#" class="btn btn-primary mt-2">Wypożycz</a>
                                <p class="books_counter mt-3">W bibliotece: <span class="font-weight-bold">'.$value["total"].'</span></p>
                            </div>
                        </div>
                        ';
                    }
                ?>
            </main>
        </div>
 
    </section>

</main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap.min.js"></script>


</body>
</html>