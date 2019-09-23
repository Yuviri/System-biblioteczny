<?php
    session_start();
    require_once 'includes/get_date.inc.php';
      
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

        <div class="container mt-4 bg-light text-body">
            <header>
                <h1>Zwroty</h1>
            </header>
            <article class="lend_form mx-auto">
                <?=isset($_SESSION['public-err']) ? $_SESSION['public-err'] : ""?>
                <?=isset($_SESSION['dev-err']) ? $_SESSION['dev-err'] : ""?>
                <?=isset($_SESSION['success']) ? $_SESSION['success'] : ""?>
                <?=isset($_SESSION['nonexisting-err']) ? $_SESSION['nonexisting-err'] : ""?>
                <?php 
                if (isset($_SESSION['public-err'])) unset($_SESSION['public-err']);
                if (isset($_SESSION['dev-err'])) unset($_SESSION['dev-err']);
                if (isset($_SESSION['success'])) unset($_SESSION['success']);
                if (isset($_SESSION['nonexisting-err'])) unset($_SESSION['nonexisting-err']);
                ?>
                <form action="return.php" method="post">
                    <!-- <div class="row">
                        <div class="form-group col-12 text-left">
                            <label for="czytelnik_input">Czytelnik</label>
                            <input list="czytelnik" name="czytelnik" id="czytelnik_input" class="form-control <?=isset($_SESSION['l_email_err']) ? 'is-invalid' : ''?>" autocomplete="off" />
                            <datalist id="czytelnik" >
                                <?php
                                //require_once "get_users.php";
                                ?>
                            </datalist>
                            <?//php checkSessionVar('l_email_err');?>
                        </div> -->
                        
                        <div class="form-group col-12 text-left">
                            <label for="egzemplarz_input">Nr egzemplarza</label>
                            <!-- <input type="text" id="egzemplarz" name="egzemplarz" class="form-control" autocomplete="off">
                            <div class="search-list" id='b-list'>

                            </div> -->
                            <input list="egzemplarz" name="egzemplarz" id="egzemplarz_input" class="form-control <?=isset($_SESSION['r_egz_err']) ? 'is-invalid' : ''?>" autocomplete="off" />
                            <datalist id="egzemplarz" >
                                <?php
                                require_once "get_books_lended.php";
                                ?>
                            </datalist>
                            <?php checkSessionVar('r_egz_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="od">Data zwrotu</label>
                            <input type="date" id="data_zwrotu" name="data_zwrotu" class="form-control" value="<?= $today ?>">
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


</body>
</html>