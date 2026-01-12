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
include "contentdatabase.inc.php";

if(isset($_POST["submit"]))
{
    $videoid=mysqli_real_escape_string($conn,$_POST["videoid"]);
    $comment=mysqli_real_escape_string($conn,$_POST["comment"]);
    $commenttime=mysqli_real_escape_string($conn,$_POST["commenttime"]);
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $thumbnail=mysqli_real_escape_string($conn,$_POST["thumbnail"]);

    include "functions.inc.php";
    comment($conn,$videoid,$comment,$commenttime,$username,$thumbnail);
}