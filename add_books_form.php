<?php
    session_start();
    if($_SESSION['uprawnienia']!='pracownik'){
        header('Location: index.php');
    }

    function checkSessionVar($var){
        if(isset($_SESSION[$var])){
          echo $_SESSION[$var];
          unset($_SESSION[$var]);
        }
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
                <h1 class="py-3">Nowa pozycja</h1>
            </header>
            <article class="lend_form mx-auto">
                <?=isset($_SESSION['a-error']) ? $_SESSION['a-error'] : ""?>
                <?=isset($_SESSION['a-success']) ? $_SESSION['a-success'] : ""?>
                <?php 
                if (isset($_SESSION['a-success'])) unset($_SESSION['a-success']);
                if (isset($_SESSION['a-error'])) unset($_SESSION['a-error']);
                ?>
                <form action="includes/add_books.inc.php" method="post">
                    <div class="row">
                        <div class="form-group col-12 text-left">
                            <label for="isbn">ISBN</label>
                            <input name="isbn" id="isbn" class="form-control <?=isset($_SESSION['a_isbn_err']) ? 'is-invalid' : ''?>" autocomplete="off" />
                            <?php checkSessionVar('a_isbn_err');?>
                        </div>

                        <div class="form-group col-12 text-left">
                            <label for="title">Tytuł</label>
                            <input name="title" id="title" class="form-control <?=isset($_SESSION['a_title_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php checkSessionVar('fill_title');?>" />
                            <?php checkSessionVar('a_title_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="author">Autor</label>
                            <input name="author" id="author" class="form-control <?=isset($_SESSION['a_author_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php checkSessionVar('fill_author');?>" />
                            <?php checkSessionVar('a_author_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="o_title">Tytuł oryginału</label>
                            <input name="o_title" id="o_title" class="form-control <?=isset($_SESSION['a_o_title_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php checkSessionVar('fill_o_title');?>" />
                            <?php checkSessionVar('a_o_title_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="genre">Gatunek</label>
                            <input name="genre" id="genre" class="form-control <?=isset($_SESSION['l_genre_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php checkSessionVar('fill_genre');?>" />
                            <?php checkSessionVar('l_genre_err');?>
                        </div>

                        <div class="form-group col-12 text-left">
                            <label for="publisher">Wydawnictwo</label>
                            <!-- <input name="publisher" id="publisher" class="form-control <?=isset($_SESSION['l_publisher_err']) ? 'is-invalid' : ''?>" autocomplete="off" /> -->
                            <select name="publisher" id="publisher" class="form-control">
                                <?php require_once 'get_publishers.php' ?>
                            </select>
                            <?php checkSessionVar('l_publisher_err');?>
                        </div>

                        <div class="form-group col-12 text-left">
                            <label for="cover">Okładka</label>
                            <input name="cover" id="cover" class="form-control <?=isset($_SESSION['l_cover_err']) ? 'is-invalid' : ''?>" autocomplete="off" />
                            <!-- <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cover" lang="pl-Pl">
                                <label class="custom-file-label" for="cover" data-browse="Przeglądaj">Wybierz pliki</label>
                            </div> -->
                            <?php checkSessionVar('l_cover_err');?>
                        </div>

                        <div class="form-group col-12 text-left">
                            <label for="description">Opis</label>
                            <textarea class="form-control <?=isset($_SESSION['l_description_err']) ? 'is-invalid' : ''?>" id="description" name="description" rows="7"><?php checkSessionVar('fill_description');?></textarea>
                            <?php checkSessionVar('l_description_err');?>
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
    <!-- <script src="scripts/katalog.js"></script> -->


</body>
</html>