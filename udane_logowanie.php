<!DOCTYPE html>
<html>
    <?php
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 
            if(isset($_SESSION['imie']) && isset($_SESSION['nazwisko'])){
                require_once('connect.php');
            }
            else{
                header('Location: index.php?error=unknown');
                exit();
            }
    ?>	
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css">
        <script src="main.js"></script>
    </head>
<body>


<header>
    <div class="header_up">
        <a href="index.html"><h1>System Biblioteczny</h1></a>
    </div>
    <div class="header_down">
        <nav>
            <ul>
                <li><a href="katalog.php">Katalog książek</a></li>
                <li><a href="#">Wypożyczenia i zwroty</a></li>
                <li><a href="#">Rejestracja</a></li>
                <li><a href="login_form.html">Logowanie</a></li>
                <li><a href="#">Panel klienta</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        <div class="user_control">
            <?php 
                echo "Witaj ".$_SESSION['imie']." ".$_SESSION['nazwisko'];
            ?>
		<br>
            <a class="check_t" href="user_panel.php">Panel użytkownika</a>
            <a class="logout" href="logout.php">Wyloguj się</a>
		</div>
    </div>
</main>
<footer>
    <div class="footer">

    </div>
</footer>

</body>
</html>