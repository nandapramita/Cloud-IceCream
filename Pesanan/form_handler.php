<!-- form_handler.php -->
<?php
include 'dbconfig.php';

// Cek apakah data dikirim dari formulir pesanan.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $idProduct = $_POST['idProduct'];
    $hargaProduk = $_POST['hargaProduk'];
    $address = $_POST['address'];

    // Ambil informasi pengguna dari sesi login
    session_start();
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

    // Simpan pesanan ke database
    $queryInsert = "INSERT INTO pesanan (idUser, idProduct, address, total) VALUES (
        (SELECT idUser FROM user WHERE username = '$username'),
        :idProduct,
        :address,
        :hargaProduk
    )";

    $stmt = $pdo->prepare($queryInsert);
    $stmt->bindParam(':idProduct', $idProduct);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':hargaProduk', $hargaProduk);
    
    if ($stmt->execute()) {
        // Pesanan berhasil disimpan
        echo "Pesanan berhasil disimpan.";
    } else {
        // Pesanan gagal disimpan
        echo "Gagal menyimpan pesanan.";
    }
} else {
    // Redirect jika formulir tidak dikirim melalui metode POST
    header('Location: pesanan.php');
    exit();
}
?>
