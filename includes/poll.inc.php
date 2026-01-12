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
date_default_timezone_set("Africa/Johannesburg");
$date=date("Y-m-d");
if(isset($_POST["submit"])){
    $roomid=mysqli_real_escape_string($conn,$_POST["roomid"]);
    $pollstatement=mysqli_real_escape_string($conn,$_POST["pollstatement"]);
    
   
        $option1=mysqli_real_escape_string($conn,$_POST["option1"]);
    
   
   
        $option2=mysqli_real_escape_string($conn,$_POST["option2"]);
    
    
    if(isset($_POST["option3"]))
    {
        $option3=mysqli_real_escape_string($conn,$_POST["option3"]);
    }
    else{
        $option3="Null";
    }
    if(isset($_POST["option4"]))
    {
        $option4=mysqli_real_escape_string($conn,$_POST["option4"]);
    }
    else{
        $option4="Null";
    }
    if(isset($_POST["option4"]))
    {
        $option4=mysqli_real_escape_string($conn,$_POST["option4"]);
    }
    else{
        $option4="Null";
    }
    if(isset($_POST["option5"]))
    {
        $option5=mysqli_real_escape_string($conn,$_POST["option5"]);
    }
    else{
        $option5="Null";
    }
    if(isset($_POST["option6"]))
    {
        $option6=mysqli_real_escape_string($conn,$_POST["option6"]);
    }
    else{
        $option6="Null";
    }
    if(isset($_POST["option7"]))
    {
        $option7=mysqli_real_escape_string($conn,$_POST["option7"]);
    }
    else{
        $option7="Null";
    }
    if(isset($_POST["option8"]))
    {
        $option8=mysqli_real_escape_string($conn,$_POST["option8"]);
    }
    else{
        $option8="Null";
    }
    if(isset($_POST["option9"]))
    {
        $option9=mysqli_real_escape_string($conn,$_POST["option9"]);
    }
    else{
        $option9="Null";
    }
    if(isset($_POST["option10"]))
    {
        $option10=mysqli_real_escape_string($conn,$_POST["option10"]);
    }
    else{
        $option10="Null";
    }

    if(empty($option1) || empty($option2)){
        header("location: ../fansroom.php?r=$roomid");
        exit();
    }
          
        include "functions.inc.php";
        poll($conn,$roomid,$pollstatement,$option1,$option2,$option3,$option4,$option5,$option6,$option7,$option8,$option9,$option10,$date);
        
}
else{
    header("location: ../fansroom.php?r=$roomid");
        exit();
}