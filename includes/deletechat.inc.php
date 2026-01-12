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

$chatid=mysqli_real_escape_string($conn,$_POST["chatid"]);
$roomid=mysqli_real_escape_string($conn,$_POST["roomid"]);

$sql2="DELETE FROM chats WHERE id=? AND roomid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"ss",$chatid,$roomid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

header("location: ../fansroom.php?r=$roomid");
exit();