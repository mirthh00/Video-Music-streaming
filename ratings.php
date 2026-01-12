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

    $rateid=$_POST["rateid"];
    $accountname=$_POST["accountname"];
include 'includes/contentdatabase.inc.php';
$sql="INSERT INTO ratings(accountname,rating,ratedby) VALUES(?,?,?);";
        
$stmt=mysqli_stmt_init($conn);
                           
if(!mysqli_stmt_prepare($stmt,$sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt,"sss",$accountname,$rateid,$_SESSION["username"]);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

