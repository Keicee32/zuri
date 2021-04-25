<?php

require_once "config/db.php";

$id_user = isset($_GET['id']) ? $_GET['id'] : die('Error: Record not found');

try{
    $sql = "DELETE FROM courses WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id_user);
    if($stmt->execute()){
        header('Location: dashboard.php');
    }
    
}catch(PDOException $e){
    echo $e->getMessage();
}