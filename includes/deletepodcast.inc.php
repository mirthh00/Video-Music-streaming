<?php
session_start();
if(isset($_SESSION["username"])){
    require_once "functions.inc.php";
    include "contentdatabase.inc.php";
}
else{
    header("location: ../login.php");
    exit();
}
$songid=mysqli_real_escape_string($conn,$_POST["songid"]);
$accountid=mysqli_real_escape_string($conn,$_POST["accountid"]);

if(is_dir("../podcasts"))
{
$path="../podcasts/".$songid.".mp3";
unlink($path);

$path1="../podcasts/covers/".$songid.".jpg";
unlink($path1);
}
$sql2="DELETE FROM likedpodcasts WHERE podcastid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$songid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="DELETE FROM podcasts WHERE podcast=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$songid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="DELETE FROM podcaststats WHERE podcast=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$songid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="DELETE FROM podcastanalytics WHERE podcast=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$songid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

header("location: ../account.php?ID=$accountid");
exit();