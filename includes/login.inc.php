<?php
session_start();
require_once 'dbh.inc.php';
if (isset($_POST["submit"])){
    $check1="<script>";
    $check2="</script>";
    $check3="url";
    $check4="redirect";
    $check5="()";
    $check6="=";
    $check7=";";
    $check8='"';
    $check9="cout<<";
    $check10="{";
    $check11="}";
    $check12="<<endl";
    $check13="socket";
    $check14="PIPE";
    $check15="stdout";
    $check16="stdin";
    $check17="exit";
    $check18="true";
    $check19="import";
    $check20=":";
    $check21="==";
    $check22="?";
    $check23="&&";
    $check24="||";
    $check25="print";
    $check26=".bind";
    $check27=".command";
    $check28=".connect";
    $check29="<APPLET>";
    $check30="<SCRIPT>";
    $check31="<IMG>";
    $check32="<img>";
    $check33="<";
    $check34=">";
    $check35=",";
    $check36=".";
    $check37="!";
    $check38="{";
    $check39="}";
    $check40="[";
    $check41="]";
    $check42="?";
    $check43="Php";
    $check44="$";
    $check45="%";
    $check46="*";
    $check47="^";
    $check48="/";
    $check49="===";
    $check50="FETCH";
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $useremail=mysqli_real_escape_string($conn,$_POST["useremail"]);
    $userpassword=mysqli_real_escape_string($conn,$_POST["userpassword"]);
    $v=mysqli_real_escape_string($conn,$_POST["v"]);
    $p=$_POST["p"];

    if(strpos($username,$check1) || strpos($username,$check2) || strpos($username,$check3) || strpos($username,$check4) || strpos($username,$check5)
    || strpos($username,$check6) || strpos($username,$check7) || strpos($username,$check8) || strpos($username,$check9) || strpos($username,$check10)
    || strpos($username,$check11) || strpos($username,$check12) || strpos($username,$check13) || strpos($username,$check14)
    || strpos($username,$check15) || strpos($username,$check16) || strpos($username,$check17) || strpos($username,$check18) || strpos($username,$check19)
    || strpos($username,$check20) || strpos($username,$check21) || strpos($username,$check22) || strpos($username,$check23)
    || strpos($username,$check24) || strpos($username,$check25) || strpos($username,$check26) || strpos($username,$check27) || strpos($username,$check28)
    || strpos($username,$check29) || strpos($username,$check30) || strpos($username,$check31) || strpos($username,$check32)
    || strpos($username,$check33) || strpos($username,$check34) || strpos($username,$check35) || strpos($username,$check36) || strpos($username,$check37)
    || strpos($username,$check38) || strpos($username,$check39) || strpos($username,$check40) || strpos($username,$check41) || strpos($username,$check42)
    || strpos($username,$check43) || strpos($username,$check44) || strpos($username,$check45) || strpos($username,$check46) || strpos($username,$check47) || strpos($username,$check48) 
    || strpos($username,$check49) || strpos($username,$check50)
    )
    {
        header("location: ../login.php?error=ucu");
        exit();
    }

    if(strpos($useremail,$check1) || strpos($useremail,$check2) || strpos($useremail,$check3) || strpos($useremail,$check4) || strpos($useremail,$check5)
    || strpos($useremail,$check6) || strpos($useremail,$check7) || strpos($useremail,$check8) || strpos($useremail,$check9) || strpos($useremail,$check10)
    || strpos($useremail,$check11) || strpos($useremail,$check12) || strpos($useremail,$check13) || strpos($useremail,$check14)
    || strpos($useremail,$check15) || strpos($useremail,$check16) || strpos($useremail,$check17) || strpos($useremail,$check18) || strpos($useremail,$check19)
    || strpos($useremail,$check20) || strpos($useremail,$check21) || strpos($useremail,$check22) || strpos($useremail,$check23)
    || strpos($useremail,$check24) || strpos($useremail,$check25) || strpos($useremail,$check26) || strpos($useremail,$check27) || strpos($useremail,$check28)
    || strpos($useremail,$check29) || strpos($useremail,$check30) || strpos($useremail,$check31) || strpos($useremail,$check32)
    || strpos($useremail,$check33) || strpos($useremail,$check34) || strpos($useremail,$check35)  || strpos($useremail,$check37)
    || strpos($useremail,$check38) || strpos($useremail,$check39) || strpos($useremail,$check40) || strpos($useremail,$check41) || strpos($useremail,$check42)
    || strpos($useremail,$check43) || strpos($useremail,$check44) || strpos($useremail,$check45) || strpos($useremail,$check46) || strpos($useremail,$check47) || strpos($useremail,$check48) 
    || strpos($useremail,$check49) || strpos($useremail,$check50)
    )
    {
        header("location: ../login.php?error=uce");
        exit();
    }

    if(strpos($userpassword,$check1) || strpos($userpassword,$check2) || strpos($userpassword,$check3) || strpos($userpassword,$check4) || strpos($userpassword,$check5)
    || strpos($userpassword,$check6) || strpos($userpassword,$check7) || strpos($userpassword,$check8) || strpos($userpassword,$check9) || strpos($userpassword,$check10)
    || strpos($userpassword,$check11) || strpos($userpassword,$check12) || strpos($userpassword,$check13) || strpos($userpassword,$check14)
    || strpos($userpassword,$check15) || strpos($userpassword,$check16) || strpos($userpassword,$check17) || strpos($userpassword,$check18) || strpos($userpassword,$check19)
    || strpos($userpassword,$check20) || strpos($userpassword,$check21) || strpos($userpassword,$check22) || strpos($userpassword,$check23)
    || strpos($userpassword,$check24) || strpos($userpassword,$check25) || strpos($userpassword,$check26) || strpos($userpassword,$check27) || strpos($userpassword,$check28)
    || strpos($userpassword,$check29) || strpos($userpassword,$check30) || strpos($userpassword,$check31) || strpos($userpassword,$check32)
    || strpos($userpassword,$check33) || strpos($userpassword,$check34) || strpos($userpassword,$check35) || strpos($userpassword,$check36) || strpos($userpassword,$check37)
    || strpos($userpassword,$check38) || strpos($userpassword,$check39) || strpos($userpassword,$check40) || strpos($userpassword,$check41) || strpos($userpassword,$check42)
    || strpos($userpassword,$check43) || strpos($userpassword,$check44) || strpos($userpassword,$check45) || strpos($userpassword,$check46) || strpos($userpassword,$check47) || strpos($userpassword,$check48) 
    || strpos($userpassword,$check49) || strpos($userpassword,$check50)
    )
    {
        header("location: ../login.php?error=ucp");
        exit();
    }

    if(empty($username)){
        $_SESSION["email"]=$useremail;
        $_SESSION["password"]=$userpassword;
        header("location: ../login.php?error=usernamenotset");
        exit();
    }

    if(empty($useremail)){
        $_SESSION["username"]=$username;
        
        $_SESSION["password"]=$userpassword;
       
        header("location: ../login.php?error=emailnotset");
        exit();
    }

    if(empty($userpassword)){
        $_SESSION["username"]=$username;
        $_SESSION["email"]=$useremail;
        header("location: ../login.php?error=passwordnotset");
        exit();
    } 

   
    
    require_once 'functions.inc.php';
    

    if (emptyLoginInput($username, $useremail, $userpassword) !== false) {
        header("location: ../login.php?error=emptyinputs");
        exit();
    }

    loginuser($conn,$username,$useremail,$userpassword,$v,$p);
    
}
else{
    header("location: ../login.php");
    exit();
}