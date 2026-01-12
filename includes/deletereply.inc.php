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

$replyid=mysqli_real_escape_string($conn,$_POST["replyid"]);
$videoid=mysqli_real_escape_string($conn,$_POST["videoid"]);

$sql2="DELETE FROM likedreplies WHERE replyid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$replyid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="DELETE FROM replies WHERE id=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$replyid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

header("location: ../watchcontent.php?watch=$videoid");
exit();