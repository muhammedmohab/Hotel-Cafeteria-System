<?php
// $dsn = 'mysql:dbname=php_db;host=127.0.0.1;port=3306;';
// $user = 'root';
// $password = '12345';
//     try {
//     $db = new PDO($dsn, $user, $password);
//     var_dump($db);
//     } catch (PDOException $e) {
//         echo 'Connection failed: ' . $e->getMessage();
//     }

class Connection{

    public static function make () {

        try{
            $dsn = 'mysql:dbname=php_db;host=127.0.0.1;port=3306;';
            $user = 'root';
            $password = '12345';

            return new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

}
?>