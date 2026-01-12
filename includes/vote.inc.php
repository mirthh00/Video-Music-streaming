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

$username = $_SESSION["username"];
include "contentdatabase.inc.php";

if(isset($_POST["submit"]))
{
    $roomid=mysqli_real_escape_string($conn,$_POST["roomid"]);
    $pollid=mysqli_real_escape_string($conn,$_POST["pollid"]);
    $optionid=mysqli_real_escape_string($conn,$_POST["optionid"]);

    $sql="SELECT * FROM votes WHERE  roomid=? AND pollid=? AND username=?;";
                     $stmt=mysqli_stmt_init($conn);
     
                     if(!mysqli_stmt_prepare($stmt,$sql)){
                             header("location: ../signup.php?error=stmtfailed");
                             exit();
                     }
     
                     mysqli_stmt_bind_param($stmt,"sss",$roomid,$pollid,$username);
                     mysqli_stmt_execute($stmt);
                     $result=mysqli_stmt_get_result($stmt);
                     mysqli_stmt_close($stmt);
                     $rownum=mysqli_num_rows($result);

                     if($rownum>0)
                     {
                    $sql1="DELETE FROM votes WHERE roomid=? AND pollid=? AND username=?;";
                     $stmt=mysqli_stmt_init($conn);
     
                     if(!mysqli_stmt_prepare($stmt,$sql1)){
                             header("location: ../signup.php?error=stmtfailed");
                             exit();
                     }
     
                     mysqli_stmt_bind_param($stmt,"sss",$roomid,$pollid,$username);
                     mysqli_stmt_execute($stmt);
                     $result1=mysqli_stmt_get_result($stmt);
                     mysqli_stmt_close($stmt);
                     }

    include "functions.inc.php";
    vote($conn,$roomid,$optionid,$username,$pollid);
    
}
else{
    header("location: ../fansroom.php?r=$roomid");
    exit();
}