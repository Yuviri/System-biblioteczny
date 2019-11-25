<?php
session_start();
require_once 'includes/autoloader.inc.php';

if(!isset($_GET['isbn'])){
    header('Location: katalog.php');
    exit();
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

            <!-- <div class="row basic_info">
                <div class="cover col-md-4 p-2">
                    <img src="img/covers/example.jpg" alt="Test" class="img-thumbnail">
                    <div class="item_controls mt-3 px-4">
                        <a href="reserve.php?id=2" class="btn btn-primary item_page_res">Zarezerwuj</a>
                    </div>
                </div>

                <div class="b_info col-md-8 position-relative-parent">

                    <h2 class="title text-left mt-2">Zabójczyni</h2>
                    <p class="author text-left">Sarah J. Mass</p>
                    <p class="publisher text-left"> Wydawnictwo: MAG</p>
                    <p class="genre text-left">Gatunek: Fantasy</p>
                    <p class="oryginal_title text-left">Tytuł oryginału: The Assassin's blade</p>
                    
                    <p class="text-left mt-4 font-weight-bold">Opis</p>
                    <p class="description_page text-justify pr-md-4"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin risus magna, porta sit amet est nec, facilisis suscipit nunc. Suspendisse urna leo, dignissim sit amet risus vel, consequat sodales orci. Etiam eget dui dui. Quisque est tellus, vehicula sed iaculis eget, luctus ac eros. Ut pulvinar ipsum vitae tristique dignissim. Vestibulum eleifend orci nulla, vel imperdiet sapien finibus et. Phasellus dignissim at purus facilisis fringilla. Cras vitae ligula eget felis ullamcorper aliquam eget non enim.

                    Aliquam non tellus risus. Vestibulum malesuada elit in lacus convallis blandit. Pellentesque quis rutrum nisi. Proin quis convallis neque. Curabitur sodales efficitur tristique. Proin finibus hendrerit massa, eget efficitur velit bibendum ut. Nulla a ornare felis. Suspendisse sit amet bibendum dui. Nulla faucibus aliquet justo at tincidunt. Nullam posuere pretium ultricies.
                
                    </p>
                </div>
            </div>
            <div class="row comments-section mt-5">
                <h1>Komentarze</h1>
            </div> -->

            <?php
                $bookPage = new BookPageView();
                $bookPage->generateBookPage($isbn, $_SESSION['email']);
            ?>
        </section>
        <!-- <section class="comments">
            <h1>Opinie czytelników</h1>
            <div class="comment row border d-flex align-center p-3">
                   <div class="col-md-2 author text-center align-self-center">
                        <img src="img/avatars/defaultM.png" alt="Avatar" class="mt-2">
                        <span class="d-block mt-1">Quinn Mac</span>
                        <span class="d-block mt-1 add_date">19.10.2019 10:28</span>
                   </div>
                   <div class="col-md-8 comm-content">
                        <p>Wspaniała to była książka, nie zapomnę jej nigdy</p> 
                   </div>
                   <div class="col-md-2 comm-rating text-center">
                        <p>Liczba polubień: <span class="text-success">1</span></p>
                        <a href="#" class="btn btn-success">Polub opinię</a>
                   </div> 
            </div>
            
            <div class="comment row border d-flex align-center p-3">
                <div class="col-12 align-self-center">
                    <p class="comment-info d-inline-block mx-5">Ta książka nie ma jeszcze żadnych opinii. Czy chcesz napisać pierwszą?</p>
                   <a href="#" class="btn btn-primary d-inline-block write-comment px-4">Napisz</a>
                </div>
            </div>
        </section> -->

    </div>
 

</main>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap/bootstrap.min.js"></script>
    <script src="scripts/katalog.js"></script>


</body>
</html>
