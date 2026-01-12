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
$videoid=mysqli_real_escape_string($conn,$_POST["uniqueid"]);
$accountid=mysqli_real_escape_string($conn,$_POST["accountid"]);
$directoryname=mysqli_real_escape_string($conn,$_POST["directoryname"]);

if(is_dir("../content/videos/".$directoryname))
{
$video=$_POST["video"];
$path="../content/videos/".$directoryname."/".$video;
unlink($path);

$thumbnail=$_POST["thumbnail"];
$path1="../content/videos/thumbnails/".$directoryname."/".$thumbnail;
unlink($path1);
}
$sql2="DELETE FROM likedvideos WHERE videoid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$videoid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="SELECT * FROM comments WHERE videoid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$videoid);
mysqli_stmt_execute($stmt);
$data3=mysqli_stmt_get_result($stmt);

while($row6=mysqli_fetch_assoc($data3)){
    $sql2="DELETE FROM likedcomments WHERE commentid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$row6["id"]);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
}
$sql2="DELETE FROM comments WHERE videoid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$videoid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="DELETE FROM videos WHERE uniqueid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$videoid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="DELETE FROM stats WHERE videoid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$videoid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="DELETE FROM analytics WHERE videoid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$videoid);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
header("location: ../account.php?ID=$accountid");
exit();