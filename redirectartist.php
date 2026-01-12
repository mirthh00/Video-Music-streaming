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
    $ID=$_POST["albumtitle"];
    header("location: music.php?album=$ID");
    exit();