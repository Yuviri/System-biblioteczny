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
    require_once "includes/navi.inc.php" 
?>

<main>
    <section class="main_page">

        <div class="container mt-4 bg-light text-body">
            <header>
                <h1>Witaj w systemie bibliotecznym</h1>
            </header>

            <?php
            
            if(isset($_SESSION['zalogowany']) && $_SESSION['uprawnienia']=='U'){
                echo '
                <article>
                    <div class="row p-5">
                        <p class="col=12 text-justify">Tutaj możesz zarezerwować swoje ulubione książki oraz podzielić się opiniami na ich temat.</p>
                        <p class="col=12 text-justify">Witaj '.$_SESSION['imie'].'. Aby skorzystać z katalogu lub przejrzeć swoją aktywność w systemie skorzystaj z menu lub wybierz opcję poniżej. Aby zakończyć korzystanie z systemu skorzystaj z opcji wylogowania, klikając w swoje imię i nazwisko na górze strony.</p>
                        <a href="katalog.php" class="btn btn-secondary col-md-5 mx-auto mt-2"> Katalog</a>
                        <a href="user_lends.php" class="btn btn-secondary col-md-5 mx-auto mt-2"> Aktywność</a>
                    </div>
                </article>
                ';
            } elseif(isset($_SESSION['zalogowany']) && ($_SESSION['uprawnienia']=='P' || $_SESSION['uprawnienia']=='A')){
                echo '';
            }else {
                echo '
                <article>
                    <div class="row p-5">
                        <p class="col=12 text-justify">Tutaj możesz zarezerwować swoje ulubione książki oraz podzielić się opiniami na ich temat.</p>
                        <p class="col=12 text-justify">Nie jesteś zalogowanym użytkownikiem. Aby się zalogować lub stworzyć konto wciśnij odpowiednią opcję w menu lub wybierz opcję poniżej.</p>
                        <a href="register.php" class="btn btn-secondary col-md-5 mx-auto mt-2"> Rejestracja</a>
                        <a href="login_form.php" class="btn btn-secondary col-md-5 mx-auto mt-2"> Logowanie</a>
                    </div>
                </article>
                ';
            }

            ?>

            
        </div>
 
    </section>

</main>

   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap/bootstrap.min.js"></script>


</body>
</html>