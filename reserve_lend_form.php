<?php
    session_start();
    require_once 'includes/autoloader.inc.php';
    
    if(!isset($_SESSION["zalogowany"]) || $_SESSION['uprawnienia']!='pracownik'){
        header("Location: index.php");
    }
    
    $utility = new Utilities();

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


<?php 
    require_once "includes/navi.inc.php" 
?>

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
                        <div class="form-group col-12 text-left">
                            <label for="rezerwacje_input">Rezerwacja</label>
                            <select class="selectpicker form-control border" data-show-subtext="true" name="reservation" id="rezerwacje_input" data-style="btn-white">
                                <?php
                                    echo $utility->get_reservations();
                                ?>
                            </select>
                            <?php $utility->checkSessionVar('l_res_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="od">Data wypożyczenia</label>
                            <input type="date" id="od" name="od" class="form-control" value="<?= $utility->get_today() ?>">
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="do">Przybliżona data zwrotu</label>
                            <input type="date" id="do" name="do" class="form-control" value="<?= $utility->get_estimated() ?>">
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