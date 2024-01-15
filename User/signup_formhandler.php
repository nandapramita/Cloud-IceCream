<?php
require_once 'process.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"]))
{
    $reg_user = new User($pdo);
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    $email = $_POST["email"] ?? "";

    if (!empty($username) && !empty($password) && !empty($email))
    {
        $reg_user->registerUser($username, $password, $email);
        header("Location: login.php");
        exit();
    }
}