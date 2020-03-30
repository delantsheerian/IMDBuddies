<?php


include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/db/db.php");


    if (!empty($_POST)){

        $user = new User();
        $kenmerk1 = $_POST['kenmerk1'];
        $kenmerk2 = $_POST['kenmerk2'];
        $kenmerk3 = $_POST['kenmerk3'];
        $kenmerk4 = $_POST['kenmerk4'];
        $kenmerk5 = $_POST['kenmerk5'];
    
    }


    if(!empty($_POST)){

        try{
            $user = new User();
            
            $user->setKenmerk1($_POST['kenmerk1']);
            $user->setKenmerk2($_POST['kenmerk2']);
            $user->setKenmerk3($_POST['kenmerk3']);
            $user->setKenmerk4($_POST['kenmerk4']);
            $user->setKenmerk5($_POST['kenmerk5']);

            $user->saveKenmerken();
        }


	catch (\Throwable $th){
		$error = $th->getMessage();



	}
}

    


?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<div class="aanmakenKenmerken">
		<div class="form kenmerken">
			<form action="" method="post">
				<h2 form__title>Kies uw kenmerken</h2>


                    <div class="form__field">
					<label for="Woonplaats">In welke stad woon je</label>
					<input type="text" id="Kenmerk1" name="kenmerk1">
				    </div>

                    <label for="keuzeVak">Design of development? </label>
                    <select id="Kenmerk2" name="kenmerk2">
                    <option value="design">Design</option>
                    <option value="development">Development</option>
                    </select>

                    <br>

                    <label for="jaar">In welk jaar zit je? </label>
                    <select id="Kenmerk3" name="kenmerk3">
                    <option value="eersteJaar">1IMD</option>
                    <option value="tweedeJaar">2IMD</option>
                    <option value="derdeJaar">3IMD</option>
                    </select>

                    <br>
                    <br>
                    
                    <label for="jaar">Wat doe je graag in je vrije tijd? </label>
                    <select id="Kenmerk4" name="kenmerk4">
                    <option value="sporten">Sporten</option>
                    <option value="Gamen">Gamen</option>
                    <option value="Creatief">Ceatief bezig zijn</option>
                    <option value="Feesten">Feesten</option>
                    <option value="Instrument">Instrument bespelen</option>
                    <option value="Andere">Andere</option>
                    </select>

                    <label for="muziek">Welke muziek luister je graag? </label>
                    <select id="Kenmerk5" name="kenmerk5">
                    <option value="pop">Pop</option>
                    <option value="jazz">Jazz</option>
                    <option value="hiphop">Hiphop/rap</option>
                    <option value="Techno">Techno</option>
                    <option value="Drumandbass">Drum and Bass</option>
                    <option value="Andere">Andere</option>
                    </select>
                    

                    <br>
                    <br>

  
            </div>
        </div>
    </div>


<div class="form__field">
					<input type="submit" value="Aanmelden" class="btn-aanmelden">	
					
				</div>



</body>
</html>