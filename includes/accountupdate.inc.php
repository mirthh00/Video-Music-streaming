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

require_once 'accountdatabase.inc.php';
if(isset($_POST["update"])){
    $accountname=mysqli_real_escape_string($conn,$_POST["newaccountname"]);
    $profileName=mysqli_real_escape_string($conn,$_FILES['profile']['name']);
    $profileSize=mysqli_real_escape_string($conn,$_FILES['profile']['size']);
    $profileTmpName=mysqli_real_escape_string($conn,$_FILES['profile']['tmp_name']);
    $profileFolder="../profilepictures/".$profileName;
    $coverName=mysqli_real_escape_string($conn,$_FILES['cover']['name']);
    $coverSize=mysqli_real_escape_string($conn,$_FILES['cover']['size']);
    $coverTmpName=mysqli_real_escape_string($conn,$_FILES['cover']['tmp_name']);
    $coverFolder="../intelliprenuercoverpictures/".$coverName;
    $currentaccount=mysqli_real_escape_string($conn,$_POST["accountname"]);
    $bio=mysqli_real_escape_string($conn,$_POST["bio"]);
    $price=mysqli_real_escape_string($conn,$_POST["price"]);
    $accountid=mysqli_real_escape_string($conn,$_POST["accountid"]);

    $profilext = end((explode(".", $profileName))); # extra () to prevent notice
    echo $profilext;

    if($profilext != "jpg"){
        header("location: ../accountupdate.php?error=wps");
        exit();
    }

    $coverext = end((explode(".", $coverName))); # extra () to prevent notice
    echo $coverext;

    if($coverext != "jpg"){
        header("location: ../accountupdate.php?error=wps");
        exit();
    }
    
    require_once 'functions.inc.php';
   
    updateaccount($conn,$accountname,$currentaccount,$bio,$price,$profileName,$profileSize,$profileTmpName,$profileFolder,$coverName,$coverSize,$coverTmpName,$coverFolder,$accountid);
    
    require_once 'contentdatabase.inc.php';
    require_once 'functions.inc.php';
    updateaccounteverywhere($conn,$accountname,$currentaccount,$profileName,$accountid);
}
else{
    header("location: ../profileupdate.php");
}