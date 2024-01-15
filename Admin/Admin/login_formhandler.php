<?php
session_start();

require_once 'process.php';

$user = new Admin($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST['username'] ?? '';
	$password = $_POST['password'] ?? '';

	if (!empty($username) && !empty($password))
	{
		// Check if the user exists
		$authenticated_user = $user->authenticate($username, $password);
		if ($authenticated_user)
		{
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $authenticated_user['username'];
			setcookie('username', $authenticated_user['username'], time() + 3600);
			header("Location: ../admin.php");
			exit();
		}
		else 
		{
			// Login failed
			$error = "Your username/password combination was incorrect";
		}
	}
}
?>