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
    <section>
        <div class="container register_control mt-1 mx-auto bg-light text-body p-4">
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
                    if(isset($_GET["redirect"])){
                        echo "<div class='alert alert-info col-11 mx-auto mt-2' role='alert'>Rezerwacji może dokonać tylko zalogowany użytkownik. Zaloguj się korzystając z formularza poniżej lub załóż konto.</div>";
                    }
                    if(isset($_SESSION["err-success"])){
                        echo "<div class='alert alert-success col-11 mx-auto mt-4' role='alert'>".
                        $_SESSION["err-success"].
                    "</div>";
                    unset($_SESSION["err-success"]);
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

   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap/bootstrap.min.js"></script>

</body>
</html>