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

			$queryU = $db->prepare("SELECT * FROM uzytkownik WHERE email=:email");
			$queryU->bindValue(':email', $email, PDO::PARAM_STR);
			$queryU->execute();

			$queryE = $db->prepare("SELECT * FROM pracownik WHERE email=:email");
			$queryE->bindValue(':email', $email, PDO::PARAM_STR);
			$queryE->execute();

			$resultU = $queryU->fetch();
			$resultE = $queryE->fetch();
			
			if($queryU->rowCount()>0)
			{			
				if(password_verify($password, $resultU["haslo"])){
					$_SESSION['zalogowany'] = true;	
					$_SESSION['email'] = $resultU['email'];
					$_SESSION['imie'] = $resultU['imie'];
					$_SESSION['nazwisko'] = $resultU['nazwisko'];
					$_SESSION['uprawnienia'] = "czytelnik";


					header('Location: index.php');
				} else{
					$_SESSION['err-login'] = '<div class="invalid-feedback">Nieprawidłowy login lub hasło</div>';
					header('Location: login_form.php');
					}
			} elseif($queryE->rowCount()>0) {
				
				if(password_verify($password, $resultE["haslo"])){
					$_SESSION['zalogowany'] = true;	
					$_SESSION['id'] = $resultE['id_pracownika'];
					$_SESSION['email'] = $resultE['email'];
					$_SESSION['imie'] = $resultE['imie'];
					$_SESSION['nazwisko'] = $resultE['nazwisko'];
					$_SESSION['uprawnienia'] = "pracownik";


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