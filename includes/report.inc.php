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

if(isset($_POST["submit"])){
    require_once 'contentdatabase.inc.php';
    $name=mysqli_real_escape_string($conn,$_POST["name"]);
    $videoid=mysqli_real_escape_string($conn,$_POST["videoid"]);
    $report=mysqli_real_escape_string($conn,$_POST["report"]);
    $uploader=mysqli_real_escape_string($conn,$_POST["uploader"]);
    $useremail=mysqli_real_escape_string($conn,$_POST["useremail"]);

    
    require_once 'functions.inc.php';

    if (filter_var($useremail, FILTER_VALIDATE_EMAIL)){
        $subject="Report Received!";
        $message="Hey $name!We have received your report,we will look into it and take necessary actions
        upon it.Thank you for your interest in keeping the platform a healthy environment for you
        and other users as Mirthh we appreciate that a lot hence we will reward your kind actions once your
        report has been validated.Take care and continue the good work.Oh,please encourage others to follow in 
        your footsteps.Thank You
        ";
        $sender="From: mirthh00@gmail.com";
        mail($useremail,$subject,$message,$sender);
    }
           
        
   
    report($conn,$name,$videoid,$report,$uploader);
}
else{
    header("location: ../login.php");
}