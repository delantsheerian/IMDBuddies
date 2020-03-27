<?php

        include_once (__DIR__ . "/classes/databank.php");

    class User{
        private $id;
        private $email;
        private $voornaam; 
        private $achternaam; 
        private $wachtwoord;

                
        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {       
                
        if (empty ($email)){
        throw new Exception ("email mag niet leeg zijn");
        }


        // email controleren 
        $emailCheck = strrpos($email, "@student.thomasmore.be");
        if ($emailCheck === false) { 
                throw new Exception ("Vul een geldig email adress in");
        }

      


                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of voornaam
         */ 
        public function getVoornaam()
        {
                return $this->voornaam;
        }

        /**
         * Set the value of voornaam
         *
         * @return  self
         */ 
        public function setVoornaam($voornaam)
        {       if (empty ($voornaam)){
                throw new Exception ("voornaam mag niet leeg zijn");
        }
                $this->voornaam = $voornaam;

                return $this;
        }

        /**
         * Get the value of achternaam
         */ 
        public function getAchternaam()
        {
                return $this->achternaam;
        }

        /**
         * Set the value of achternaam
         *
         * @return  self
         */ 
        public function setAchternaam($achternaam)
        {       if (empty ($achternaam)){
                throw new Exception ("achternaam mag niet leeg zijn");
        }
                $this->achternaam = $achternaam;

                return $this;
        }

        /**
         * Get the value of wachtwoord
         */ 
        public function getWachtwoord()
        {
                return $this->wachtwoord;
        }

        /**
         * Set the value of wachtwoord
         *
         * @return  self
         */ 
        public function setWachtwoord($wachtwoord)
        {       if (empty ($wachtwoord)){
                throw new Exception ("wachtwoord mag niet leeg zijn");
        }
                $this->wachtwoord = $wachtwoord;

                return $this;
        }


        public static function getAll(){
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from users");
                $statement->execute();
                $users = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $users;
        }


        public function save(){
                $conn = Db::getConnection();

                if (isset($_POST['email'])) {
                        $email = $this->getEmail();
                        $conn = Db::getConnection();
                        $sql = "SELECT * FROM users WHERE email='$email'";
                        $results = $conn->query($sql);
                        if ($results->rowCount() > 0) {
                                throw new Exception("Email is already used");
                                echo "taken";
                        }
                
                }

                $statement = $conn->prepare("insert into users (email, voornaam, achternaam, wachtwoord) values (:email, :voornaam, :achternaam, :wachtwoord)");

                $email = $this->getEmail();
                $voornaam = $this->getVoornaam();
                $achternaam = $this->getAchternaam();
                $wachtwoord = $this->getWachtwoord();

                $statement->bindValue(":email", $email);
                $statement->bindValue(":voornaam", $voornaam);
                 $statement->bindValue(":achternaam", $achternaam);
                $statement->bindValue(":wachtwoord", $wachtwoord);

                //dubbele emails checken



                $result = $statement->execute();
                return $result;
        }

       





                







    }
