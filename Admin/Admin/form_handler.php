<?php
include 'process.php';

// Cek apakah data dikirim dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $action = $_POST["action"] ?? '';

    switch ($action) {
        case 'login':
            handleLogin();
            break;

        case 'signup':
            handleSignup();
            break;

        default:
            echo "Invalid action";
            break;
    }
}

function handleLogin() {
    global $process;

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Check if the user exists
        $authenticated_user = $process->authenticate($username, $password);

        if ($authenticated_user) {
            // Login successful
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $authenticated_user['username'];
            setcookie('username', $authenticated_user['username'], time() + 3600);
            header("Location: ../admin.php");
            exit();
        } else {
            // Login failed
            $error = "Your username/password combination was incorrect";
            echo $error;
        }
    }
}

function handleSignup() {
    global $process;

    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    $email = $_POST["email"] ?? "";

    if (!empty($username) && !empty($password) && !empty($email)) {
        // Register the user
        $process->registerUser($username, $password, $email);
        header("Location: login.php");
        exit();
    }
}
?>
