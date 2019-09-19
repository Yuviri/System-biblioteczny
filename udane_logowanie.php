<!DOCTYPE html>
<html>
    <?php
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 
            if(isset($_SESSION['imie']) && isset($_SESSION['nazwisko'])){
                require_once('database.php');
            }
            else{
                header('Location: index.php?error=unknown');
                exit();
            }
    ?>	

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

                <li class="nav-item">
                    <a href="login_form.php" class="nav-link">Logowanie</a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="submenu">Imię i nazwisko</a>

                    <div class="dropdown-menu" aria-labelledby="submenu">
                        <a href='user_lends.php' class="dropdown-item">Moje wypożyczenia</a>
                        <a href="settings.php" class="dropdown-item">Ustawiena konta</a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item">Wyloguj się </a>
                    </div>
                </li>

            </ul>

        </div>
    </nav>

</header>
<main>
    <section class="main_page">

        <div class="container mt-4 bg-light text-body">
            <header>
                <h1>Strona główna projektu dyplomowego</h1>
                <p>Tu coś będzie w niedalekiej przyszłości.</p>
            </header>
            <article>
                <div class="user_control">
                    <?php 
                        echo "Witaj ".$_SESSION['imie']." ".$_SESSION['nazwisko'];
                    ?>
                <br>
                    <a class="check_t" href="user_panel.php">Panel użytkownika</a>
                    <a class="logout" href="logout.php">Wyloguj się</a>
                </div>
            </article>
        </div>
 
    </section>

</main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap.min.js"></script>


</body>
</html>
