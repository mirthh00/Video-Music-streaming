<?php
session_start();
if(isset($_POST["submit"])){
    require_once 'dbh.inc.php';
    $word="yuaeiopzwA@#%1265JKVBNMQWEXV";
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

    $p=$_POST["p"];
    $uniqueid=str_shuffle($word);
    $name=mysqli_real_escape_string($conn,$_POST["name"]);
    if(strpos($name,$check1) || strpos($name,$check2) || strpos($name,$check3) || strpos($name,$check4) || strpos($name,$check5)
    || strpos($name,$check6) || strpos($name,$check7) || strpos($name,$check8) || strpos($name,$check9) || strpos($name,$check10)
    || strpos($name,$check11) || strpos($name,$check12) || strpos($name,$check13) || strpos($name,$check14)
    || strpos($name,$check15) || strpos($name,$check16) || strpos($name,$check17) || strpos($name,$check18) || strpos($name,$check19)
    || strpos($name,$check20) || strpos($name,$check21) || strpos($name,$check22) || strpos($name,$check23)
    || strpos($name,$check24) || strpos($name,$check25) || strpos($name,$check26) || strpos($name,$check27) || strpos($name,$check28)
    || strpos($name,$check29) || strpos($name,$check30) || strpos($name,$check31) || strpos($name,$check32)
    || strpos($name,$check33) || strpos($name,$check34) || strpos($name,$check35) || strpos($name,$check36) || strpos($name,$check37)
    || strpos($name,$check38) || strpos($name,$check39) || strpos($name,$check40) || strpos($name,$check41) || strpos($name,$check42)
    || strpos($name,$check43) || strpos($name,$check44) || strpos($name,$check45) || strpos($name,$check46) || strpos($name,$check47) || strpos($name,$check48) 
    || strpos($name,$check49) || strpos($name,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $race=mysqli_real_escape_string($conn,$_POST["race"]);
    if(strpos($race,$check1) || strpos($race,$check2) || strpos($race,$check3) || strpos($race,$check4) || strpos($race,$check5)
    || strpos($race,$check6) || strpos($race,$check7) || strpos($race,$check8) || strpos($race,$check9) || strpos($race,$check10)
    || strpos($race,$check11) || strpos($race,$check12) || strpos($race,$check13) || strpos($race,$check14)
    || strpos($race,$check15) || strpos($race,$check16) || strpos($race,$check17) || strpos($race,$check18) || strpos($race,$check19)
    || strpos($race,$check20) || strpos($race,$check21) || strpos($race,$check22) || strpos($race,$check23)
    || strpos($race,$check24) || strpos($race,$check25) || strpos($race,$check26) || strpos($race,$check27) || strpos($race,$check28)
    || strpos($race,$check29) || strpos($race,$check30) || strpos($race,$check31) || strpos($race,$check32)
    || strpos($race,$check33) || strpos($race,$check34) || strpos($race,$check35) || strpos($race,$check36) || strpos($race,$check37)
    || strpos($race,$check38) || strpos($race,$check39) || strpos($race,$check40) || strpos($race,$check41) || strpos($race,$check42)
    || strpos($race,$check43) || strpos($race,$check44) || strpos($race,$check45) || strpos($race,$check46) || strpos($race,$check47) || strpos($race,$check48) 
    || strpos($race,$check49) || strpos($race,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $gender=mysqli_real_escape_string($conn,$_POST["gender"]);

    if(strpos($gender,$check1) || strpos($gender,$check2) || strpos($gender,$check3) || strpos($gender,$check4) || strpos($gender,$check5)
    || strpos($gender,$check6) || strpos($gender,$check7) || strpos($gender,$check8) || strpos($gender,$check9) || strpos($gender,$check10)
    || strpos($gender,$check11) || strpos($gender,$check12) || strpos($gender,$check13) || strpos($gender,$check14)
    || strpos($gender,$check15) || strpos($gender,$check16) || strpos($gender,$check17) || strpos($gender,$check18) || strpos($gender,$check19)
    || strpos($gender,$check20) || strpos($gender,$check21) || strpos($gender,$check22) || strpos($gender,$check23)
    || strpos($gender,$check24) || strpos($gender,$check25) || strpos($gender,$check26) || strpos($gender,$check27) || strpos($gender,$check28)
    || strpos($gender,$check29) || strpos($gender,$check30) || strpos($gender,$check31) || strpos($gender,$check32)
    || strpos($gender,$check33) || strpos($gender,$check34) || strpos($gender,$check35) || strpos($gender,$check36) || strpos($gender,$check37)
    || strpos($gender,$check38) || strpos($gender,$check39) || strpos($gender,$check40) || strpos($gender,$check41) || strpos($gender,$check42)
    || strpos($gender,$check43) || strpos($gender,$check44) || strpos($gender,$check45) || strpos($gender,$check46) || strpos($gender,$check47) || strpos($gender,$check48) 
    || strpos($gender,$check49) || strpos($gender,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $birthday=mysqli_real_escape_string($conn,$_POST["birthday"]);
    if(strpos($birthday,$check1) || strpos($birthday,$check2) || strpos($birthday,$check3) || strpos($birthday,$check4) || strpos($birthday,$check5)
    || strpos($birthday,$check6) || strpos($birthday,$check7) || strpos($birthday,$check8) || strpos($birthday,$check9) || strpos($birthday,$check10)
    || strpos($birthday,$check11) || strpos($birthday,$check12) || strpos($birthday,$check13) || strpos($birthday,$check14)
    || strpos($birthday,$check15) || strpos($birthday,$check16) || strpos($birthday,$check17) || strpos($birthday,$check18) || strpos($birthday,$check19)
    || strpos($birthday,$check20) || strpos($birthday,$check21) || strpos($birthday,$check22) || strpos($birthday,$check23)
    || strpos($birthday,$check24) || strpos($birthday,$check25) || strpos($birthday,$check26) || strpos($birthday,$check27) || strpos($birthday,$check28)
    || strpos($birthday,$check29) || strpos($birthday,$check30) || strpos($birthday,$check31) || strpos($birthday,$check32)
    || strpos($birthday,$check33) || strpos($birthday,$check34) || strpos($birthday,$check35) || strpos($birthday,$check36) || strpos($birthday,$check37)
    || strpos($birthday,$check38) || strpos($birthday,$check39) || strpos($birthday,$check40) || strpos($birthday,$check41) || strpos($birthday,$check42)
    || strpos($birthday,$check43) || strpos($birthday,$check44) || strpos($birthday,$check45) || strpos($birthday,$check46) || strpos($birthday,$check47)  
    || strpos($birthday,$check49) || strpos($birthday,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $recommender=mysqli_real_escape_string($conn,$_POST["recommender"]);
    if(strpos($recommender,$check1) || strpos($recommender,$check2) || strpos($recommender,$check3) || strpos($recommender,$check4) || strpos($recommender,$check5)
    || strpos($recommender,$check6) || strpos($recommender,$check7) || strpos($recommender,$check8) || strpos($recommender,$check9) || strpos($recommender,$check10)
    || strpos($recommender,$check11) || strpos($recommender,$check12) || strpos($recommender,$check13) || strpos($recommender,$check14)
    || strpos($recommender,$check15) || strpos($recommender,$check16) || strpos($recommender,$check17) || strpos($recommender,$check18) || strpos($recommender,$check19)
    || strpos($recommender,$check20) || strpos($recommender,$check21) || strpos($recommender,$check22) || strpos($recommender,$check23)
    || strpos($recommender,$check24) || strpos($recommender,$check25) || strpos($recommender,$check26) || strpos($recommender,$check27) || strpos($recommender,$check28)
    || strpos($recommender,$check29) || strpos($recommender,$check30) || strpos($recommender,$check31) || strpos($recommender,$check32)
    || strpos($recommender,$check33) || strpos($recommender,$check34) || strpos($recommender,$check35) || strpos($recommender,$check36) || strpos($recommender,$check37)
    || strpos($recommender,$check38) || strpos($recommender,$check39) || strpos($recommender,$check40) || strpos($recommender,$check41) || strpos($recommender,$check42)
    || strpos($recommender,$check43) || strpos($recommender,$check44) || strpos($recommender,$check45) || strpos($recommender,$check46) || strpos($recommender,$check47) || strpos($recommender,$check48) 
    || strpos($recommender,$check49) || strpos($recommender,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $username=mysqli_real_escape_string($conn,$_POST["uid"]);
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
        header("location: ../signup.php");
        exit();
    }

    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    if(strpos($email,$check1) || strpos($email,$check2) || strpos($email,$check3) || strpos($email,$check4) || strpos($email,$check5)
    || strpos($email,$check6) || strpos($email,$check7) || strpos($email,$check8) || strpos($email,$check9) || strpos($email,$check10)
    || strpos($email,$check11) || strpos($email,$check12) || strpos($email,$check13) || strpos($email,$check14)
    || strpos($email,$check15) || strpos($email,$check16) || strpos($email,$check17) || strpos($email,$check18) || strpos($email,$check19)
    || strpos($email,$check20) || strpos($email,$check21) || strpos($email,$check22) || strpos($email,$check23)
    || strpos($email,$check24) || strpos($email,$check25) || strpos($email,$check26) || strpos($email,$check27) || strpos($email,$check28)
    || strpos($email,$check29) || strpos($email,$check30) || strpos($email,$check31) || strpos($email,$check32)
    || strpos($email,$check33) || strpos($email,$check34) || strpos($email,$check35)  || strpos($email,$check37)
    || strpos($email,$check38) || strpos($email,$check39) || strpos($email,$check40) || strpos($email,$check41) || strpos($email,$check42)
    || strpos($email,$check43) || strpos($email,$check44) || strpos($email,$check45) || strpos($email,$check46) || strpos($email,$check47) || strpos($email,$check48) 
    || strpos($email,$check49) || strpos($email,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $email2=mysqli_real_escape_string($conn,$_POST["email2"]);
    if(strpos($email2,$check1) || strpos($email2,$check2) || strpos($email2,$check3) || strpos($email2,$check4) || strpos($email2,$check5)
    || strpos($email2,$check6) || strpos($email2,$check7) || strpos($email2,$check8) || strpos($email2,$check9) || strpos($email2,$check10)
    || strpos($email2,$check11) || strpos($email2,$check12) || strpos($email2,$check13) || strpos($email2,$check14)
    || strpos($email2,$check15) || strpos($email2,$check16) || strpos($email2,$check17) || strpos($email2,$check18) || strpos($email2,$check19)
    || strpos($email2,$check20) || strpos($email2,$check21) || strpos($email2,$check22) || strpos($email2,$check23)
    || strpos($email2,$check24) || strpos($email2,$check25) || strpos($email2,$check26) || strpos($email2,$check27) || strpos($email2,$check28)
    || strpos($email2,$check29) || strpos($email2,$check30) || strpos($email2,$check31) || strpos($email2,$check32)
    || strpos($email2,$check33) || strpos($email2,$check34) || strpos($email2,$check35)  || strpos($email2,$check37)
    || strpos($email2,$check38) || strpos($email2,$check39) || strpos($email2,$check40) || strpos($email2,$check41) || strpos($email2,$check42)
    || strpos($email2,$check43) || strpos($email2,$check44) || strpos($email2,$check45) || strpos($email2,$check46) || strpos($email2,$check47) || strpos($email2,$check48) 
    || strpos($email2,$check49) || strpos($email2,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $password=mysqli_real_escape_string($conn,$_POST["password"]);
    if(strpos($password,$check1) || strpos($password,$check2) || strpos($password,$check3) || strpos($password,$check4) || strpos($password,$check5)
    || strpos($password,$check6) || strpos($password,$check7) || strpos($password,$check8) || strpos($password,$check9) || strpos($password,$check10)
    || strpos($password,$check11) || strpos($password,$check12) || strpos($password,$check13) || strpos($password,$check14)
    || strpos($password,$check15) || strpos($password,$check16) || strpos($password,$check17) || strpos($password,$check18) || strpos($password,$check19)
    || strpos($password,$check20) || strpos($password,$check21) || strpos($password,$check22) || strpos($password,$check23)
    || strpos($password,$check24) || strpos($password,$check25) || strpos($password,$check26) || strpos($password,$check27) || strpos($password,$check28)
    || strpos($password,$check29) || strpos($password,$check30) || strpos($password,$check31) || strpos($password,$check32)
    || strpos($password,$check33) || strpos($password,$check34) || strpos($password,$check35) || strpos($password,$check36) || strpos($password,$check37)
    || strpos($password,$check38) || strpos($password,$check39) || strpos($password,$check40) || strpos($password,$check41) || strpos($password,$check42)
    || strpos($password,$check43) || strpos($password,$check44) || strpos($password,$check45) || strpos($password,$check46) || strpos($password,$check47) || strpos($password,$check48) 
    || strpos($password,$check49) || strpos($password,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $password2=mysqli_real_escape_string($conn,$_POST["password2"]);
    if(strpos($password2,$check1) || strpos($password2,$check2) || strpos($password2,$check3) || strpos($password2,$check4) || strpos($password2,$check5)
    || strpos($password2,$check6) || strpos($password2,$check7) || strpos($password2,$check8) || strpos($password2,$check9) || strpos($password2,$check10)
    || strpos($password2,$check11) || strpos($password2,$check12) || strpos($password2,$check13) || strpos($password2,$check14)
    || strpos($password2,$check15) || strpos($password2,$check16) || strpos($password2,$check17) || strpos($password2,$check18) || strpos($password2,$check19)
    || strpos($password2,$check20) || strpos($password2,$check21) || strpos($password2,$check22) || strpos($password2,$check23)
    || strpos($password2,$check24) || strpos($password2,$check25) || strpos($password2,$check26) || strpos($password2,$check27) || strpos($password2,$check28)
    || strpos($password2,$check29) || strpos($password2,$check30) || strpos($password2,$check31) || strpos($password2,$check32)
    || strpos($password2,$check33) || strpos($password2,$check34) || strpos($password2,$check35) || strpos($password2,$check36) || strpos($password2,$check37)
    || strpos($password2,$check38) || strpos($password2,$check39) || strpos($password2,$check40) || strpos($password2,$check41) || strpos($password2,$check42)
    || strpos($password2,$check43) || strpos($password2,$check44) || strpos($password2,$check45) || strpos($password2,$check46) || strpos($password2,$check47) || strpos($password2,$check48) 
    || strpos($password2,$check49) || strpos($password2,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $usercountry=mysqli_real_escape_string($conn,$_POST["country"]);
    if(strpos($usercountry,$check1) || strpos($usercountry,$check2) || strpos($usercountry,$check3) || strpos($usercountry,$check4) || strpos($usercountry,$check5)
    || strpos($usercountry,$check6) || strpos($usercountry,$check7) || strpos($usercountry,$check8) || strpos($usercountry,$check9) || strpos($usercountry,$check10)
    || strpos($usercountry,$check11) || strpos($usercountry,$check12) || strpos($usercountry,$check13) || strpos($usercountry,$check14)
    || strpos($usercountry,$check15) || strpos($usercountry,$check16) || strpos($usercountry,$check17) || strpos($usercountry,$check18) || strpos($usercountry,$check19)
    || strpos($usercountry,$check20) || strpos($usercountry,$check21) || strpos($usercountry,$check22) || strpos($usercountry,$check23)
    || strpos($usercountry,$check24) || strpos($usercountry,$check25) || strpos($usercountry,$check26) || strpos($usercountry,$check27) || strpos($usercountry,$check28)
    || strpos($usercountry,$check29) || strpos($usercountry,$check30) || strpos($usercountry,$check31) || strpos($usercountry,$check32)
    || strpos($usercountry,$check33) || strpos($usercountry,$check34) || strpos($usercountry,$check35) || strpos($usercountry,$check36) || strpos($usercountry,$check37)
    || strpos($usercountry,$check38) || strpos($usercountry,$check39) || strpos($usercountry,$check40) || strpos($usercountry,$check41) || strpos($usercountry,$check42)
    || strpos($usercountry,$check43) || strpos($usercountry,$check44) || strpos($usercountry,$check45) || strpos($usercountry,$check46) || strpos($usercountry,$check47) || strpos($usercountry,$check48) 
    || strpos($usercountry,$check49) || strpos($usercountry,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    $imageName=$_FILES['image']['name'];
    $imageSize=$_FILES['image']['size'];
    $imageTmpName=$_FILES['image']['tmp_name'];
    $imageFolder="../profilepictures/".$imageName;

    $picext = end((explode(".", $imageName))); # extra () to prevent notice
    echo $picext;

    if($picext != "jpg"){
        header("location: ../signup.php?error=psb");
        exit();
    }
    require_once 'functions.inc.php';
    $sql14="SELECT * FROM users  WHERE  usersName=?;";
    $stmt=mysqli_stmt_init($conn);
                               
    if(!mysqli_stmt_prepare($stmt,$sql14)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$name);
    mysqli_stmt_execute($stmt);
    $result14=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum=mysqli_num_rows($result14);
    if($rownum>0){
        $_SESSION["username"]=$username;
        $_SESSION["email"]=$email;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=fullnametaken");
        exit();
    }

    $sql15="SELECT * FROM users  WHERE  usersUid=?;";
    $stmt=mysqli_stmt_init($conn);
                               
    if(!mysqli_stmt_prepare($stmt,$sql15)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);
    $result15=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum2=mysqli_num_rows($result15);
    if($rownum2>0){
        $_SESSION["name"]=$name;
        $_SESSION["email"]=$email;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    $sql16="SELECT * FROM users  WHERE  usersEmail=? OR usersEmail=?;";
    $stmt=mysqli_stmt_init($conn);
                               
    if(!mysqli_stmt_prepare($stmt,$sql16)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$email,$email2);
    mysqli_stmt_execute($stmt);
    $result16=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum3=mysqli_num_rows($result16);
    if($rownum3>0){
        $_SESSION["username"]=$username;
        $_SESSION["name"]=$name;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=emailtaken");
        exit();
    }
    if(empty($birthday)){
        $_SESSION["username"]=$username;
        $_SESSION["email"]=$email;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["name"]=$name;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=birthdaynotset");
        exit();
    }
    if(empty($name)){
        $_SESSION["username"]=$username;
        $_SESSION["email"]=$email;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=fullnamenotset");
        exit();
    }

    if(empty($username)){
        $_SESSION["name"]=$name;
        $_SESSION["email"]=$email;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=usernamenotset");
        exit();
    }

    if(empty($email) || empty($email2)){
        $_SESSION["username"]=$username;
        $_SESSION["name"]=$name;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=emailnotset");
        exit();
    }

    if(empty($password) || empty($password2)){
        $_SESSION["username"]=$username;
        $_SESSION["email"]=$email;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["name"]=$name;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=passwordnotset");
        exit();
    }

    if (empty($imageName) || empty($imageSize) || empty($imageTmpName)){
        $_SESSION["username"]=$username;
        $_SESSION["name"]=$name;
        $_SESSION["email"]=$email;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=picturenotchosen");
        exit();
    }

    if (emptyInput($name, $username, $email, $email2, $password, $password2) !== false) {
        header("location: ../signup.php?error=emptyinputs");
        exit();
    }
    if (usernameInvalid($username) !== false){
        $_SESSION["name"]=$name;
        $_SESSION["email"]=$email;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if (emailInvalid($email) !== false) {
        $_SESSION["username"]=$username;
        $_SESSION["name"]=$name;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (emailCheck($email, $email2) !== false) {
        $_SESSION["username"]=$username;
        $_SESSION["name"]=$name;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=emailsdontmatch");
        exit();
    }
    if (passwordCheck($password, $password2) !== false) {
        $_SESSION["username"]=$username;
        $_SESSION["name"]=$name;
        $_SESSION["email"]=$email;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (userExist($conn, $username, $email) !== false) {
        $_SESSION["name"]=$name;
        $_SESSION["race"]=$race;
        $_SESSION["gender"]=$gender;
        $_SESSION["birthday"]=$birthday;
        $_SESSION["recommender"]=$recommender;
        $_SESSION["password"]=$password;
        $_SESSION["usercountry"]=$usercountry;
        header("location: ../signup.php?error=userexists");
        exit();
    }
    sendMail($email,$uniqueid,$name);
    session_reset();
    session_destroy();
    createuser($conn,$name,$username,$email,$password,$usercountry,$imageName,$imageSize,$imageTmpName,$imageFolder,$recommender,$uniqueid,$race,$gender,$birthday,$p);
    
   
}
else{
    header("location: ../signup.php");
}

