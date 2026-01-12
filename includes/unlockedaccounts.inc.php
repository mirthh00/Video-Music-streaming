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
if(isset($_POST["pay"]))
{
    include 'accountdatabase.inc.php';
    require_once "functions.inc.php";
    $accountname=mysqli_real_escape_string($conn,$_POST["accountname"]);
    $price=mysqli_real_escape_string($conn,$_POST["price"]);
    $recommender=mysqli_real_escape_string($conn,$_POST["recommender"]);
    $accountid=mysqli_real_escape_string($conn,$_POST["accountid"]);
    $profilename=mysqli_real_escape_string($conn,$_POST["profilename"]);
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $userfullname=mysqli_real_escape_string($conn,$_POST["userfullname"]);
    $useremail=mysqli_real_escape_string($conn,$_POST["useremail"]);
    $userid=mysqli_real_escape_string($conn,$_POST["userid"]);
    $catagory=mysqli_real_escape_string($conn,$_POST["catagory"]);
    $roomid=mysqli_real_escape_string($conn,$_POST["roomid"]);
    $roomname=mysqli_real_escape_string($conn,$_POST["roomname"]);
    $country=$_SESSION["country"];
    date_default_timezone_set("Africa/Johannesburg");
    $unlockdate=date("Y-m-d");
    $date=date("F j");

    $sql13="SELECT * FROM intellipreneurs WHERE accountname=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql13)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$accountname);
    mysqli_stmt_execute($stmt);
    $data13=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row13 = mysqli_fetch_assoc($data13);
    $rownum13=mysqli_num_rows($data13);
    if($rownum13 > 0){
        if($userfullname == $row13["accountholder"]){
            $sql8="UPDATE intellipreneurs SET activate='active' WHERE accountname='$accountname';";
            mysqli_query($conn,$sql8);
        }
    }


    $sql5="SELECT * FROM unlockedaccounts WHERE recommender=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql5)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$recommender);
    mysqli_stmt_execute($stmt);
    $data1=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum4=mysqli_num_rows($data1);


    $rownum4=$rownum4+1;
    $revenue=10*($rownum4/100);

    $sql7="SELECT * FROM unlockedaccounts WHERE accountname=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql7)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$accountname);
    mysqli_stmt_execute($stmt);
    $data7=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum7=mysqli_num_rows($data7);
    $rownum7=$rownum7+1;

    $sql6="SELECT * FROM revenue WHERE accountname=? AND day=? AND country=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql6)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"sss",$accountname,$date,$country);
mysqli_stmt_execute($stmt);
$data2=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row2=mysqli_fetch_assoc($data2);
$rownum6=mysqli_num_rows($data2);
$totalprice=$rownum7*$price;

    if($rownum6==0){
        $unlockers=1;
        
        $sql7="INSERT INTO revenue(day,accountname,country,unlockers,returns,totalrevenue,totalunlockers) VALUES (?,?,?,?,?,?,?);";
        $stmt=mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt,$sql7)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "sssssss",$date,$accountname,$country,$unlockers,$price,$totalprice,$rownum7);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    else{
        $returns=$row2["returns"]+$price;
        $unlockers=$row2["unlockers"]+1;
        $sql8="UPDATE revenue SET returns='$returns' WHERE accountname='$accountname' AND day='$date' AND country='$country';";
        mysqli_query($conn,$sql8);
        $sql12="UPDATE revenue SET unlockers='$unlockers' WHERE accountname='$accountname' AND day='$date' AND country='$country';";
        mysqli_query($conn,$sql12);
        $sql8="UPDATE revenue SET totalrevenue='$totalprice' WHERE accountname='$accountname' AND day='$date' AND country='$country';";
        mysqli_query($conn,$sql8);
        $sql12="UPDATE revenue SET totalunlockers='$rownum7' WHERE accountname='$accountname' AND day='$date' AND country='$country';";
        mysqli_query($conn,$sql12);
    }
    include 'dbh.inc.php';
    $sql="UPDATE users SET revenue='$revenue' WHERE usersUid='$recommender';";
    $query=mysqli_query($conn,$sql);

    include 'accountdatabase.inc.php';
    addunlockedroom($conn,$roomid,$roomname,$useremail);
    addunlockedaccount($conn,$accountname,$accountid,$profilename,$userfullname,$username,$useremail,$userid,$catagory,$unlockdate,$recommender);
    
}

else{
    header("location: ../home.php");
    exit();
}