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

if(isset($_POST["update"])){
    require_once 'dbh.inc.php';
    $newusername=mysqli_real_escape_string($conn,$_POST["newusername"]);
    $newpassword=mysqli_real_escape_string($conn,$_POST["newpassword"]);
    $newimageName=mysqli_real_escape_string($conn,$_FILES['newimage']['name']);
    $newimageSize=mysqli_real_escape_string($conn,$_FILES['newimage']['size']);
    $newimageTmpName=mysqli_real_escape_string($conn,$_FILES['newimage']['tmp_name']);
    $newimageFolder="../profilepictures/".$newimageName;
    $currentuser=$_SESSION['username'];
    $profilext = end((explode(".", $newimageName))); # extra () to prevent notice
    echo $profilext;

    if($profilext != "jpg"){
        header("location: ../signup.php?error=wps");
        exit();
    }
    require_once 'functions.inc.php';
   
    updateuser($conn,$newusername,$currentuser,$newpassword,$newimageName,$newimageSize,$newimageTmpName,$newimageFolder);
}
else{
    header("location: ../profileupdate.php");
}