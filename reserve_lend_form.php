<?php
    session_start();
    require_once 'includes/get_date.inc.php';
    
    if(!isset($_SESSION["zalogowany"]) || $_SESSION['uprawnienia']!='pracownik'){
        header("Location: index.php");
    }
    

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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    </head>
<body>


<header>

    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
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
                            <a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false' id='submenu'>Wypożyczenia i zwroty</a>
                           
                            <div class='dropdown-menu' aria-labelledby='submenu'>
                                <a href='lend_form.php' class='dropdown-item'>Wypożyczenia</a>
                                <div class='dropdown-divider'></div>
                                <a href='return_form.php' class='dropdown-item'>Zwroty</a>
                                <div class='dropdown-divider'></div>
                                <a href='reserve_lend_form.php' class='dropdown-item'>Obsługa rezerwacji</a>
                            </div>
                        </li>
                        <li class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false' id='submenu'>Dodaj książki</a>
                           
                            <div class='dropdown-menu' aria-labelledby='submenu'>
                                <a href='add_books_form.php' class='dropdown-item'>Nowa pozycja</a>
                                <div class='dropdown-divider'></div>
                                <a href='return_form.php' class='dropdown-item'>Istniejąca pozycja</a>
                            </div>
                        </li>";
                    }
                ?>

                <?php
                    if (!isset($_SESSION['zalogowany'])) {
                        echo '<li class="nav-item">
                                <a href="register.php" class="nav-link">Rejestracja</a>
                            </li>';
                    }  
                ?>


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

        <div class="container mt-4 bg-light text-body">
            <header>
                <h1 class="py-3">Wypożyczenie zarezerwowanych egzemplarzy</h1>
            </header>
            <article class="lend_form mx-auto">
                <?=isset($_SESSION['lendr-success']) ? $_SESSION['lendr-success'] : ""?>
                <?=isset($_SESSION['lendr-err']) ? $_SESSION['lendr-err'] : ""?>
                <?php 
                if (isset($_SESSION['public-err'])) unset($_SESSION['public-err']);
                if (isset($_SESSION['lendr-err'])) unset($_SESSION['lendr-err']);
                ?>
                <form action="scripts/reserve_lend.php" method="post">
                    <div class="row">
                        <!-- <div class="form-group col-12 text-left">
                            <label for="czytelnik_input">Czytelnik</label>
                            <input list="czytelnik" name="czytelnik" id="czytelnik_input" class="form-control <?=isset($_SESSION['l_email_err']) ? 'is-invalid' : ''?>" autocomplete="off" />
                            <datalist id="czytelnik" >
                                <?php
                                require_once "get_users.php";
                                ?>
                            </datalist>
                            <?php checkSessionVar('l_email_err');?>
                        </div> -->
                        
                        <div class="form-group col-12 text-left">
                            <label for="rezerwacje_input">Rezerwacja</label>
                            <select class="selectpicker form-control border" data-show-subtext="true" name="reservation" id="rezerwacje_input" data-style="btn-white">
                                <?php
                                require_once "get_reservations.php";
                                ?>
                            </select>
                            <?php checkSessionVar('l_res_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="od">Data wypożyczenia</label>
                            <input type="date" id="od" name="od" class="form-control" value="<?= $today ?>">
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="do">Przybliżona data zwrotu</label>
                            <input type="date" id="do" name="do" class="form-control" value="<?= $estimated ?>">
                        </div>

                        <input type="submit" value="Zatwierdź" class="btn btn-primary mx-auto mb-5">

                    </div>
                </form>
            </article>
        </div>
 
    </section>


</main>

   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>


</body>
</html>