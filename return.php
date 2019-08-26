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
        <h1>Zwrot</h1>
    </div>
        <div class="whole">
            <div id = "half1">

                <form action="return2.php" method="post" class="formularz">

                        <table class="tab">

                            <tr>
                                <th>Numer wypożyczenia</th> <td> <input type="text" name="id_wyp"></td>
                            </tr>
                            <tr>
                                <th>Numer egzemplarza</th> <td> <input type="text" name="egzemplarz"></td>
                            </tr>
                            <tr>
                                <th>Data zwrotu</th> <td> <input type="date" name="do"></td>
                            </tr>
                            <tr>
                                <th></th><td><input type ="submit" value="Zwróć"></td>
                            </tr>
                            

                        </table>

                    </form>
                </div>
                <div id = "half2">
                    <?php 
                    require_once "booksr.php";
                    echo $tabela_html2;
                    ?>
             </div>
        </div>  
        <a href="lend_form.php" class="zwrot">Wypożyczenie</a>
        <div class="space"></div>
    </div>



</body>
</html>