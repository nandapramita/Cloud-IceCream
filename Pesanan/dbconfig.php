<?php
$HOST = "localhost";
$PORT = 3306;
$DB = "cloud";
$USER = "root";
$PASSWORD = "";

$connectionStr = "mysql:host=$HOST;dbname=$DB";

try{
    $pdo = new PDO($connectionStr, $USER, $PASSWORD);
    //echo "Connection Established.";
}
catch (PDOException $e){
    echo "Connection failed." . $e->getMessage();
}