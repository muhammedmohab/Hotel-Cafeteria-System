<?php
class Connection
{
    private static $database_info = [];
    public static function make()
    {
        if (self::validate()) {
            try {
                $dsn = self::$database_info['connection'] . ":dbname=" . self::$database_info["dbname"] . ";host=" . self::$database_info["host"] . ";port=" . self::$database_info["port"] . ";";
                $user = self::$database_info["user"];
                $password = self::$database_info["password"];
                return new PDO($dsn, $user, $password);
            } catch (PDOException $e) {
                header("location:../index.php?errors=" . $e->getMessage());
            }
        }
    }

    public static function validate():bool
    {
        try {
            $database_keys = ["connection", "dbname", "host", "port","user","password"];
            $lines = file("../.env");
            foreach ($lines as $line) {
                $lineWords = explode("=", $line);
                if (in_array(trim($lineWords[0]), $database_keys))
                    self::$database_info[trim($lineWords[0])] = trim($lineWords[1]);
            }
            if (count(self::$database_info) == count($database_keys)){
                return true;
            }
            else {
                header("location:../index.php?errors=Your Env File Have Issue");
                return false;}
        } catch (Exception $e) {
            header("location:../index.php?errors=" . $e->getMessage());
            return false;
        }
    }
}