<?php
session_start();
require_once 'includes/autoloader.inc.php';

if(!isset($_GET['isbn'])){
    header('Location: katalog.php');
    exit();
}

if (!isset($_SESSION['email'])) {
    $email = false;
} else {
    $email = $_SESSION['email'];
}

$isbn = $_GET['isbn'];
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

    <div class="container mt-2 bg-light text-body book_page_con">

        <section class="main_page">

            <?php
                $bookPage = new BookPageView();
                $bookPage->generateBookPage($isbn, $email);
            ?>
        </section>
        
    </div>
 

</main>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap/bootstrap.min.js"></script>
    <script src="scripts/katalog.js"></script>
    <script src="scripts/comments.js"></script>


</body>
</html>
