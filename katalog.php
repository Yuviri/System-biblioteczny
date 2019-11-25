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

        <div class="container mt-2 bg-light text-body">

            <main>

                <div class="row">
                
                    <div class="filters_pane col-12 p-2">

                        <form action="search.php" method="post" class="form-inline float-left">
                            <select name="asc_desc" id="asc_desc" class="form-control mx-2">
                                <option value="asc" <?= isset($_GET['asc_desc']) && $_GET['asc_desc'] == "asc" ? "selected": ""?> >Rosnąco</option>
                                <option value="desc" <?= isset($_GET['asc_desc']) && $_GET['asc_desc'] == "desc" ? "selected": ""?> >Malejąco</option>
                            </select>
                            <select name="alpha_num" id="alpha_num" class="form-control mx-2">
                                <option value="szczegoly.nazwa" <?= isset($_GET['alpha_num']) && $_GET['alpha_num'] == "szczegoly.nazwa" ? "selected": ""?> >Alfabetycznie</option>
                                <option value="total" <?= isset($_GET['alpha_num']) && $_GET['alpha_num'] == "total" ? "selected": ""?> >Wg sztuk</option>
                            </select>
                            <input type="text" name="search_input" id="search_input" class="form-control" placeholder="wpisz szukaną frazę" onkeyup="searchq();" autocomplete="off">
                        </form>

                    </div>
                </div>
                <div class="results_wrapper" id="r_w">

                <?php
                    require_once "database.php";

                        if(isset($_SESSION['reserve-feedback'])){
                            echo $_SESSION['reserve-feedback'];
                            unset($_SESSION['reserve-feedback']);
                        }
                    
                        $query = $db->query("SELECT egzemplarz.id_egzemplarza, szczegoly.isbn, szczegoly.nazwa, szczegoly.autor, szczegoly.opis, szczegoly.cover, COUNT(*) as total  FROM egzemplarz, szczegoly WHERE czy_wyp!='1' AND szczegoly.ISBN=egzemplarz.ISBN GROUP BY egzemplarz.ISBN ORDER BY szczegoly.nazwa ASC");
                        $result = $query->fetchAll();
                      
                        foreach ($result as $row => $value) {
                            echo '    
                                <div class="book_tab row border">
                                    <div class="cover col-2 p-2">
                                        <img src="'.$value["cover"].'" alt="Okładka">
                                    </div>
                                    <div class="book_info col-8">
                                        <h2 class="h3 text-left mt-4">'.$value["nazwa"].'</h2>
                                        <h3 class="h4 text-left mt-2">'.$value["autor"].'</h3>
                                        <p class="description text-justify mt-4">'.substr($value["opis"],0,360)."...".'</p>
                                    </div>
                                    <div class="book_tab_controls col-2 text-center d-flexbox align-self-center">
                                        <a href="reserve.php?id='.$value['id_egzemplarza'].'" class="btn btn-primary mt-5">Zarezerwuj</a>
                                        <a href="book_item.php?isbn='.$value['isbn'].'" class="btn btn-primary mt-1">Zobacz więcej</a>
                                        <p class="books_counter mt-3">W bibliotece: <span class="font-weight-bold">'.$value["total"].'</span></p>
                                    </div>
                                </div>
                                ';
                            }
                            ?>
                </div>
            </main>
        </div>
 
    </section>

</main>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="bootstrap/bootstrap.min.js"></script>
    <script src="scripts/katalog.js"></script>


</body>
</html>