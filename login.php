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

        else {
            header('Location: index.php');
        }
    }

?>

<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Aanmelden | Companion</title>
</head>
<body>
    
    <?php if(isset($error)): ?>
        <!--<div class="error" style="color: red;"><?php echo $error; ?></div>-->
        <?php endif; ?>

        <?php if(isset($success)): ?>
        <!--<div class="success" style="color: green;"><?php echo $success; ?></div>-->
    <?php endif; ?>

    <div id="banner"></div>

    <div id="geen_lid">
        <p>Nog geen Companion? <a href="register.php">Registreer hier</a></p>
    </div>
    
    <div id="form">

        <form class="aanmeldenBuddy" action="" method="post">

            <div id="form_title"><h2>Meld je aan bij Companion</h2>

            <div>
                <label for="email">Studenten Email</label>
                <input class="input" type="text" name="email" id="email" required>
            </div>
            
            <div id="password_field">
                <label for="wachtwoord">Wachtwoord</label>
                <input class="input" type="password" name="wachtwoord" id="wachtwoord" required>
            </div>
            
            <div>
                <input class="btn-aanmelden" type="submit" value="Aanmelden">
            </div>
            
            </form>
    </div>
</body>
</html>