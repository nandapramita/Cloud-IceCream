<?php
class AdminSession {
    public static function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

// Contoh penggunaan:
AdminSession::logout();
?>
