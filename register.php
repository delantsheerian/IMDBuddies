
<?php

	/*include_once (__DIR__ . "/db/db.php");*/
	include_once(__DIR__ . "/classes/user.php");
	
	
	if (!empty($_POST)){	

		$user = new User();
		$email = $_POST['email'];
		$voornaam = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$wachtwoord = $_POST['wachtwoord'];

	}

	if(!empty($_POST)){
		

		try{
			
			$user = new User();
			
					//wachtwoord beveiligen
			$wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT, ['cost' => 12]); //2 tot de zoveelste keer gehasht
			
			
			$user->setEmail($_POST['email']);
			$user->setVoornaam($_POST['voornaam']);
			$user->setAchternaam($_POST['achternaam']);
			$user->setPassword($wachtwoord);


		
			$user->save();
			$succes="user saved";
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
<link rel="stylesheet" type="text/css" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Aanmelden bij Companion</title>
</head>

<body>
	<div class="aanmeldenBuddy">
		<div class="form aanmeldenBuddy">
			<form action="" method="post">

				<h2 form__title>Registreren</h2>
				<div>

				<?php if(isset($error)) : ?>

				<div class="formerror">
					<p><?php echo $error ?></p>
				</div>

				<?php endif; ?>

				<div class="form__field">
					<label for="Email">Email</label>
					<input type="text" id="Email" name="email">
				</div>
				<br>

				<div class="form__field">
					<label for="Voornaam">Voornaam</label>
					<input type="text" id="Voornaam" name="voornaam">
				</div>
                <br>

                <div class="form__field">
					<label for="Achernaam">Achternaam</label>
					<input type="text" id="Achternaam" name="achternaam">
				</div>
                <br>
                
				<div class="form__field">
					<label for="Wachtwoord">Wachtwoord</label>
					<input type="password" id="Wachtwoord" name="wachtwoord">
				</div>
                <br>

				<div class="form__field">
					<input type="submit" value="Aanmelden" class="btn-aanmelden">	
				</div>

			</form>
		</div>
	</div>
</body>
</html>
