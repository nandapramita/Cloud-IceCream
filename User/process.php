<?php
require_once 'dbconfig.php';
class User
{
	private $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	//method for user registration
	public function registerUser($username, $password, $email)
	{
		$stmt = $this->pdo->prepare("INSERT INTO user (username, password, email) VALUES (:username, :password, :email)");
		$stmt->execute([
			'username'=> $username,
			'password'=> $password,
			'email'=> $email
		]);
	}

	//method for user authentication
	public function authenticate($username, $password)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
		$stmt->execute(['username' => $username, 'password' => $password]);
		$user = $stmt->fetch();

		if ($user)
		{
			return $user;
		} 
		else 
		{
			return false;
		}
	}
}