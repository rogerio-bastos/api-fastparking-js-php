<?php

namespace App\Core;

class Model{
    
    private static $connection;

    public static function getConnection(){
        if(!isset(self::$connection)){
            self::$connection = new \PDO("mysql:
            host=localhost;
            port=3306;
            dbname=fastparking;",
            "root",
            "Work@bench");
        }

        return self::$connection;
    }
}