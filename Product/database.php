<?php

class Database {
    private $pdo;

    public function __construct($host, $db, $user, $password) {
        $connectionStr = "mysql:host=$host;dbname=$db";
        try {
            $this->pdo = new PDO($connectionStr, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Could not connect to the database $db: " . $e->getMessage());
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}

?>
