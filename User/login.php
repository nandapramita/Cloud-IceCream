<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="icon" type="image/x-icon" href="css/cloud.png">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
	<header>
            <a href="#" class="logo">Feel The Clouds<span>.</span></a>
    </header>

		<form method="post" action="login_formhandler.php">
		<h1>Login</h1>
			<label for="username">Username:</label>
        	<input type="text" name="username" required><br><br>

        	<label for="password">Password:</label>
        	<input type="password" name="password" required><br><br>
			<input type="submit" name="login" value="Login">
		<p>Don't have account? <a href="signup.php">Signup</a></P>
		</form>

<?php if (isset($error)): ?>
	<p><?php echo $error; ?></p>
<?php endif; ?>

</body>
</html>