<?php
    session_start();
    if(isset($_GET["v"])){
        $uniqueid=$_GET["v"];
    }
    else{
        $uniqueid=$_POST["uniqueid"];
    }
    
    $country=$_SESSION["country"];
    include 'contentdatabase.inc.php';
    $sql="SELECT * FROM videos WHERE  uniqueid=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$uniqueid);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row=mysqli_fetch_assoc($result);
    $accountname=$row["uploader"];
    include 'accountdatabase.inc.php';
    
    $sql2="SELECT * FROM unlockedaccounts WHERE  accountname=? AND  useremail=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$accountname,$_SESSION["useremail"]);
    mysqli_stmt_execute($stmt);
    $result2=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row2=mysqli_fetch_assoc($result2);
    $rownum=mysqli_num_rows($result2);

    $sql13="SELECT * FROM intellipreneurs WHERE  accountname=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql13)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$accountname);
    mysqli_stmt_execute($stmt);
    $result13=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row13=mysqli_fetch_assoc($result13);
    $catagory=$row13["catagory"];
    
    include 'contentdatabase.inc.php';
    $currentid=$uniqueid;
    $videotitle=$row["videotitle"];
    $thumbnail=$row["thumbnail"];
    $uploadedtime=$row["uploadedtime"];
    if(isset($_POST["accountname"])){

    
    if($rownum==0){
    $views=$row["views"];}
    else{
        $views=$row["views"]+1;
    }
}
else{
    $views=$row["views"]+1;
}
    $sql5="UPDATE videos SET views='$views' WHERE uniqueid='$currentid';";
    mysqli_query($conn,$sql5);

    //for analytics
    date_default_timezone_set("Africa/Johannesburg");
    $date=date("F j");
    $sql6="SELECT * FROM analytics WHERE  videoid=? AND day=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql6)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$uniqueid,$date);
    mysqli_stmt_execute($stmt);
    $result6=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row6=mysqli_fetch_assoc($result6);
    $rownum6=mysqli_num_rows($result6);
    if($rownum6==0){
        $uniqueviews=1;
        $sql7="INSERT INTO analytics(videotitle,videoid,uploader,totalviews,day,videoviews,thumbnail,uploadedtime) VALUES (?,?,?,?,?,?,?,?);";
        $stmt=mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt,$sql7)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "ssssssss",$videotitle,$currentid,$accountname,$uniqueviews,$date,$views,$thumbnail,$uploadedtime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    else{
        $totalviews=$row6["totalviews"]+1;
        $sql8="UPDATE analytics SET totalviews='$totalviews' WHERE videoid='$currentid' AND day='$date';";
        mysqli_query($conn,$sql8);
        $sql12="UPDATE analytics SET videoviews='$views' WHERE videoid='$currentid' AND day='$date';";
        mysqli_query($conn,$sql12);
    }


    //for stats
    
    $sql9="SELECT * FROM stats WHERE  videoid=? AND country=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql9)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$uniqueid,$country);
    mysqli_stmt_execute($stmt);
    $result9=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row9=mysqli_fetch_assoc($result9);
    $rownum9=mysqli_num_rows($result9);
    if($rownum9==0){
        $uniqueviews=1;
        $sql10="INSERT INTO stats(videotitle,videoid,uploader,totalviews,country,thumbnail,views,uploadedtime,catagory) VALUES (?,?,?,?,?,?,?,?,?);";
        $stmt=mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt,$sql10)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "sssssssss",$videotitle,$currentid,$accountname,$uniqueviews,$country,$thumbnail,$views,$uploadedtime,$catagory);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    else{
        $totalviews1=$row9["totalviews"]+1;
        $sql11="UPDATE stats SET totalviews='$totalviews1' WHERE videoid='$currentid' AND country='$country';";
        mysqli_query($conn,$sql11);

        $sql12="UPDATE stats SET views='$views' WHERE videoid='$currentid' AND country='$country';";
        mysqli_query($conn,$sql12);
    }
    header("location: ../watchcontent.php?watch=$uniqueid&a=$accountname");



