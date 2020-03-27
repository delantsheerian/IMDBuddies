<?php
include_once(__DIR__ . "/User.php");

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






?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

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
<label for="tijd">Wat doe je graag in je vrije tijd? </label>
<br>
<label for="sporten">
    <input type="checkbox" id="Kenmerk5" name="kenmerk5">
    Sporten
</label><br/>
<label for="Gamen">
    <input type="checkbox" id="Kenmerk5" name="kenmerk5">
    Gamen
</label><br/>
<label for="Creatief">
    <input type="checkbox" id="Kenmerk5" name="kenmerk5">
    Creatief bezig zijn 
</label><br/>
<label for="Feesten">
    <input type="checkbox" id="Kenmerk5" name="kenmerk5">
    Feesten
</label><br/>
<label for="instrument">
    <input type="checkbox" id="Kenmerk5" name="kenmerk5">
    Een instrument beoefenen
</label><br/>
<label for="andere">
    <input type="checkbox" id="Kenmerk5" name="kenmerk5">
    Geen van bovenstaande
</label><br/>

<br>
<br>
<label for="muziek">Wat is je favoriete muziekstijl?</label>
<br>
<label for="pop">
    <input type="checkbox" id="Kenmerk4" name="kenmerk4">
    Pop-muziek
</label><br/>
<label for="techno">
    <input type="checkbox" id="Kenmerk4" name="kenmerk4">
    Techno
</label><br/>
<label for="metal">
    <input type="checkbox" id="Kenmerk4" name="kenmerk4">
    Metal
</label><br/>
<label for="dubstep">
    <input type="checkbox" id="Kenmerk4" name="kenmerk4">
    Dupstep
</label><br/>
<label for="drumandbass">
    <input type="checkbox"id="Kenmerk4" name="kenmerk4">
    Drum and bass
</label><br/>
<label for="andere">
    <input type="checkbox" id="Kenmerk4" name="kenmerk4">
    Nog iets anders
</label><br/>

<br>
<br>

<div class="form__field">
					<input type="submit" value="Aanmelden" class="btn-aanmelden">	
					
				</div>



</body>
</html>