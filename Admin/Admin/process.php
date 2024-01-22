<?php
require_once 'database.php';

class Process {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Method untuk registrasi pengguna
    public function registerUser($username, $password, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO admin (username, password, email) VALUES (:username, :password, :email)");
        $stmt->execute([
            'username' => $username,
            'password' => $password,
            'email' => $email
        ]);
    }

    // Method untuk otentikasi pengguna
    public function authenticate($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = $stmt->fetch();

        if ($user) {
            return $user;
        } else {
            return false;
        }
    }
}

$database = new Database("localhost", "cloud", "root", "");
$pdo = $database->getPDO();

$process = new Process($pdo);
?>
