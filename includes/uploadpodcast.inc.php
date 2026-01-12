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
if($rownum2==0){
    header("location: ../uploadpodcast.php?error=noexistingaccount");
    exit();
}
if($row["catagory"]!="Podcasts"){
    header("location: ../uploadpodcast.php?error=youraccountcannotuploadpodcasts");
    exit();
}
if(isset($_POST["upload"]))
{
    include 'contentdatabase.inc.php';
    $uploadedtime=mysqli_real_escape_string($conn,$_POST["uploadedtime"]);
    $genre=mysqli_real_escape_string($conn,$_POST["genre"]);
    $uploaderprofile=mysqli_real_escape_string($conn,$_POST["uploaderprofile"]);
    $streams='0';
    $accountname=$row["accountname"];
    $accountid=$row["id"];
    $songtitle=mysqli_real_escape_string($conn,$_POST["songtitle"]);
    $albumtitle=mysqli_real_escape_string($conn,$_POST["albumtitle"]);
    $artists=mysqli_real_escape_string($conn,$_POST["artists"]);
    $songName=$_FILES['song']['name'];
    $songSize=$_FILES['song']['size'];
    $songTmpName=$_FILES['song']['tmp_name'];
    $coverName=$_FILES['cover']['name'];
    $coverSize=$_FILES['cover']['size'];
    $coverTmpName=$_FILES['cover']['tmp_name'];
    
    $sql4 = "SELECT * FROM podcasts;";
    $result4=mysqli_query($conn,$sql4);
    $rownum4=mysqli_num_rows($result4);
    $uniqueid=$rownum4+1;
    include 'functions.inc.php';

    uploadpodcast($conn,$uniqueid,$accountname,$songtitle,$artists,$songName,
    $songSize,$songTmpName,$coverName,$coverSize,$coverTmpName,$accountid,$uploadedtime,$genre,$streams,
    $uploaderprofile);
    
  
}
else
{
    header("location: ../uploadmusic.php");
    exit();
}