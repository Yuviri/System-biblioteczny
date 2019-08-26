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



    <div class="container">

    <div class="baner">
        <h1>Wypożyczenie</h1>
    </div>
        <div class="whole">
            <div id = "half1">
                    <form action="lend.php" method="post" class="formularz">

                        <table class="tab">

                            <tr>
                                <th>Czytelnik</th> <td> <input type="text" name="czytelnik"></td>
                            </tr>
                            <tr>
                                <th>Egzemplarz</th> <td> <input type="text" name="egzemplarz"></td>
                            </tr>
                            <tr>
                                <th>Pracownik</th> <td> <input type="text" name="pracownik"></td>
                            </tr>
                            <tr>
                                <th>Data Wypożyczenia</th> <td> <input type="date" name="od"></td>
                            </tr>
                            <tr>
                                <th></th><td><input type ="submit" value="Dodaj"></td>
                            </tr>
                            

                        </table>

                    </form>
                </div>
                <div id = "half2">
                    <?php 
                    require_once "booksl.php";
                    echo $tabela_html;
                    ?>
             </div>
        </div>  
        <a href="return.php" class="zwrot">Zwrot</a>
        <div class="space"></div>
    </div>





</body>
</html>