<?php
    session_start();
    if($_SESSION['uprawnienia']!='pracownik'){
        header('Location: index.php');
    }

    require_once "includes/autoloader.inc.php";

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
    </head>
<body>

<?php
    require_once "includes/navi.inc.php";
?>

<main>
    <section class="main_page">

        <div class="container mt-4 bg-light text-body">
            <header>
                <h1 class="py-3">Istniejąca pozycja</h1>
            </header>
            <article class="lend_form mx-auto">
                <?=isset($_SESSION['a-error']) ? $_SESSION['a-error'] : ""?>
                <?=isset($_SESSION['a-success']) ? $_SESSION['a-success'] : ""?>
                <?php 
                if (isset($_SESSION['a-success'])) unset($_SESSION['a-success']);
                if (isset($_SESSION['a-error'])) unset($_SESSION['a-error']);
                ?>
                <form action="includes/add_books_ex.inc.php" method="post">
                    <div class="row">
                        <div class="form-group col-12 text-left">
                            <label for="isbn_input">ISBN</label>
                            <input list="isbn" name="isbn" id="isbn_input" class="form-control <?=isset($_SESSION['a_isbn_err']) ? 'is-invalid' : ''?>" autocomplete="off" />
                            <datalist id="isbn" >
                                <?php
                                    echo $utility->get_isbns();
                                ?>
                            </datalist>
                            <?php $utility->checkSessionVar('a_isbn_err');?>
                        </div>

                        <div class="form-group col-12 text-left">
                            <label for="quantity">Ilość</label>
                            <input name="quantity" id="quantity" class="form-control <?=isset($_SESSION['a_quantity_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php $utility->checkSessionVar('fill_quantity');?>" />
                            <?php $utility->checkSessionVar('a_quantity_err');?>
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