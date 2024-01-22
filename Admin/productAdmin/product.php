<?php
// Panggil file konfigurasi database atau sesuaikan dengan kebutuhan
include '../database.php';

class Product {
    private $pdo;

    public function __construct($host, $db, $user, $password) {
        $database = new Database($host, $db, $user, $password);
        $this->pdo = $database->getPDO();
    }

    public function displayProducts() {
        // Query untuk mengambil semua data produk dari database
        $query = "SELECT * FROM product";
        $result = $this->pdo->query($query);

        // Tampilkan data dalam tabel HTML
        ob_start();
        ?>

        <!-- Form untuk menambahkan produk -->
        <h2>Tambah Produk</h2>
        
        <form class="addProductForm" id="addProductForm">
            <label for="productName">Nama Produk:</label>
            <input type="text" name="productName" required>

            <label for="productPrice">Harga:</label>
            <input type="text" name="productPrice" required>

            <label for="productComposition">Komposisi:</label>
            <textarea name="productComposition" required></textarea>

            <label for="productFlavor">Rasa:</label>
            <input type="text" name="productFlavor" required>

            <label for="productWeight">Berat Bersih:</label>
            <input type="text" name="productWeight" required>

            <input type="submit" name="addProduct" value="Tambah Produk">
        </form><br><br>

        <h2>Data Produk</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Komposisi</th>
                    <th>Rasa</th>
                    <th>Berat Bersih</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                // Inisialisasi counter
                $counter = 1;

                while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr data-product-id="<?php echo $row['idProduct']; ?>">
                        <!-- Nomor urut yang sesuai dengan counter -->
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $row['idProduct']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td>
                            <!-- Form untuk mengubah harga -->
                            <form class="updateProductForm">
                                <input type="hidden" name="productID" value="<?php echo $row['idProduct']; ?>">
                                <input type="text" name="newHarga" value="<?php echo $row['harga']; ?>">
                                <input type="submit" name="updateHarga" value="Update Harga">
                            </form>
                        </td>
                        <td><?php echo $row['komposisi']; ?></td>
                        <td><?php echo $row['rasa']; ?></td>
                        <td><?php echo $row['berat_bersih']; ?></td>
                        <td><?php echo $row['gambar']; ?></td>
                        <td>
                            <!-- Form untuk menghapus produk -->
                            <form class="deleteProductForm">
                                <input type="hidden" name="productID" value="<?php echo $row['idProduct']; ?>">
                                <input type="submit" name="deleteProduct" value="Hapus">
                            </form>
                        </td>
                    </tr>
                    <?php
                    // Tingkatkan counter setiap kali baris baru
                    $counter++;
                endwhile; ?>
            </tbody>
        </table>

        <!-- Container untuk menampilkan pesan sukses -->
        <div id="successMessageContainer" style="display:none;"></div>
        <?php
        $tableHtml = ob_get_clean();
        return $tableHtml;
    }
}

// Gunakan kelas Product
$product = new Product("localhost", "cloud", "root", "");

// Tampilkan tabel produk
echo $product->displayProducts();
?>

<!-- Script untuk menangani penghapusan, update stok, update harga produk, dan penambahan produk secara AJAX -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $(".deleteProductForm, .updateProductForm, .addProductForm").submit(function(event) {
            event.preventDefault();

            // Ambil data dari form
            var productID = $(this).find("input[name='productID']").val();
            var action = $(this).find("input[type='submit']").attr('name');
            var newData;

            if (action === 'updateHarga') {
                // Jika form untuk mengubah harga, ambil data tambahan
                newData = $(this).find("input[name='newHarga']").val();
            } else if (action === 'addProduct') {
                // Jika form untuk menambah produk, ambil data tambahan
                newData = {
                    productName: $(this).find("input[name='productName']").val(),
                    productPrice: $(this).find("input[name='productPrice']").val(),
                    productComposition: $(this).find("textarea[name='productComposition']").val(),
                    productFlavor: $(this).find("input[name='productFlavor']").val(),
                    productWeight: $(this).find("input[name='productWeight']").val(),
                };
            }

            // Kirim data ke file PHP yang menangani aksi pada produk
            $.ajax({
                type: "POST",
                url: "productAdmin/process.php",
                data: {
                    action: action,
                    productID: productID,
                    newData: newData
                },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);

                    if (jsonResponse.success) {
                        // Tampilkan pesan sukses jika aksi berhasil
                        displaySuccessMessage(jsonResponse.message);

                        if (action === 'deleteProduct') {
                            // Hapus baris produk dari tabel tanpa me-refresh
                            $("tr[data-product-id='" + jsonResponse.deletedProductID + "']").fadeOut();
                        } else if (action === 'addProduct') {
                            $("tr[data-product-id='" + jsonResponse.newProductID + "']").fadeOut();
                        }
                    } else {
                        // Tampilkan pesan kesalahan jika aksi gagal
                        alert('Error: ' + jsonResponse.message);
                    }
                },

                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status, error);
                }
            });
        });

        // Function untuk menampilkan pesan sukses dalam popup
        function displaySuccessMessage(message) {
            // Tampilkan pesan popup
            alert(message);

            // Sembunyikan pesan setelah beberapa detik
            setTimeout(function() {
                // Mengganti alert dengan popup lain jika diperlukan
                // Misalnya, menggunakan modal Bootstrap atau library pop-up lainnya
            }, 3000);
        }
    });
</script>
