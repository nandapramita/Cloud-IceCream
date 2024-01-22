<?php
// Panggil file konfigurasi database atau sesuaikan dengan kebutuhan
include '../database.php';

class DeletePesanan {
    private $pdo;

    public function __construct($host, $db, $user, $password) {
        $database = new Database($host, $db, $user, $password);
        $this->pdo = $database->getPDO();
    }

    public function deletePesanan($orderID) {
        // Lakukan penghapusan pesanan dari database
        $query = "DELETE FROM pesanan WHERE idPesanan = :orderID";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':orderID', $orderID);

        if ($stmt->execute()) {
            // Jika penghapusan berhasil, ambil data terbaru dan kirimkan sebagai respons
            return $this->getUpdatedTable();
        } else {
            return "Gagal menghapus pesanan.";
        }
    }

    // Fungsi untuk mengambil data pesanan terbaru dan mengembalikan HTML tabel yang diperbarui
    private function getUpdatedTable() {
        $query = "SELECT * FROM pesanan";
        $result = $this->pdo->query($query);

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
}

// Gunakan kelas DeletePesanan
$deletePesanan = new DeletePesanan("localhost", "cloud", "root", "");

// Cek apakah form penghapusan pesanan dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderID'])) {
    $orderID = $_POST['orderID'];

    // Hapus pesanan dan tampilkan hasilnya
    echo $deletePesanan->deletePesanan($orderID);
} else {
    echo "Metode request tidak valid.";
}
?>
