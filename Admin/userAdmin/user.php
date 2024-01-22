<?php
// Panggil file konfigurasi database atau sesuaikan dengan kebutuhan
include '../database.php';

class User {
    private $pdo;

    public function __construct($host, $db, $user, $password) {
        $database = new Database($host, $db, $user, $password);
        $this->pdo = $database->getPDO();
    }

    public function displayUsers() {
        // Query untuk mengambil data user dari database
        $query = "SELECT * FROM user";
        $result = $this->pdo->query($query);

        // Tampilkan data dalam tabel HTML
        ob_start();
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
        <?php
        $tableHtml = ob_get_clean();
        return $tableHtml;
    }
}

// Gunakan kelas User
$user = new User("localhost", "cloud", "root", "");

// Tampilkan tabel user
echo $user->displayUsers();
?>
