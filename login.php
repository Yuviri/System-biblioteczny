<?php

	session_start();
	
	if ((!isset($_POST['email'])) || (!isset($_POST['password'])))
	{
		header('Location: login-form.php');
		exit();
	}

	require_once "database.php";

	try {

			$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			$password = filter_input(INPUT_POST, 'password');

			$query = $db->prepare("SELECT * FROM czytelnik WHERE email=:email");
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->execute();

			$result = $query->fetch();
			
			if($query->rowCount()>0)
			{			
				if(password_verify($password, $result["haslo"])){
					$_SESSION['zalogowany'] = true;	
					$_SESSION['email'] = $result['email'];
					$_SESSION['imie'] = $result['imie'];
					$_SESSION['nazwisko'] = $result['nazwisko'];

					header('Location: index.php');
				} else{
					$_SESSION['err-login'] = '<div class="invalid-feedback">Nieprawidłowy login lub hasło</div>';
					header('Location: login_form.php');
					}
			} else {
				
				$_SESSION['err-login'] = '<div class="invalid-feedback>Nieprawidłowy login lub hasło</div>"';
				header('Location: login_form.php');

			}
		}	catch (PDOException $e) {
				echo "<span style='color: red;'>Wystąpił błąd, spróbuj ponownie później</span><br>";
				echo "A tak na serio to: ".$e;
			}

	
	
?>