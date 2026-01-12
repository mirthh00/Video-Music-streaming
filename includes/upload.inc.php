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
include 'accountdatabase.inc.php';
$fullname=$_SESSION["fullname"];
$sql3="SELECT * FROM intellipreneurs WHERE  accountholder=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql3)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname);
mysqli_stmt_execute($stmt);
$result3=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row=mysqli_fetch_assoc($result3);
$rownum2=mysqli_num_rows($result3);
if(isset($_POST["upload"]))
{
    include 'contentdatabase.inc.php';
    $word="yuaeiopzwASDJKVBNMQWEXV";
    $uniqueid=str_shuffle($word);
    $uploadedtime=mysqli_real_escape_string($conn,$_POST["uploadedtime"]);
    $genre=mysqli_real_escape_string($conn,$_POST["genre"]);
    if(isset($_POST["link"])){
        $link=mysqli_real_escape_string($conn,$_POST["link"]);
    }
    else{
        $link="None";
    }
    
    $country=mysqli_real_escape_string($conn,$_POST["country"]);
    $views='0';
    $accountname=$row["accountname"];
    $directoryname=$row["directoryname"];
    $accountid=$row["id"];
    $videotitle=mysqli_real_escape_string($conn,$_POST["videotitle"]);
    $videodescription=mysqli_real_escape_string($conn,$_POST["videodescription"]);
    $videoName=$_FILES['video']['name'];
    $videoSize=$_FILES['video']['size'];
    $videoTmpName=$_FILES['video']['tmp_name'];
    $thumbnailName=$_FILES['thumbnail']['name'];
    $thumbnailSize=$_FILES['thumbnail']['size'];
    $thumbnailTmpName=$_FILES['thumbnail']['tmp_name'];
    $subtitlesName=$_FILES['subtitles']['name'];
    $subtitlesSize=$_FILES['subtitles']['size'];
    $subtitlesTmpName=$_FILES['subtitles']['tmp_name'];

    $vidext = end((explode(".", $videoName))); # extra () to prevent notice
    echo $vidext;

    if($vidext != "mp4"){
        header("location: ../upload.php?e=vew");
        exit();
    }

    $thumbext = end((explode(".", $thumbnailName))); # extra () to prevent notice
    echo $thumbext;

    if($thumbext != "jpg"){
        header("location: ../upload.php?e=tew");
        exit();
    }

    $subext = end((explode(".", $subtitlesName))); # extra () to prevent notice
    echo $subext;

    if($subext != "vtt"){
        header("location: ../upload.php?e=sew");
        exit();
    }
    
    include 'functions.inc.php';

    $sql4="SELECT * FROM videos WHERE videotitle=?;";
    $stmt=mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt,$sql4)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"s",$videotitle);
    mysqli_stmt_execute($stmt);
    $result4=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row4=mysqli_fetch_assoc($result4);
    $rownum3=mysqli_num_rows($result4);
        
        upload($conn,$uniqueid,$accountname,$videotitle,$videodescription,$videoName,
        $videoSize,$videoTmpName,$thumbnailName,$thumbnailSize,$thumbnailTmpName,$subtitlesName,$subtitlesSize,$subtitlesTmpName,$accountid,
        $uploadedtime,$genre,$views,$country,$directoryname,$link);
    

}
else
{
    header("location: ../upload.php");
    exit();
}