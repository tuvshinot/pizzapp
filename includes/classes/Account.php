<?php
    class Account {
        private $con;
        private $errorArray;
        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }
        public function login($em, $pw) {
            // encrypt pass first
            $pw = md5($pw);
            $query = mysqli_query($this->con, "SELECT * FROM users WHERE email='$em' AND password='$pw'");
            if(mysqli_num_rows($query)==1) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }
        public function register($em, $address, $phone, $pw, $pw2) {
            //validation
            $this->validateEmail($em);
            $this->validatePasswords($pw, $pw2);
            if(empty($this->errorArray)) {
                // insert into db
                return $this->insertUserDetails($em, $address, $phone, $pw);
            } else {
                return false;
            }
        }
        // display error to UI
        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error="";
            }
            return "<span class='errorMessage'>$error</span>";
        }
        private function insertUserDetails($em, $address, $phone, $pw) {
            $encryptedPw = md5($pw); //password -> long string
            $date = date("Y-m-d");
            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$em', '$address', '$phone', '$encryptedPw')");
            // mysqli returns true or false that`s why below
            return $result;
        }
        private function validateEmail($em) {
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }
            //check if email is already used
            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkEmailQuery) != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
            
        }   
        private function validatePasswords($pw, $pw2) {
            if($pw != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNoMatch);
                return;
            }
            if(preg_match('/[^A-Za-z0-9]/', $pw)) { // custum pattern of pass
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
                return;
            }
            if(strlen($pw) > 25 || strlen($pw) < 5) {
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }
        }
    }
?>