<?php

        include_once (__DIR__ . "/Db.php");

    class User{
        private $id;
        private $email;
        private $voornaam; 
        private $achternaam; 
        private $wachtwoord;

        private $kenmerk1; 
        private $kenmerk2; 
        private $kenmerk3;
        private $kenmerk4; 
        private $kenmerk5;

        // getters en setters

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

        //getters en setters kenmerken



        public function getKenmerk1()
        {
                return $this->kenmerk1;
        }

        /**
         * Set the value of kenmerk1
         *
         * @return  self
         */ 
        public function setKenmerk1($kenmerk1)
        {
                $this->kenmerk1 = $kenmerk1;

                return $this;
        }

        /**
         * Get the value of kenmerk2
         */ 
        public function getKenmerk2()
        {
                return $this->kenmerk2;
        }

        /**
         * Set the value of kenmerk2
         *
         * @return  self
         */ 
        public function setKenmerk2($kenmerk2)
        {
                $this->kenmerk2 = $kenmerk2;

                return $this;
        }

        /**
         * Get the value of kenmerk3
         */ 
        public function getKenmerk3()
        {
                return $this->kenmerk3;
        }

        /**
         * Set the value of kenmerk3
         *
         * @return  self
         */ 
        public function setKenmerk3($kenmerk3)
        {
                $this->kenmerk3 = $kenmerk3;

                return $this;
        }

        /**
         * Get the value of kenmerk4
         */ 
        public function getKenmerk4()
        {
                return $this->kenmerk4;
        }

        /**
         * Set the value of kenmerk4
         *
         * @return  self
         */ 
        public function setKenmerk4($kenmerk4)
        {
                $this->kenmerk4 = $kenmerk4;

                return $this;
        }

        /**
         * Get the value of kenmerk5
         */ 
        public function getKenmerk5()
        {
                return $this->kenmerk5;
        }

        /**
         * Set the value of kenmerk5
         *
         * @return  self
         */ 
        public function setKenmerk5($kenmerk5)
        {
                $this->kenmerk5 = $kenmerk5;

                return $this;
        }


        public static function getAll(){
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from users");
                $statement->execute();
                $users = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $users;
        }

        // user opslaan in databank

        public function save(){
                $conn = Db::getConnection();

                //dubbele emails controleren
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


                $result = $statement->execute();
                return $result;
        }

        // kenmerken opslaan in databank

        public function saveKenmerken(){
                $conn = Db::getConnection();


                $statement = $conn->prepare("insert into users (kenmerk1, kenmerk2, kenmerk3, kenmerk4, kenmerk5) values (:kenmerk1, :kenmerk2, :kenmerk3, :kenmerk4, :kenmerk5)");

                $kenmerk1 = $this->getKenmerk1();
                $kenmerk2 = $this->getKenmerk2();
                $kenmerk3 = $this->getKenmerk3();
                $kenmerk4 = $this->getKenmerk4();
                $kenmerk5 = $this->getKenmerk5();

                $statement->bindValue(":kenmerk1", $kenmerk1);
                $statement->bindValue(":kenmerk2", $kenmerk2);
                 $statement->bindValue(":kenmerk3", $kenmerk3);
                $statement->bindValue(":kenmerk4", $kenmerk4);
                $statement->bindValue(":kenmerk5", $kenmerk5);


                $result = $statement->execute();
                return $result;
        }


    }
