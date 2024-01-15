<?php
// Panggil file konfigurasi database atau sesuaikan dengan kebutuhan
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderID = $_POST['orderID'];

    // Lakukan penghapusan pesanan dari database
    $query = "DELETE FROM pesanan WHERE idPesanan = :orderID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':orderID', $orderID);

    if ($stmt->execute()) {
        // Jika penghapusan berhasil, ambil data terbaru dan kirimkan sebagai respons
        $updatedTable = getUpdatedTable($pdo);
        echo $updatedTable;
    } else {
        echo "Gagal menghapus pesanan.";
    }
} else {
    echo "Metode request tidak valid.";
}

// Fungsi untuk mengambil data pesanan terbaru dan mengembalikan HTML tabel yang diperbarui
function getUpdatedTable($pdo) {
    $query = "SELECT * FROM pesanan";
    $result = $pdo->query($query);

    ob_start(); // Mulai menangkap output
    ?>
    <table border="1">
        <thead>
            <tr>
                <th>No Urut</th>
                <th>ID Pesanan</th>
                <th>ID User</th>
                <th>ID Produk</th>
                <th>Alamat</th>
                <th>Total</th>
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
                    <td><?php echo $row['idPesanan']; ?></td>
                    <td><?php echo $row['idUser']; ?></td>
                    <td><?php echo $row['idProduct']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td>
                        <!-- Form untuk menghapus pesanan -->
                        <form class="deleteOrderForm">
                            <input type="hidden" name="orderID" value="<?php echo $row['idPesanan']; ?>">
                            <input type="submit" name="deleteOrder" value="Hapus">
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
