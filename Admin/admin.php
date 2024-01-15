<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: Admin/login.php");
    exit();
}
?>

<!-- admin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Admin Cloud</title>
    <link rel="icon" type="image/x-icon" href="css/cloud.png">
</head>
<body>
    <header>
        <a href="#" class="logo">Feel The Clouds [Admin]<span>.</span></a>
        <nav>
            <ul>
                <li id="user-menu">Data User</li>
                <li id="product-menu">Data Produk</li>
                <li id="pesanan-menu">Data Pesanan</li>
                <li><a href="Admin/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div id="content-container">
        <!-- Area untuk menampilkan konten dari user.php, product.php, atau pesanan.php -->
    </div>

    <!-- Script untuk melakukan request AJAX saat menu di-klik -->
    <script>
        $(document).ready(function() {
            // Fungsi untuk menampilkan konten berdasarkan menu yang di-klik
            function showContent(content) {
                $.ajax({
                    type: "GET",
                    url: content,
                    success: function(response) {
                        $("#content-container").html(response);
                    }
                });
            }

            // Tampilkan konten default (misalnya user.php) saat halaman pertama kali dibuka
            showContent("welcome.php");

            // Cek status login dan sesuaikan menu
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>
            // Jika sudah login
                $("#user-menu, #product-menu, #pesanan-menu").show();
                $(".fa-user").show();
            <?php } else { ?>
            // Jika belum login
                $("#user-menu, #product-menu, #pesanan-menu").hide();
                $(".fa-user").hide();
            <?php } ?>

            // Event handler untuk menu user
            $("#user-menu").click(function() {
                showContent("user.php");
            });

            // Event handler untuk menu product
            $("#product-menu").click(function() {
                showContent("product.php");
            });

            // Event handler untuk menu pesanan
            $("#pesanan-menu").click(function() {
                showContent("pesanan.php");
            });
        });
    </script>
</body>
</html>
