<!DOCTYPE html>
<html>
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
                    <li><a href="#">Logowanie</a></li>
                    <li><a href="#">Panel klienta</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="searchbar">
                    <form method="GET" action="search.php">
                        <input type="text" placeholder="Wpisz szukaną frazę" name="query">
                        <input type="submit" value="Szukaj">
                    </form>
                </div>
                <?php
                    require_once "connect.php";

                    $connection = new mysqli($server_name, $username, $password, $db_name);
                    $connection->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
                    $sql1 = "SELECT egzemplarz.id_egzemplarza, szczegoly.nazwa, szczegoly.autor, szczegoly.opis, COUNT(*) as total  FROM egzemplarz, szczegoly WHERE czy_wyp!='1' AND szczegoly.ISBN=egzemplarz.ISBN GROUP BY egzemplarz.ISBN";


                    $result = $connection->query($sql1);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="item"><h2>'.$row["nazwa"].'</h2><h3>'.$row["autor"].'</h3><p>'.$row["opis"].'</p><p>Liczba egzemplarzy: <span style="color: red;">'.$row["total"].'</span></p></div>';
                        }
                    }
                    $connection->close();
                ?>
        </div>
    </main>
    <footer>
        <div class="footer">

        </div>
    </footer>


            







</body>
</html>