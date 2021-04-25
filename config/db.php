<?php

$servername = "localhost";
$db_name = "zuri";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=" . $servername . ";dbname=" . $db_name, $username, $password);
    return $conn;
}catch(PDOException $e){
    echo "Connection Error: " . $e->getMessage();
}