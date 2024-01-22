<?php

class Database {
    private $pdo;
    
    public function __construct($host, $db, $user, $password) {
        $connectionStr = "mysql:host=$host;dbname=$db";
        try {
            $this->pdo = new PDO($connectionStr, $user, $password);
        } catch (PDOException $e) {
            echo "Connection failed." . $e->getMessage();
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}

?>
