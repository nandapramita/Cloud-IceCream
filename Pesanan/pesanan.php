<?php
include 'process.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../User/login.php'); // Redirect jika belum login
    exit();
}

$idProduct = $_GET['idProduct'];

$database = new Database("localhost", "cloud", "root", "");
$pdo = $database->getPDO();

$pesanan = new Pesanan($pdo);

$produkInfo = $pesanan->getProdukInfo($idProduct);

if (!$produkInfo) {
    echo "Produk tidak ditemukan.";
    exit();
}

$namaProduk = $produkInfo['nama'];
$hargaProduk = $produkInfo['harga'];

// Ambil informasi pengguna dari database berdasarkan sesi login
$username = $_SESSION['username'];
$userInfo = $pesanan->getUserInfo($username);

if (!$userInfo) {
    echo "Informasi pengguna tidak ditemukan.";
    exit();
}

$namaUser = $userInfo['username'];
$emailUser = $userInfo['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Pesanan Cloud</title>
    <link rel="icon" type="image/x-icon" href="css/cloud.png">
</head>
<body>
    <header>
        <a href="#" class="logo">Feel The Clouds<span>.</span></a>
    </header>

    <form action="form_handler.php" method="post">
        <h1>Formulir Pesanan <br> Ice Cream <?php echo $namaProduk; ?></h1>
        <div class="luv">
            <p>Nama Produk: <?php echo $namaProduk; ?></p>
            <p>Harga Produk: $<?php echo number_format($hargaProduk, 2); ?></p>
            <p>Nama Anda: <?php echo $namaUser; ?></p>
            <p>Email Anda: <?php echo $emailUser; ?></p>
        </div>
        
        <input type="hidden" name="idProduct" value="<?php echo $idProduct; ?>">
        <input type="hidden" name="hargaProduk" value="<?php echo $hargaProduk; ?>">

        <label for="address">Alamat Pengiriman:</label>
        <input type="text" name="address" id="address" required>

        <input type="submit" value="Konfirmasi Pesanan">
    </form>
</body>
</html>
