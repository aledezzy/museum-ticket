<?php
     class Connection {
        private static $user = "scuola";
        private static $pass = "paolino";
        private static $dbAddress = "localhost";
        private static $dbName = "DBMuseo";
        
        public static function new(){
            $conn = new mysqli(self::$dbAddress, self::$user, self::$pass, self::$dbName, 3306);
            if(!$conn){
                include_once "ERROR.php";
                die();
            }
            return $conn;
         }
     }
     
     

?>
