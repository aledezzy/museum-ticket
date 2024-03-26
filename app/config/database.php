<?php
    // require_once "config.php";
    class Connection {
        //use the defined constants from config.php
        private static $user = DB_USER;
        private static $pass = DB_PASS;
        private static $dbAddress = DB_HOST;
        private static $dbName = DB_NAME;
        public static function new(){
            $conn = new mysqli(self::$dbAddress, self::$user, self::$pass, self::$dbName, 3306);
            if(!$conn){
                include_once "../includes/ERROR.php";
                die();
            }
            return $conn;
        }
    }

