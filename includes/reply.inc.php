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

if(isset($_POST["send"]))
{
    include "contentdatabase.inc.php";
    $commentid=mysqli_real_escape_string($conn,$_POST["commentid"]);
    $reply=mysqli_real_escape_string($conn,$_POST["reply"]);
    $replytime=mysqli_real_escape_string($conn,$_POST["replytime"]);
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $thumbnail=mysqli_real_escape_string($conn,$_POST["thumbnail"]);
    $videoid=mysqli_real_escape_string($conn,$_POST["videoid"]);

    
    include "functions.inc.php";
    reply($conn,$videoid,$commentid,$reply,$replytime,$username,$thumbnail);
}