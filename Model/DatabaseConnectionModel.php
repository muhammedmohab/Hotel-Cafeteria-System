<?php
class DatabaseConnectionModel{
    private $sdn = "mysql";
    private $dbname = "cafateria";
    private $host = "localhost";
    private $port = "3307";
    private $username = "root";
    private $password = "";
    protected $conn;
    private $URL;

    public function __construct()
    {
		$this->URL = $this->sdn.":dbname=".$this->dbname.";host=".$this->host.";port=".$this->port.";charset=utf8";
        try {
            $this->conn = new \PDO($this->URL, $this->username, $this->password);
            echo "connected";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function connect(){
        return $this->conn;
    }

    public function close()
    {
        return $this->connection = null;;
    }
} 