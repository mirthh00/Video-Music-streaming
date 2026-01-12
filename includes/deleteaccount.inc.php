<?php
session_start();
if(isset($_SESSION["username"])){
    require_once "functions.inc.php";
}
else{
    header("location: ../login.php");
    exit();
}
$fullname = $_SESSION["fullname"];



include "accountdatabase.inc.php";
$sql="SELECT * FROM intellipreneurs WHERE accountholder=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row=mysqli_fetch_assoc($data);

$imagename=$row["profileimage"];
$path="../profilepictures/$imagename";
unlink($path);
$covername=$row["coverimage"];
$path="../intelliprenuercoverpictures/$covername";
unlink($path);

$accountname=$row["accountname"];
include "contentdatabase.inc.php";
$sql3="SELECT * FROM videos WHERE uploader=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql3)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$accountname);
mysqli_stmt_execute($stmt);
$data2=mysqli_stmt_get_result($stmt);

while($row3=mysqli_fetch_assoc($data2))
{


if(is_dir("../content/videos/".$accountname))
{
    $video=$row3["video"];
$path="../content/videos/".$accountname."/".$video;
unlink($path);

$thumbnail=$row3["thumbnail"];
$path="../content/videos/thumbnails/".$accountname."/".$thumbnail;
unlink($path);

$sql2="DELETE FROM likedvideos WHERE videoid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$row3["uniqueid"]);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="SELECT * FROM comments WHERE videoid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$row3["uniqueid"]);
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

mysqli_stmt_bind_param($stmt,"s",$row5["video"]);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
 }
}
$path2="../content/videos/".$accountname;
rmdir($path2);
$path3="../content/videos/thumbnails/".$accountname;
rmdir($path3);
include "accountdatabase.inc.php";
$sql2="DELETE FROM intellipreneurs WHERE accountholder=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="DELETE FROM unlockedaccounts WHERE accountname=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$accountname);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$sql2="SELECT * FROM rooms WHERE roomname=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$accountname);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
$row7=mysqli_fetch_assoc($data);
mysqli_stmt_close($stmt);


    include "contentdatabase.inc.php";
$sql2="DELETE FROM chats WHERE roomid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$row7['roomid']);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

include "accountdatabase.inc.php";
$sql2="DELETE FROM unlockedrooms WHERE roomname=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$accountname);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

include "contentdatabase.inc.php";
$sql2="DELETE FROM videos WHERE uploader=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$accountname);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);



$sql2="SELECT * FROM music WHERE uploader=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$accountname);
mysqli_stmt_execute($stmt);
$data4=mysqli_stmt_get_result($stmt);
$rownum4=mysqli_num_rows($data4);
mysqli_stmt_close($stmt);

if($rownum4>0){
    while($row4=mysqli_fetch_assoc($data4)){
    include "contentdatabase.inc.php";
    $songid=$row4["song"];
    $path="../music/$songid.mp3";
    unlink($path);
    $covername=$row4["song"];
    $path="../music/covers/$covername.jpg";
    unlink($path);

    $sql2="DELETE FROM likedmusic WHERE songid=?;";
    $stmt=mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt,$sql2)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"s",$row4["song"]);
    mysqli_stmt_execute($stmt);
    $data=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $sql2="DELETE FROM music WHERE uploader=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql2)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$accountname);
    mysqli_stmt_execute($stmt);
    $data=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $sql2="DELETE FROM albums WHERE uploader=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql2)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$accountname);
    mysqli_stmt_execute($stmt);
    $data=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    }
}
header("location: ../home.php");
exit();