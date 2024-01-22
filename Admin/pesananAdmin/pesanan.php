<?php
include '../database.php';

class Pesanan {
    private $pdo;

    public function __construct($host, $db, $user, $password) {
        $database = new Database($host, $db, $user, $password);
        $this->pdo = $database->getPDO();
    }

    public function deleteOrder($orderID) {
        $query = "DELETE FROM pesanan WHERE idPesanan = :orderID";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':orderID', $orderID);

        if ($stmt->execute()) {
            // Jika penghapusan berhasil, ambil data terbaru dan tampilkan
            $updatedTable = $this->getUpdatedTable();
            echo $updatedTable;
        } else {
            echo "Gagal menghapus pesanan.";
        }
    }

    public function getUpdatedTable() {
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

// Gunakan kelas Pesanan
$pesanan = new Pesanan("localhost", "cloud", "root", "");

// Cek apakah form penghapusan pesanan dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteOrder'])) {
    $orderID = $_POST['orderID'];
    $pesanan->deleteOrder($orderID);
    exit; // Keluar untuk mencegah konten berikutnya dijalankan
}

// Tampilkan tabel pesanan di sini
?>
<h2>Data Pesanan</h2>
<div id="pesanan-container">
    <?php
    $tableHtml = $pesanan->getUpdatedTable();
    echo $tableHtml;
    ?>
</div>

<!-- Script untuk menangani penghapusan pesanan secara AJAX -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $(".deleteOrderForm").submit(function(event) {
            event.preventDefault();

            // Ambil data dari form
            var orderID = $(this).find("input[name='orderID']").val();

            // Kirim data ke file PHP yang menangani penghapusan pesanan
            $.ajax({
                type: "POST",
                url: "pesananAdmin/process.php", // Ganti nama file menjadi dl_pesanan.php
                data: {
                    deleteOrder: true, // Menandakan bahwa ini adalah permintaan penghapusan
                    orderID: orderID
                },
                success: function(response) {
                    // Tampilkan tabel pesanan yang diperbarui
                    $("#pesanan-container").html(response);
                }
            });
        });
    });
</script>
