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

                <li class="nav-item">
                    <a href="#" class="nav-link">Wypożyczenia i zwroty</a>
                </li>

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
                                <a href='user-lends.php' class='dropdown-item'>Moje wypożyczenia</a>
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
    <section>
        <div class="container">
            <form action="login.php" method="POST">
                <div class="row mt-4">

                <?php
                    if(isset($_SESSION["err-public"])){
                        echo "<div class='alert alert-warning col-11 mx-auto mt-4' role='alert'>".
                        $_SESSION["err-public"].
                        "</div>";
                        unset($_SESSION["err-public"]);
                    }
                    if(isset($_SESSION["err-dev"])){
                        echo "<div class='alert alert-info col-11 mx-auto mt-2' role='alert'>".
                        $_SESSION["err-dev"].
                        "</div>";
                        unset($_SESSION["err-dev"]);
                    }
                    ?>

                    <div class="form-group col-12">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control <?php if(isset($_SESSION["err-login"])){
                            echo "is-invalid";
                        } ?>">
                    </div>
                    <div class="form-group col-12">
                        <label for="password">Hasło:</label>
                        <input type="password" name="password" id="password" class="form-control <?php if(isset($_SESSION["err-login"])){
                            echo "is-invalid";
                        } ?>">
                        <?php if(isset($_SESSION["err-login"])){
                            echo $_SESSION["err-login"];
                            unset($_SESSION["err-login"]);
                        } ?>
                    </div>
                    <input type="submit" value="Zaloguj się" class="btn btn-success mx-auto d-block mt-4">
                </div>
            </form>
        </div>
    </section>
</main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap.min.js"></script>

</body>
</html>