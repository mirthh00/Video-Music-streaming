<?php
session_start();
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}
?>

<?php

    $ID=$_POST["songid"];
    $c=$_POST["id"];
    header("location: podcasts.php?song=$ID&c=$c");
    exit();
