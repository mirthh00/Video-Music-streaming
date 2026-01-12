<?php
session_start();
if(isset($_POST["boost"]))
{
    include 'contentdatabase.inc.php';
    require_once "functions.inc.php";
    $uniqueid=mysqli_real_escape_string($conn,$_POST["uniqueid"]);
    $thumbnail=mysqli_real_escape_string($conn,$_POST["thumbnail"]);
    $videotitle=mysqli_real_escape_string($conn,$_POST["videotitle"]);
    $uploader=mysqli_real_escape_string($conn,$_POST["uploader"]);
    $genre=mysqli_real_escape_string($conn,$_POST["genre"]);
    $directoryname=mysqli_real_escape_string($conn,$_POST["directoryname"]);
    $accountid=$_POST["accountid"];
    $roomid=$_POST["roomid"];
    boost($conn,$uniqueid,$thumbnail,$videotitle,$uploader,$genre,$directoryname,$accountid,$roomid);
}
else{
    header("location: ../login.php");
    exit();
}