<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pesanan Cloud</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="css/cloud.png">
</head>
<body>
    <header>
        <a href="#" class="logo">Feel The Clouds<span>.</span></a>
    </header>
</body>
</html>

<?php
// detail.php

// Sertakan file database.php
include 'database.php';
include 'process.php';

// Ambil ID produk dari parameter URL
if (isset($_GET['idProduct'])) {
    $idProduct = $_GET['idProduct'];

    try {
        // Buat objek Database
        $database = new Database("localhost", "cloud", "root", "");
        $pdo = $database->getPDO();

        // Buat objek Product
        $product = new Product($pdo);

        // Dapatkan informasi produk menggunakan metode dari kelas Product
        $productInfo = $product->getProductById($idProduct);

        if ($productInfo) {
            // Tampilkan informasi produk
            echo "<form action='../Pesanan/pesanan.php' method='get'>";
            echo "<h1>Detail Produk: {$productInfo['nama']}</h1>";
            echo "<p>Harga: {$productInfo['harga']}</p>";
            echo "<p>Komposisi: {$productInfo['komposisi']}</p>";
            echo "<p>Rasa: {$productInfo['rasa']}</p>";
            echo "<p>Berat Bersih: {$productInfo['berat_bersih']}</p>";
            echo "<input type='hidden' name='idProduct' value='$idProduct'>";
            echo "<input type='submit' name='buyNow' value='Buy Now'>";
            echo "</form>";
        } else {
            echo "Produk tidak ditemukan.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID Produk tidak valid.";
}
?>
