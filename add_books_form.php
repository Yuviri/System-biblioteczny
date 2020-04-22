<?php
    session_start();
    if($_SESSION['uprawnienia']!='P'){
        header('Location: index.php');
    }

    require_once "includes/autoloader.inc.php";

    $utility = new Utilities();
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
                <h1 class="py-3">Nowa pozycja</h1>
            </header>
            <article class="lend_form mx-auto">
                <?=isset($_SESSION['a-error']) ? $_SESSION['a-error'] : ""?>
                <?=isset($_SESSION['a-success']) ? $_SESSION['a-success'] : ""?>
                <?php 
                if (isset($_SESSION['a-success'])) unset($_SESSION['a-success']);
                if (isset($_SESSION['a-error'])) unset($_SESSION['a-error']);
                ?>
                <form action="includes/add_books.inc.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-12 text-left">
                            <label for="isbn">ISBN</label>
                            <input name="isbn" id="isbn" class="form-control <?=isset($_SESSION['a_isbn_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php $utility->checkSessionVar('fill_isbn');?>" required/>
                            <?php $utility->checkSessionVar('a_isbn_err');?>
                        </div>

                        <div class="form-group col-12 text-left">
                            <label for="title">Tytuł</label>
                            <input name="title" id="title" class="form-control <?=isset($_SESSION['a_title_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php $utility->checkSessionVar('fill_title');?>" required/>
                            <?php $utility->checkSessionVar('a_title_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="author">Autor</label>
                            <input name="author" id="author" class="form-control <?=isset($_SESSION['a_author_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php $utility->checkSessionVar('fill_author');?>" required/>
                            <?php $utility->checkSessionVar('a_author_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="o_title">Tytuł oryginału</label>
                            <input name="o_title" id="o_title" class="form-control <?=isset($_SESSION['a_o_title_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php $utility->checkSessionVar('fill_o_title');?>" required/>
                            <?php $utility->checkSessionVar('a_o_title_err');?>
                        </div>
                        
                        <div class="form-group col-12 text-left">
                            <label for="genre">Gatunek</label>
                            <input name="genre" id="genre" class="form-control <?=isset($_SESSION['l_genre_err']) ? 'is-invalid' : ''?>" autocomplete="off" value="<?php $utility->checkSessionVar('fill_genre');?>" required/>
                            <?php $utility->checkSessionVar('l_genre_err');?>
                        </div>

                        <div class="form-group col-12 text-left">
                            <label for="publisher">Wydawnictwo</label>
                            <input list="publisher" name="publisher" class="form-control <?=isset($_SESSION['l_publisher_err']) ? 'is-invalid' : ''?>" autocomplete="off" required/>
                            <datalist id="publisher">
                                <?php echo $utility->get_publishers(); ?>
                            </datalist>
                            <?php $utility->checkSessionVar('l_publisher_err');?>
                        </div>

                        <div class="form-group col-12 text-left">
                            <label for="cover">Okładka</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?=isset($_SESSION['a_cover_err']) ? 'is-invalid' : ''?>" id="cover" lang="pl-Pl" name="cover" required>
                                <label class="custom-file-label" for="cover" data-browse="Przeglądaj">Wybierz pliki</label>
                            </div>
                            <?php $utility->checkSessionVar('a_cover_err');?>
                        </div>

                        <div class="form-group col-12 text-left">
                            <label for="description">Opis</label>
                            <textarea class="form-control <?=isset($_SESSION['l_description_err']) ? 'is-invalid' : ''?>" id="description" name="description" rows="7" required><?php $utility->checkSessionVar('fill_description');?></textarea>
                            <?php $utility->checkSessionVar('l_description_err');?>
                        </div>

                        <input type="submit" value="Zatwierdź" class="btn btn-primary mx-auto mb-5">

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
    <script>
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
  </script>


</body>
</html>