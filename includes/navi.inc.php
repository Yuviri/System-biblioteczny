<?php

// Skrypt wypisuje menu nawigacyjne, wydzielone do osobnego pliku ze względu na ilość linii kodu

echo 

'

<header>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a href="index.php" class="navbar-brand d-inline-block">System Biblioteczny</a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainmenu">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="katalog.php" class="nav-link">Katalog książek</a>
            </li>

';
        
        // Sprawdzenie czy zalogowany użytkownik to pracownik oraz dodanie odpowiednich opcji jeśli tak jest

        if(isset($_SESSION["zalogowany"]) && $_SESSION["uprawnienia"]=="pracownik"){
            echo '
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="submenu">Wypożyczenia i zwroty</a>
                
                <div class="dropdown-menu" aria-labelledby="submenu">
                    <a href="lend_form.php" class="dropdown-item">Wypożyczenia</a>
                    <div class="dropdown-divider"></div>
                    <a href="return_form.php" class="dropdown-item">Zwroty</a>
                    <div class="dropdown-divider"></div>
                    <a href="reserve_lend_form.php" class="dropdown-item">Obsługa rezerwacji</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="submenu">Dodaj książki</a>
                
                <div class="dropdown-menu" aria-labelledby="submenu">
                    <a href="add_books_form.php" class="dropdown-item">Nowa pozycja</a>
                    <div class="dropdown-divider"></div>
                    <a href="add_books_ex_form.php" class="dropdown-item">Istniejąca pozycja</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="submenu">Statystyki i raporty</a>
                
                <div class="dropdown-menu" aria-labelledby="submenu">
                    <a href="stats.php" class="dropdown-item">Statystyki</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Raporty</a>
                </div>
            </li>';
        }
            
        //Jeśli użytkownik jest zalogowany znika opcja rejestracji
            
        if (!isset($_SESSION["zalogowany"])) {
            echo '<li class="nav-item">
                    <a href="register.php" class="nav-link">Rejestracja</a>
                </li>';
        }  
           

        // Opcje dotyczące konta dla zalogowanych

        if(isset($_SESSION["zalogowany"])){
            echo '
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggl" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="submenu">'.
                $_SESSION["imie"].' '.$_SESSION["nazwisko"].'</a>
                
                <div class="dropdown-menu" aria-labelledby="submenu">
                    <a href="user_lends.php" class="dropdown-item">Moje wypożyczenia</a>
                    <a href="settings.php" class="dropdown-item">Ustawiena konta</a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item">Wyloguj się </a>
                </div>
            </li>';
        }else {
            echo '
                <li class="nav-item">
                    <a href="login_form.php" class="nav-link">Logowanie</a>
                </li>
            ';
        }

echo '

        </ul>

    </div>
</nav>

</header>

';