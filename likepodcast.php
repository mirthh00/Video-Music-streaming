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
include 'includes/contentdatabase.inc.php';
if(isset($_POST["songliked"])){
    $songid=mysqli_real_escape_string($conn,$_POST["songid"]);
    $action=mysqli_real_escape_string($conn,$_POST["action"]);

switch ($action) {
    case 'like':
        $sql17="INSERT INTO likedpodcasts(podcastid,username) VALUES(?,?);";
        break;
    
    case 'unlike':
        $sql17="DELETE FROM likedpodcasts WHERE podcastid=? and username=?;";
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
mysqli_stmt_bind_param($stmt,"ss",$songid,$_SESSION["username"]);
mysqli_stmt_execute($stmt);
$result17=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

}