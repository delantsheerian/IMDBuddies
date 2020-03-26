<?php

        include_once (__DIR__ . "/classes/databank.php");

    class User{
        private $id;
        private $email;
        private $name; 
        private $lastname; 
        private $password;

                /**
                 * Get the value of name
                 */ 
                public function getName()
                {
                        return $this->name;
                }
        
                /**
                 * Set the value of name
                 *
                 * @return  self
                 */ 
                public function setName($name)
                {
                    
                        $this->name = $name;
        
                        return $this;
                }
        
                /**
                 * Get the value of lastname
                 */ 
                public function getLastname()
                {
                        return $this->lastname;
                }
        
                /**
                 * Set the value of lastname
                 *
                 * @return  self
                 */ 
                public function setLastname($lastname)
                {
                        $this->lastname = $lastname;
        
                        return $this;
                }
        
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
                        $this->email = $email;
        
                        return $this;
                }
               
        
        
        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }


        public function save(){
                $conn = Db::getConnection();

                $statement = $conn->prepare("insert into users (email, name, lastname, password) values (:email, :name, :lastname, :password)");

                $email = $this->getEmail();
                $name = $this->getName();
                $lastname = $this->getLastname();
                $password = $this->getPassword();

                $statement->bindValue(":email", $email);
                $statement->bindValue(":name", $name);
                 $statement->bindValue(":lastname", $lastname);
                $statement->bindValue(":password", $password);

                $result = $statement->execute();
                return $result;
        }

        public static function getAll(){
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from users");
                $statement->execute();
                $users = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $users;
        }


    }
        