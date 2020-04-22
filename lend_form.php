<?php
    session_start();

    if ($_SESSION['uprawnienia']!='P') {
        header('Location: index.php');
        exit();
    } else{
        require_once 'includes/autoloader.inc.php';
        $utility = new Utilities();
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
    require_once "includes/navi.inc.php" 
?>

<main>
    <section class="main_page">

        <div class="container mt-4 bg-light text-body">
            <header>
                <h1 class="py-3">Wypożyczenia</h1>
            </header>
            <article class="lend_form mx-auto">
                <?=isset($_SESSION['public-err']) ? $_SESSION['public-err'] : ""?>
                <?=isset($_SESSION['dev-err']) ? $_SESSION['dev-err'] : ""?>
                <?=isset($_SESSION['success']) ? $_SESSION['success'] : ""?>
                <?=isset($_SESSION['existing-err']) ? $_SESSION['existing-err'] : ""?>
                <?php 
                if (isset($_SESSION['public-err'])) unset($_SESSION['public-err']);
                if (isset($_SESSION['dev-err'])) unset($_SESSION['dev-err']);
                if (isset($_SESSION['success'])) unset($_SESSION['success']);
                if (isset($_SESSION['existing-err'])) unset($_SESSION['existing-err']);
                ?>
                <form action="lend.php" method="post">
                    <div class="row">
                        <div class="form-group col-12 text-left">
                            <label for="czytelnik_input">Czytelnik</label>
                            <input list="czytelnik" name="czytelnik" id="czytelnik_input" class="form-control <?=isset($_SESSION['l_email_err']) ? 'is-invalid' : ''?>" autocomplete="off" />
                            <datalist id="czytelnik" >
                                <?php
                                   echo $utility->get_users();
                                ?>
                            </datalist>
                            <?php $utility->checkSessionVar('l_email_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="egzemplarz_input">Nr egzemplarza</label>
                            <input list="egzemplarz" name="egzemplarz" id="egzemplarz_input" class="form-control <?=isset($_SESSION['l_egz_err']) ? 'is-invalid' : ''?>" autocomplete="off" />
                            <datalist id="egzemplarz" >
                                <?php
                                    echo $utility->get_books();
                                ?>
                            </datalist>
                            <?php $utility->checkSessionVar('l_egz_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="od">Data wypożyczenia</label>
                            <input type="date" id="od" name="od" class="form-control" value="<?= $utility->get_today() ?>" required>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="do">Przybliżona data zwrotu</label>
                            <input type="date" id="do" name="do" class="form-control" value="<?= $utility->get_estimated() ?>" required>
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