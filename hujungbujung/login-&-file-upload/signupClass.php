<?php
    class Signup{
        private $name;
        private $password;
        // private $confirm_password;

        function __construct($userName, $userPassword)
        {
            $this->name = $userName;
            $this->password = $userPassword;
            // $this->confirm_password = $userConfirm_password;
        }
        function combine (){
            return $this->name.','.$this->password.PHP_EOL;
        }
        function save(){
            file_put_contents('loginData.txt',$this->combine(),FILE_APPEND);
        }
    }

?>