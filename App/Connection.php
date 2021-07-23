<?php 

namespace App;

class Connection{

    public static function getDb(){
        try{
            $conn = new \PDO("mysql:host=localhost;dbname=projetoteste",'root','',array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            return $conn;
        }catch(\Exception $e){
            header("location: /problemas?erro");
        }
    }
}

?>