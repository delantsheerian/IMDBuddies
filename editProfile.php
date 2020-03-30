<?php
    
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/User.php");

    // NOG TIMESTAMP TOEVOEGEN!!

    if(!empty($_POST)){

        $u = new User();
        // $u->Password= $_POST['oldPassword'];
        $email = "r0701531@student.thomasmore.be";
        $newEmail = $_POST['email'];
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $buddy = $_POST['buddy'];

        $profielfoto = "";
        $destFile = "";

        $fotonaam = $_FILES['profielfoto']['tmp_name'];
        if (!empty($fotonaam)) {$foto = file_get_contents($fotonaam);}

        $temp = explode(".", $_FILES['profielfoto']['name']);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $foto = $newfilename;

        $profielfoto = $foto;

        $newpassword = "";
        if(!empty($_POST['newPassword'])) {
            $newpassword = $_POST['newPassword'];
        }

        define ('SITE_ROOT', realpath(dirname(__FILE__)));

        $result = $u->changeSettings($email, $newEmail, $voornaam, $achternaam, $profielfoto, $buddy, $newpassword);
        if($result === true){

            if ($fotonaam != NULL){
                $destFile = __DIR__ . '/images/uploads/avatar/' . $profielfoto;
                move_uploaded_file($_FILES['profielfoto']['tmp_name'], $destFile);
                chmod($destFile, 0666);
            }

            // session_destroy();
            header('location: editProfile.php');
        }else{
            echo $result;
        }
    }

    $conn =  Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM users WHERE id = 1");
    $statement->execute();
    if( $statement->rowCount() > 0){
        $user = $statement->fetch(); // array van resultaten opvragen
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profiel aanpassen • Companion</title>
</head>
<body>
<section class="content">
<h1> Edit account:</h1>

<div style="margin:20px 10px 10px 10px; padding:25px;border-radius:7px;background-color:rgba(93,180,205,0.25);box-shadow: 0 2px 3px rgba(0,0,0,.16);color:#0781ad;border:solid 1px #0781ad;opacity:0.66;">
    Warning: For security reasons, editing your account details will require you to log in again. 
</div>

    <section class="login-form-wrap3">
        <form class="password-form" method="POST" action="" enctype="multipart/form-data" id="upload-form">
            <label>Email :
                <input class="textbox" type="text" name="email" value=<?php echo $user['email'] ?> >
            </label><br />
            <label>Voornaam :
                <input class="textbox" type="text" name="voornaam" value=<?php echo $user['voornaam'] ?> >
            </label><br />
            <label>Achternaam :
                <input class="textbox" type="text" name="achternaam" value=<?php echo $user['achternaam'] ?> >
            </label><br />
            <label for="profielfoto">Profielfoto</label>
            <br>
            <div id="prev-div">
                    <img id="img-prev" src="images/uploads/avatar/<?php echo $user['profielfoto'] ?>" alt="uploaded image" />
                <br>
            </div>
            <input type="file" name="profielfoto" id="profielfoto" accept="image/gif, image/jpeg, image/png, image/jpg" onchange="readURL(this);"><br />
            <img id="imgPreview" src="images/uploads/avatar/<?php echo $user['profielfoto'] ?>" alt="" style="height: 200px;" />
            <br>
            <select id="buddy" name="buddy">
                <option value="<?php echo $user['buddy'] ?>">Geen verandering</option>
                <option value="1">Buddy</option>
                <option value="0">Begeleider</option>
            </select>
            <br>
            <label>New password:</label> 
            <br>
            <input class="textbox" type="password" name="newPassword" placeholder="">
            <br>
            <br>
            <input class="buttonReset" type="submit" value="Submit">
        </form>
    </section>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#prev-div').hide();
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prev-div').show();
                $('#img-prev').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


</body>

</html>