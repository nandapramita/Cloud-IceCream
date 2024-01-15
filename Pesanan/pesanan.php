<!-- pesanan.php -->
<?php
include 'dbconfig.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../User/login.php'); // Redirect jika belum login
    exit();
}

$idProduct = $_GET['idProduct'];

$query = "SELECT nama, harga FROM product WHERE idProduct = $idProduct";
$result = $pdo->query($query);

if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $namaProduk = $row['nama'];
    $hargaProduk = $row['harga'];
} else {
    // Handle jika idProduct tidak ditemukan
    echo "Produk tidak ditemukan.";
    exit();
}

//Ambil informasi pengguna dari database berdasarkan sesi login
$username = $_SESSION['username'];
$queryUser = "SELECT username, email FROM user WHERE username = '$username'";
$resultUser = $pdo->query($queryUser);

if ($resultUser->rowCount() > 0) {
    $rowUser = $resultUser->fetch(PDO::FETCH_ASSOC);
    $namaUser = $rowUser['username'];
    $emailUser = $rowUser['email'];
} else {
    // Handle jika informasi pengguna tidak ditemukan
    echo "Informasi pengguna tidak ditemukan.";
    exit();
}
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
            <p>Nama Pengguna: <?php echo $namaUser; ?></p>
            <p>Email Pengguna: <?php echo $emailUser; ?></p>
        </div>
        
        <input type="hidden" name="idProduct" value="<?php echo $idProduct; ?>">
        <input type="hidden" name="hargaProduk" value="<?php echo $hargaProduk; ?>">

        <label for="address">Alamat Pengiriman:</label>
        <input type="text" name="address" id="address" required>

        <input type="submit" value="Pesan Sekarang">
    </form>
</body>
</html>
