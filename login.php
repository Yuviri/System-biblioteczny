<?php

	session_start();
	
	//Sprawdzenie, czy użytkownik poprawnie dostał się do skryptu

	if ((!isset($_POST['email'])) || (!isset($_POST['password'])))
	{
		header('Location: login-form.php');
		exit();
	}

	require_once "database.php";

		try {

			//Pobranie wartości z formularza

			$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			$password = filter_input(INPUT_POST, 'password');

			//Przygotowanie zapytań do bazy

			$query = $db->prepare("SELECT * FROM uzytkownik WHERE email=:email");
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->execute();


			$result = $query->fetch();

			
			//Sprawdzanie istnienia użytkownika

			if($query->rowCount()>0)
			{			
				if(password_verify($password, $result["haslo"])){
					$_SESSION['zalogowany'] = true;	
					$_SESSION['email'] = $result['email'];
					$_SESSION['imie'] = $result['imie'];
					$_SESSION['nazwisko'] = $result['nazwisko'];
					$_SESSION['uprawnienia'] = $result['uprawnienia'];


					header('Location: index.php');
				} else{
					$_SESSION['err-login'] = '<div class="invalid-feedback">Nieprawidłowy login lub hasło</div>';
					header('Location: login_form.php');
				}
			}else {
				
				$_SESSION['err-login'] = '<div class="invalid-feedback">Nieprawidłowy login lub hasło</div>';
				header('Location: login_form.php');
			}
		}catch (PDOException $e) {
			echo "<span style='color: red;'>Wystąpił błąd, spróbuj ponownie później</span><br>";
			echo "Dev description: ".$e;
			}

	
	
?>