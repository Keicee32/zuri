<?php session_start();
if(!isset($_SESSION['id']) && $_SESSION['id'] != true){

    header('Location: login.php');
}

include_once "libs/dash-header.php";?>

<?php echo $_SESSION['id'];?>

<?php include_once "./libs/dash-footer.php";?>