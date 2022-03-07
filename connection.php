<?php
class Connection{

    public static function make () {

        try{
            $database_info= [] ; 
            $data= file(".env");
            foreach($data as $d ){
               $word = explode( "=",$d);
               $database_info[$word[0]]=trim($word[1]);
            }
            $dsn = $database_info['connection'].":dbname=".$database_info["dbname"].";host=".$database_info["host"].";port=".$database_info["port"].";";

            $user = $database_info["user"];
            $password = $database_info["password"];

            return new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

}
?>