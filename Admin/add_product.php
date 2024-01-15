<!-- add_product.php -->
<?php
// Panggil file konfigurasi database atau sesuaikan dengan kebutuhan
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addProduct'])) {
    // Ambil data dari form
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];

    // Query untuk menambahkan produk baru ke database
    $query = "INSERT INTO product (nama, harga, stok) VALUES (:productName, :productPrice, :productStock)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':productName', $productName);
    $stmt->bindParam(':productPrice', $productPrice);
    $stmt->bindParam(':productStock', $productStock);

    if ($stmt->execute()) {
        // Jika penambahan produk berhasil, ambil data terbaru dan tampilkan
        $updatedTable = getUpdatedProductTable($pdo);
        echo $updatedTable;
    } else {
        echo "Gagal menambahkan produk.";
    }
} else {
    echo "Metode request tidak valid.";
}

// Fungsi untuk mengambil data produk terbaru dan mengembalikan HTML tabel yang diperbarui
function getUpdatedProductTable($pdo) {
    $query = "SELECT * FROM product";
    $result = $pdo->query($query);

    ob_start(); // Mulai menangkap output
    ?>
    <table border="1">
        <thead>
            <tr>
                <th>No Urut</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
                <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            <?php 
            // Inisialisasi counter
            $counter = 1;

            while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <!-- Nomor urut yang sesuai dengan counter -->
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row['idProduct']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['harga']; ?></td>
                    <td><?php echo $row['stok']; ?></td>
                    <td>
                        <!-- Form untuk menghapus produk -->
                        <form class="deleteProductForm">
                            <input type="hidden" name="productID" value="<?php echo $row['idProduct']; ?>">
                            <input type="submit" name="deleteProduct" value="Hapus">
                        </form>
                    </td>
                    <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                </tr>
            <?php 
            // Tingkatkan counter setiap kali baris baru
            $counter++;
            endwhile; ?>
        </tbody>
    </table>
    <?php
    $tableHtml = ob_get_clean(); // Ambil output yang ditangkap dan bersihkan buffer
    return $tableHtml;
}
?>
