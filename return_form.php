<?php
    session_start();
    require_once 'includes/autoloader.inc.php';
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
    require_once "includes/navi.inc.php";
?>

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
                <form action="return.php" method="post" class="text-center">
                         
                    <div class="form-group col-12 text-left">
                        <label for="egzemplarz_input">Nr wypożyczenia</label>
                        <input list="wyp" name="wypozyczenie" id="wyp_input" data-show-subtext="true" class="form-control <?=isset($_SESSION['r_wyp_err']) ? 'is-invalid' : ''?>" autocomplete="off" />
                        <datalist id="wyp" >
                            <?php
                                echo $utility->get_books_lended();
                            ?>
                        </datalist>
                        <?php $utility->checkSessionVar('r_wyp_err');?>
                    </div>
                    
                    <div class="form-group col-12 text-left">
                        <label for="od">Data zwrotu</label>
                        <input type="date" id="data_zwrotu" name="data_zwrotu" class="form-control" value="<?= $utility->get_today() ?>" required>
                    </div>

                    <input type="submit" value="Zatwierdź" class="btn btn-primary mx-auto mb-5">

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