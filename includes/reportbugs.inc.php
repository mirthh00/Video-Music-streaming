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
    $report=mysqli_real_escape_string($conn,$_POST["report"]);
    $useremail=mysqli_real_escape_string($conn,$_POST["useremail"]);

    
    require_once 'functions.inc.php';

    if (filter_var($useremail, FILTER_VALIDATE_EMAIL)){
        $subject="Report For A Bug Received!";
        $message="Hey $name!We have received your report for a bug,we will look into it and take necessary actions
        upon it.Thank you for your interest in keeping the platform a good environment for you
        and other users as Mirthh we appreciate that a lot.Take care and report if you come across another bug.Oh,please encourage others to follow in 
        your footsteps.Thank You.
        ";
        $sender="From: mirthh00@gmail.com";
        mail($useremail,$subject,$message,$sender);
    }
           
        
   
    reportbugs($conn,$name,$report,$useremail);
}
else{
    header("location: ../login.php");
}