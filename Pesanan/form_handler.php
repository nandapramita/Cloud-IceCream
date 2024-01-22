<?php
include 'process.php';

// Cek apakah data dikirim dari formulir pesanan.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $idProduct = $_POST['idProduct'];
    $hargaProduk = $_POST['hargaProduk'];
    $address = $_POST['address'];

    // Ambil informasi pengguna dari sesi login
    session_start();
    $username = $_SESSION['username'];

    $database = new Database("localhost", "cloud", "root", "");
    $pdo = $database->getPDO();

    $pesanan = new Pesanan($pdo);

    // Simpan pesanan ke database
    if ($pesanan->saveOrder($idProduct, $username, $address, $hargaProduk)) {
        // Pesanan berhasil disimpan
        header("Location: ty.php");
        exit(); // Pastikan untuk keluar setelah header redirect
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
