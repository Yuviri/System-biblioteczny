<?php
    session_start();

    if (!isset($_SESSION['zalogowany']) || $_SESSION['uprawnienia']!='A') {
        header('Location: index.php');
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


<?php
    require_once "includes/navi.inc.php";
    require_once "includes/autoloader.inc.php";

    $util = new Utilities();
?>

<main>
    <section class="main_page">

        <div class="container mt-4 bg-light text-body">
            <header>
                <h1>Panel administratora</h1>
            </header>
            <article>

                <?php 
                    $util->checkSessionvar('reg_a_success');
                    $util->checkSessionvar('reg_a_error');
                ?>

                <div class="fold_box p-3">
                    <div class="box_header text-center th-custom text-light p-3 row no-gutters" id="b_h1">
                        <div class="box_title col-11">Pracownicy</div><div id="w_state1" class="box_state col-1">+</div>
                    </div>
                    <div class="box_content" id="b_c1">
                        <?php
                            $panel = new AdminPanel();
                            $panel->generate_workers();
                        ?>
                    </div>
                </div>

                
                <div class="fold_box p-3">
                    <div class="box_header text-center th-custom text-light p-3 row no-gutters" id="b_h2">
                        <div class="box_title col-11">Dodawanie pracowników</div><div id="w_state2" class="box_state col-1">+</div>
                    </div>
                    <div class="box_content" id="b_c2">
                        <form action="includes/add_worker.inc.php" method="post" class="w_form mt-2">
                            <div class="form-group">
                                <label for="imie">Imię</label>
                                <input type="text" name="imie" id="imie" class="form-control <?= isset($_SESSION['imie_a_err']) ? 'is-invalid': ''?>">
                                <?php if(isset($_SESSION['imie_a_err'])){
                                    echo '<div class="invalid-feedback">';
                                    $util->checkSessionVar('imie_a_err');
                                    echo '</div>';
                                } ?>
                            </div>

                            <div class="form-group">
                                <label for="imie">Nazwisko</label>
                                <input type="text" name="nazwisko" id="nazwisko" class="form-control <?= isset($_SESSION['nazwisko_a_err']) ? 'is-invalid': ''?>">
                                <?php if(isset($_SESSION['nazwisko_a_err'])){
                                    echo '<div class="invalid-feedback">';
                                    $util->checkSessionVar('nazwisko_a_err');
                                    echo '</div>';
                                } ?>
                            </div>

                            <div class="form-group">
                                <label for="imie">E-mail</label>
                                <input type="text" name="email" id="email" class="form-control <?= isset($_SESSION['email_a_err']) ? 'is-invalid': ''?>">
                                <?php if(isset($_SESSION['email_a_err'])){
                                    echo '<div class="invalid-feedback">';
                                    $util->checkSessionVar('email_a_err');
                                    echo '</div>';
                                } ?>
                            </div>

                            <div class="form-group">
                                <label for="imie">Hasło</label>
                                <input type="password" name="haslo1" id="haslo1" class="form-control <?= isset($_SESSION['haslo2_a_err']) ? 'is-invalid': ''?>">
                            </div>

                            <div class="form-group">
                                <label for="imie">Powtórz hasło</label>
                                <input type="password" name="haslo2" id="haslo2" class="form-control <?= isset($_SESSION['haslo2_a_err']) ? 'is-invalid': ''?>">
                                <?php if(isset($_SESSION['haslo2_a_err'])){
                                    echo '<div class="invalid-feedback">';
                                    $util->checkSessionVar('haslo2_a_err');
                                    echo '</div>';
                                } ?>
                            </div>

                            <div class="form-group">
                                <label for="plec">Płeć</label>
                                <select name="plec" id="plec" class="form-control">
                                    <option value="M">Mężczyzna</option>
                                    <option value="K">Kobieta</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="telefon">Telefon</label>
                                <input type="text" name="telefon" id="telefon" class="form-control <?= isset($_SESSION['telefon_a_err']) ? 'is-invalid': ''?>">
                                <?php if(isset($_SESSION['telefon_a_err'])){
                                    echo '<div class="invalid-feedback">';
                                    $util->checkSessionVar('telefon_a_err');
                                    echo '</div>';
                                } ?>
                            </div>

                            <input type="submit" value="Dodaj" class="btn btn-success mx-auto d-block">
                        </form>
                    </div>
                </div>

            </article>
        </div>
 
    </section>  

</main>

   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap/bootstrap.min.js"></script>
    <script>
        // rozwijane menu
        $(document).ready(function(){
            $('#b_h1').click(function(){
                $('#b_c1').slideToggle(500, function(){
                    if($('#w_state1').html()=='+'){
                        $('#w_state1').html('-');
                    } else if($('#w_state1').html()=='-'){
                        $('#w_state1').html('+');
                    }
                });
            });

            $('#b_h2').click(function(){
                $('#b_c2').slideToggle(500, function(){
                    if($('#w_state2').html()=='+'){
                        $('#w_state2').html('-');
                    } else if($('#w_state2').html()=='-'){
                        $('#w_state2').html('+');
                    }
                });
            });
        });
    </script>


</body>
</html>