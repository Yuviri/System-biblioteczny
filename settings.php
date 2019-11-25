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
    require_once "includes/navi.inc.php";
?>

<main>
    <section class="main_page">

        <div class="container mt-4 bg-light text-body">
            <header>
                <h1>Ustawienia konta</h1>
            </header>
            <article>
                <h1 class="h2">Zmiana hasła</h1>

                <?php
                    if(isset($_SESSION["change-success"])){
                        echo "<div class='alert alert-success col-11 mx-auto mt-4' role='alert'>".
                        $_SESSION["change-success"].
                    "</div>";
                    unset($_SESSION["change-success"]);
                    }
                    if(isset($_SESSION["public-err"])){
                        echo "<div class='alert alert-warning col-11 mx-auto mt-4' role='alert'>".
                        $_SESSION["public-err"].
                        "</div>";
                        unset($_SESSION["public-err"]);
                    }
                    if(isset($_SESSION["dev-err"])){
                        echo "<div class='alert alert-info col-11 mx-auto mt-2' role='alert'>".
                        $_SESSION["dev-err"].
                        "</div>";
                        unset($_SESSION["dev-err"]);
                    }
                ?>

                <form action="change_pass.php" method="post">
                    <div class="row mt-3 text-left">
                        <div class="form-group col-md-6 mx-auto">
                            <label for="old_pass">Stare hasło: </label>
                            <input type="password" class="form-control <?= isset($_SESSION["no-existing"]) ? "is-invalid" : "" ?>" name="old" id="old_pass">
                            <div class="invalid-feedback">
                                <?php  
                                    if(isset($_SESSION['no-existing'])){
                                        echo $_SESSION['no-existing'];
                                        unset($_SESSION['no-existing']);
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="form-group col-md-6 mx-auto">
                            <label for="new_pass1">Nowe hasło: </label>
                            <input type="password" class="form-control <?= isset($_SESSION["no-identical"]) ? "is-invalid" : "" ?>" name="new1" id="new_pass1">
                        </div>
                        <div class="w-100"></div>
                        <div class="form-group col-md-6 mx-auto">
                            <label for="new_pass2">Powtórz nowe hasło: </label>
                            <input type="password" class="form-control <?= isset($_SESSION["no-identical"]) ? "is-invalid" : "" ?>" name="new2" id="new_pass2">
                            <div class="invalid-feedback">
                                <?php  
                                    if(isset($_SESSION['no-identical'])){
                                        echo $_SESSION['no-identical'];
                                        unset($_SESSION['no-identical']);
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <button type="submit" class="btn btn-success mx-auto mb-4">Zmień hasło</button>
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