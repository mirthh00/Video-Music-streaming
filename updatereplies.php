<?php
session_start();
if(isset($_POST["replyliked"])){
    include 'includes/contentdatabase.inc.php';
    $replyid=mysqli_real_escape_string($conn,$_POST["replyid"]);
    $action=mysqli_real_escape_string($conn,$_POST["action"]);

switch ($action) {
    case 'like':
        $sql17="INSERT INTO likedreplies(replyid,username) VALUES(?,?);";
        break;
    
    case 'unlike':
        $sql17="DELETE FROM likedreplies WHERE replyid=? and username=?;";
        break;
    default:
        # code...
        break;
}
$stmt=mysqli_stmt_init($conn);
                           
if(!mysqli_stmt_prepare($stmt,$sql17)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt,"ss",$replyid,$_SESSION["username"]);
mysqli_stmt_execute($stmt);
$result17=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

}