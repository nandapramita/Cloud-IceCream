<?php
include 'database.php';

class Pesanan {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getProdukInfo($idProduct) {
        $query = "SELECT nama, harga FROM product WHERE idProduct = $idProduct";
        $result = $this->pdo->query($query);

        if ($result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getUserInfo($username) {
        $queryUser = "SELECT username, email FROM user WHERE username = '$username'";
        $resultUser = $this->pdo->query($queryUser);

        if ($resultUser->rowCount() > 0) {
            return $resultUser->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function saveOrder($idProduct, $username, $address, $hargaProduk) {
        $queryInsert = "INSERT INTO pesanan (idUser, idProduct, address, total) VALUES (
            (SELECT idUser FROM user WHERE username = '$username'),
            :idProduct,
            :address,
            :hargaProduk
        )";

        $stmt = $this->pdo->prepare($queryInsert);
        $stmt->bindParam(':idProduct', $idProduct);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':hargaProduk', $hargaProduk);

        return $stmt->execute();
    }
}

?>
