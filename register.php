<?php

session_start();

if(isset($_POST["email"])){

    $clean = true;

    $email = $_POST["email"];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    $_SESSION['fill-email'] = $email;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL) || ($email!=$emailB)){
        $clean = false;
        $_SESSION["err-email"] = "Niepoprawny adres email";
        unset($_SESSION['fill-email']);
    }

    $password1 = htmlentities($_POST["password1"]);
    $password2 = htmlentities($_POST["password2"]);


    if(strlen($password1)<8 || strlen($password1)>24){
        $clean = false;
        $_SESSION["err-pass"] = "Hasło musi zawierać od 8 do 24 znaków";
    }

    if($password1!=$password2){
        $clean = false;
        $_SESSION["err-pass"] = "Podane hasła muszą być identyczne";
    }

    $password_h = password_hash($password1, PASSWORD_DEFAULT);

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $_SESSION['fill-name'] = $name;
    $_SESSION['fill-surname'] = $surname;


    // $street = $_POST["street"];
    // $postal1 = $_POST["postal1"];
    // $postal2 = $_POST["postal2"];
    // $city = $_POST["city"];

    // if(!ctype_digit($postal1) || !ctype_digit($postal2)){
    //     $clean = false;
    //     $_SESSION["err-postal"] = "Kod pocztowy jest nieprawidłowy";
    // }

    // $adress = $street." ".$postal1."-".$postal2." ".$city;

    $gender = $_POST["gender"];
    $_SESSION['fill-gender'] = $gender;
    // $date = $_POST["date"];
    $phone =  filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $_SESSION['fill-phone'] = $phone;

    require_once "database.php";

    try {
        // Sprawdzanie czy istnieje konto o podanym mailu
        $query = $db->prepare("SELECT email FROM uzytkownik WHERE email=:email");
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();

        if($query->rowCount()>0){
            $clean = false;
            $_SESSION["err-email"] = "Istnieje już konto o podanym adresie e-mail";
        }
        

        if($clean){

            // Przypisanie domyślnego awatara w zależności od płci

            if($gender==="K"){
                $avatar = 'img/avatars/defaultK.png';
            } else {
                $avatar = 'img/avatars/defaultM.png';
            }


            $ins = $db->query("INSERT INTO uzytkownik VALUES('$email', '$password_h', '$name', '$surname', '$gender', '$phone', '$avatar', 'U')");
            
            if($ins){
                $_SESSION["err-success"] = "Rejestracja przebiegła pomyślnie. Możesz zalogować się na swoje konto";
               
                if(isset($_SESSION['fill-email'])) unset($_SESSION['fill-email']);
                if(isset($_SESSION['fill-name'])) unset($_SESSION['fill-name']);
                if(isset($_SESSION['fill-surname'])) unset($_SESSION['fill-surname']);
                if(isset($_SESSION['fill-phone'])) unset($_SESSION['fill-phone']);
                if(isset($_SESSION['fill-gender'])) unset($_SESSION['fill-gender']);

                header("Location: login_form.php");

            } else {
                throw new PDOException();
            }
        }

    } catch (PDOException $e) {
        $_SESSION["err-public"] = "Wystąpiły utrudnienia w działaniu serwisu. Przepraszamy za utrudnienia oraz prosimy spróbować ponownie później";
        $_SESSION["err-dev"] = $e;
    }

}
    
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
            <form method="POST">

                <h1 class="d-block mx-auto text-center">Rejestracja</h1>

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
                ?>
                
                
                <div class="row">       

                    <div class="form-group col-12 mt-4">
                        <label for="email">E-mail:</label>
                        <input type="text" name="email" id="email" value="<?=isset($_SESSION['fill-email']) ? $_SESSION['fill-email'] : ''?>" class="form-control <?php 
                            if(isset($_SESSION["err-email"])) echo "is-invalid";
                        ?>">
                        <div class="invalid-feedback"><?php 
                        if(isset($_SESSION["err-email"])) echo $_SESSION["err-email"]; 
                        unset($_SESSION["err-email"]); 
                        ?></div>
                    </div>
                    <div class="form-group col-12">
                        <label for="password1">Hasło:</label>
                        <input type="password" name="password1" id="password1" class="form-control <?php 
                            if(isset($_SESSION["err-pass"])) echo "is-invalid";
                        ?>">
                        <div class="invalid-feedback"><?php 
                        if(isset($_SESSION["err-pass"])) echo $_SESSION["err-pass"]; 
                        ?></div>
                    </div>
                    <div class="form-group col-12">
                        <label for="password2">Powtórz hasło:</label>
                        <input type="password" name="password2" id="password2" class="form-control <?php 
                            if(isset($_SESSION["err-pass"])) echo "is-invalid";
                            unset($_SESSION["err-pass"]);
                        ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Imię</label>
                        <input type="text" name="name" value="<?=isset($_SESSION['fill-name']) ? $_SESSION['fill-name'] : ''?>" id="name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="surname">Nazwisko</label>
                        <input type="text" name="surname" value="<?=isset($_SESSION['fill-surname']) ? $_SESSION['fill-surname'] : ''?>" id="surname" class="form-control">
                    </div>
                    <!-- <div class="form-group col-12">
                        <label for="street">Ulica</label>
                        <input type="text" name="street" id="street" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="postal1" class="w-100">Kod pocztowy</label>
                        <input type="text" name="postal1" id="postal1" class="form-control col-3  d-inline-block <?php 
                            if(isset($_SESSION["err-postal"])) echo "is-invalid";
                        ?>" maxlength="2">
                        <label for="postal2" class="d-inline-block  font-weight-bold">&mdash;</label>
                        <input type="text" name="postal2" id="postal2" class="form-control col-8 d-inline-block <?php 
                            if(isset($_SESSION["err-postal"])) echo "is-invalid";
                        ?>" maxlength="3">
                        <div class="invalid-feedback"><?php 
                        if(isset($_SESSION["err-postal"])) echo $_SESSION["err-postal"]; 
                        unset($_SESSION["err-postal"]);
                        ?></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">Miasto</label>
                        <input type="text" name="city" id="city" class="form-control">
                    </div> -->
                    <div class="form-group col-md-6">
                        <label for="gender">Płeć</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="M" <?=(isset($_SESSION['fill-gender']) && $_SESSION['fill-gender']=="M") ? 'selected="selected"' : ''?>>Mężczyzna</option>
                            <option value="K" <?=(isset($_SESSION['fill-gender']) && $_SESSION['fill-gender']=="K") ? 'selected="selected"' : ''?>>Kobieta</option>
                        </select>
                    </div>
                    <!-- <div class="form-group col-md-6">
                        <label for="date">Data urodzenia</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div> -->
                    <div class="form-group col-md-6">
                        <label for="phone">Telefon</label>
                        <input type="text" name="phone" value="<?=isset($_SESSION['fill-phone']) ? $_SESSION['fill-phone'] : ''?>" id="phone" class="form-control" maxlength="11">
                    </div>
                    
                    <input type="submit" value="Zarejestruj się" class="btn btn-success mx-auto d-block mt-4">

                    <?php
                        if(isset($_SESSION['fill-email'])) unset($_SESSION['fill-email']);
                        if(isset($_SESSION['fill-name'])) unset($_SESSION['fill-name']);
                        if(isset($_SESSION['fill-surname'])) unset($_SESSION['fill-surname']);
                        if(isset($_SESSION['fill-phone'])) unset($_SESSION['fill-phone']);
                        if(isset($_SESSION['fill-gender'])) unset($_SESSION['fill-gender']);
                    ?>

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