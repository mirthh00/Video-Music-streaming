<?php
session_start();
if(isset($_POST["pay"]))
{
    include 'accountdatabase.inc.php';
    require_once "functions.inc.php";
    $accountname=mysqli_real_escape_string($conn,$_POST["accountname"]);
    $catagory=mysqli_real_escape_string($conn,$_POST["catagory"]);
    $profileimage=$_POST["profileimage"];
    $accountid=$_POST["accountid"];
    $roomid=$_POST["roomid"];
    featured($conn,$accountname,$catagory,$profileimage,$accountid,$roomid);
}
else{
    header("location: ../login.php");
    exit();
}