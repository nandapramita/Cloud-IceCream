<?php
// Process.php

class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getProductById($idProduct) {
        $query = "SELECT * FROM product WHERE idProduct = :idProduct";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
