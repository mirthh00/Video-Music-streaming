<?php
session_start();
if(isset($_SESSION["username"])){
    require_once "functions.inc.php";
}
else{
    header("location: ../login.php");
    exit();
}
?>

<?php

if(isset($_GET["t"])){
    require_once 'dbh.inc.php';
    $theme=mysqli_real_escape_string($conn,$_GET["t"]);
    $link=mysqli_real_escape_string($conn,$_GET["l"]);
    $username=$_SESSION["username"];
    $_SESSION["theme"]=$theme;
    
    require_once 'functions.inc.php';
   
    theme($conn,$theme,$username,$link);
}
else{
    header("location: ../home.php");
}