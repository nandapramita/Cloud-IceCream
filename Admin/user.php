<!-- user.php -->
<?php
// Panggil file konfigurasi database atau sesuaikan dengan kebutuhan
include 'dbconfig.php';

// Query untuk mengambil data user dari database
$query = "SELECT * FROM user";
$result = $pdo->query($query);
?>

<h2>Data User</h2>
<table border="1">
    <thead>
        <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Email</th>
            <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['idUser']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
