<?php
include 'contentdatabase.inc.php';

if(isset($_POST["like"]))
{
    $likes=mysqli_real_escape_string($conn,$_POST["likes"]);
    $videoid=mysqli_real_escape_string($conn,$_POST["videoid"]);
    $sql="SELECT * FROM videos WHERE uniqueid=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$videoid);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row=mysqli_fetch_assoc($result);
    $views=$row["likes"]+1;
    $sql2="UPDATE videos SET likes='$views' WHERE uniqueid='$videoid';";
    mysqli_query($conn,$sql2);

    header("location: ../watchcontent.php?watch=$videoid");
}