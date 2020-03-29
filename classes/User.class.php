<?php

include_once ('Db.class.php');

    class User{

        private $voornaam;
        private $achternaam;
        private $email;
        private $password;
        private $profielfoto;
        private $buddy;

        public function getVoornaam(){
            return $this->voornaam;
        }

        public function setVoornaam($voornaam){
            $this->voornaam = $voornaam;
            return $this;
        }
        
        public function getAchternaam(){
                return $this->achternaam;
        }

        public function setAchternaam($achternaam)
        {
                $this->achternaam = $achternaam;
                return $this;
        }

        public function getEmail(){
                return $this->email;
        }

        public function setEmail($email){
                $this->email = $email;
                return $this;
        }

        public function getPassword(){
                return $this->password;
        }

        public function setPassword($password){
                $this->password = $password;
                return $this;
        }

        public function getProfielfoto(){
                return $this->profielfoto;
        }

        public function setProfielfoto($profielfoto){
                $this->profielfoto = $profielfoto;
                return $this;
        }

        public function getBuddy(){
            return $this->buddy;
        }

        public function setBuddy($buddy){
                $this->buddy = $buddy;
                return $this;
        }

        public function canLogin() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("select wachtwoord from users where email = :email");
            $statement->bindValue(":email", $this->email);
            $statement->execute();
            $dbPassword = $statement->fetchColumn();
            if (password_verify($this->password, $dbPassword)) {
                session_start();
                $_SESSION['email'] = $this->email;
                header('location: index.php');
            }
        }

        public function changeSettings($email, $newEmail, $voornaam, $achternaam, $profielfoto, $buddy, $newpassword){  
            $conn = Db::getConnection();
                
                if($email != $newEmail){
                    $statementCheck = $conn->prepare("select * from users where email = :email");
                    $statementCheck->bindValue(":email", $email);
                    $statementCheck->execute();
                    $userExist = $statementCheck->rowCount();
                }else{
                    $userExist = 0;
                }
        
                if ($userExist == 0) {
                    //username bestaat niet of is niet veranderd, gegevens aanpassen
                    
                    $code ='';
                    if(!empty($newpassword)){
                        $settings = [
                            "cost" => 12
                        ];
                        $newpasswordhash = password_hash($newpassword, PASSWORD_DEFAULT, $settings);
                        $code = ", password = '".$newpasswordhash."'";
                    }
        
                    $conn =  Db::getConnection();
                    $statement = $conn->prepare("UPDATE users SET email=:newEmail, voornaam=:voornaam, achternaam=:achternaam, profielfoto=:profielfoto, buddy=:buddy ".$code." WHERE email = $email");
                    $statement->bindValue(":newEmail", $newEmail);
                    $statement->bindValue(":voornaam", $voornaam);
                    $statement->bindValue(":achternaam", $achternaam);
                    $statement->bindValue(":profielfoto", $profielfoto);
                    $statement->bindValue(":buddy", $buddy);
        
                    if($statement->execute()){
                       return true;
                    }else{
                        //echo "Er is iets foutgelopen bij het updaten.";
                        echo $email . "___" . $newEmail . "___" . $voornaam . "___" . $achternaam . "___" . $profielfoto . "___" . $buddy . "___" . $newpassword; 
                    }
                }else{
                    //username bestaat wel, mag niet veranderd worden
                    return "ERROR: Gelieve een andere username te kiezen";
                }
            }
    }

?>