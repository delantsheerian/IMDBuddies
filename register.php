<?php

	include_once (__DIR__ . "/db/db.php");
	include_once(__DIR__ . "/classes/User.php");
	
	if (!empty($_POST)){	

		$user = new User();
		$email = $_POST['email'];
		$voornaam = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$wachtwoord = $_POST['wachtwoord'];

		try{
			
			$user = new User();
			
			//wachtwoord beveiligen
			$wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT, ['cost' => 12]); //2 tot de zoveelste keer gehasht
			
			$user->setEmail($_POST['email']);
			$user->setVoornaam($_POST['voornaam']);
			$user->setAchternaam($_POST['achternaam']);
			$user->setPassword($wachtwoord);

			$user->save();
			$succes = "user saved";
		}

		catch (\Throwable $th){
			$error = $th->getMessage();
		}

	}

	$users = User::getAll();
	  
  ?>
    	


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Registreren | Companion</title>
</head>

<body>

	<div id="banner"></div>

	<div id="lid">
        <p>Al reeds een Companion? <a href="login.php">Log je hier in</a></p>
    </div>

	<div id="form">

		<form class="registrerenBuddy" action="" method="post">

			<h2 id="form__title">Registreren bij Companion</h2>
			<div>

			<?php if(isset($error)) : ?>

				<div class="formerror">
					<p><?php echo $error ?></p>
				</div>

				<div class="formsucces">
					<p><?php echo $succes ?></p>
				</div>

				<?php endif; ?>

				<div class="form__field">
					<label for="Email">Email</label>
					<input type="text" class="input" name="email">
				</div>
				<br>

				<div class="form__field">
					<label for="Voornaam">Voornaam</label>
					<input type="text" class="input" name="voornaam">
				</div>
                <br>

                <div class="form__field">
					<label for="Achernaam">Achternaam</label>
					<input type="text" class="input" name="achternaam">
				</div>
                <br>
                
				<div class="form__field">
					<label for="Wachtwoord">Wachtwoord</label>
					<input type="password" class="input" name="wachtwoord">
				</div>
                <br>

				<div class="form__field">
					<input type="submit" value="Creëer account" class="btn-aanmelden">	
				</div>

		</form>
	</div>
</body>
</html>
