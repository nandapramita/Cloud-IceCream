<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
        <link rel="icon" type="image/x-icon" href="css/cloud.png">
	    <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <header>
            <a href="#" class="logo">Feel The Clouds<span>.</span></a>
    </header>

        <form method="post" action="signup_formhandler.php">
        <h1>Signup</h1>
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>

            <input type="submit" name="register" value="Register">
        </form>
    </body>
</html>