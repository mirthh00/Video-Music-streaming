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

include 'includes/accountdatabase.inc.php';

$status="Offline";
$username1=$_SESSION["username"];
$roomname=$_GET["rm"];
$sql9="UPDATE unlockedaccounts SET status='$status' WHERE username='$username1' AND accountname='$roomname';";
        mysqli_query($conn,$sql9);

header("location: rooms.php");
exit();