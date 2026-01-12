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

include "dbh.inc.php";
if(isset($_POST["submit"]))
{
    $message=mysqli_real_escape_string($conn,$_POST["message"]);
    $messagetime=mysqli_real_escape_string($conn,$_POST["messagetime"]);
    $fullname=$_SESSION["fullname"];
  
    
        $username=mysqli_real_escape_string($conn,$_POST["username"]);
        
        $sql4="SELECT * FROM users WHERE  usersUid=?;";
        $stmt=mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt,$sql4)){
                 header("location: ../signup.php?error=stmtfailed");
        exit();
        }
    
        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        $result4=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row4=mysqli_fetch_assoc($result4);
        $rownum4=mysqli_num_rows($result4);
        $imagename=$row4["usersImage"];
        include "contentdatabase.inc.php";
        include "functions.inc.php";
        chat($conn,$roomid,$message,$messagetime,$username,$imagename);
        exit();
    


}