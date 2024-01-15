<!-- product.php -->
<?php
// Panggil file konfigurasi database atau sesuaikan dengan kebutuhan
include 'dbconfig.php';

// Query untuk mengambil data produk dari database
$query = "SELECT * FROM product";
$result = $pdo->query($query);

// Tampilkan data dalam tabel HTML
?>
<h2>Data Produk</h2>
<table border="1">
    <thead>
        <tr>
            <th>No Urut</th>
            <th>ID Produk</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
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
                <td>
                    <!-- Form untuk mengubah harga -->
                    <form class="updateProductForm">
                        <input type="hidden" name="productID" value="<?php echo $row['idProduct']; ?>">
                        <input type="text" name="newHarga" value="<?php echo $row['harga']; ?>">
                        <input type="submit" name="updateHarga" value="Update Harga">
                    </form>
                </td>
                <td>
                    <!-- Form untuk mengubah stok -->
                    <form class="updateProductForm">
                        <input type="hidden" name="productID" value="<?php echo $row['idProduct']; ?>">
                        <input type="text" name="newStok" value="<?php echo $row['stok']; ?>">
                        <input type="submit" name="updateStok" value="Update Stok">
                    </form>
                </td>
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

<!-- Script untuk menangani penghapusan, update stok, dan update harga produk secara AJAX -->
<script>
    $(document).ready(function() {
        $(".deleteProductForm, .updateProductForm").submit(function(event) {
            event.preventDefault();

            // Ambil data dari form
            var productID = $(this).find("input[name='productID']").val();
            var action = $(this).find("input[type='submit']").attr('name');
            var newData;

            if (action === 'updateHarga' || action === 'updateStok') {
                // Jika form untuk mengubah harga atau stok, ambil data tambahan
                newData = $(this).find("input[name='new" + action.charAt(6).toUpperCase() + action.slice(7) + "']").val();
            }

            // Kirim data ke file PHP yang menangani aksi pada produk
            $.ajax({
                type: "POST",
                url: "dl_product.php",
                data: {
                    action: action,
                    productID: productID,
                    newData: newData
                },
                success: function(response) {
                var jsonResponse = JSON.parse(response);

                if (jsonResponse.success) {
                    if (action === 'deleteProduct') {
                    // Hapus baris produk dari tabel tanpa me-refresh
                        $("tr[data-product-id='" + jsonResponse.deletedProductID + "']").fadeOut();
                        // Tampilkan pesan sukses jika aksi penghapusan berhasil
                        alert('Success: ' + jsonResponse.message);
                    } else {
                    // Tampilkan pesan sukses jika aksi bukan penghapusan
                    alert('Success: ' + jsonResponse.message);
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
    });
</script>