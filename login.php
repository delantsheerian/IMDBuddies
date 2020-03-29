<?php

    include_once(__DIR__ . "/db/db.php");
    include_once(__DIR__ . "/classes/user.php");

	if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['wachtwoord'];
    
        $login = new User();
        $login->setEmail($email);
        $login->setPassword($password);
        $login->canLogin();
        if (!$login->canLogin()) {
            $error = "Er liep iets fout.";
        }
    }

?>

<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<title>Meld je aan bij Companion</title>
</head>
<body>
    <?php if(isset($error)): ?>
    <div class="error" style="color: red;"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if(isset($success)): ?>
    <div class="success" style="color: green;"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="" method="post">

        <div>
            <label for="email">Studenten Email</label>
            <input type="text" name="email" id="email">
		</div>
		
		<div>
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" name="wachtwoord" id="wachtwoord">
        </div>
        
        <div>
			<input type="submit" value="Sign me up">
		</div>
        
        </form>
</body>
</html>