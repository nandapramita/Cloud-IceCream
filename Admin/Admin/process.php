<?php
require_once 'dbconfig.php';

class Admin
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // method for user registration
    public function registerUser($username, $password, $email)
    {
        // Hash password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO Admin (username, password, email) VALUES (:username, :password, :email)");
        $stmt->execute([
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email
        ]);
    }

    // method for user authentication
    public function authenticate($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Admin WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
}
