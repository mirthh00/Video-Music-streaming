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
    header("location: ../uploadmusic.php?error=noexistingaccount");
    exit();
}
if($row["catagory"]!="Music"){
    header("location: ../uploadmusic.php?error=youraccountcannotuploadmusic");
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
    $albumcoverName=$_FILES['albumcover']['name'];
    $albumcoverSize=$_FILES['albumcover']['size'];
    $albumcoverTmpName=$_FILES['albumcover']['tmp_name'];

    $songext = end((explode(".", $songName))); # extra () to prevent notice
    echo $songext;

    if($songext != "mp3"){
        header("location: ../upload.php?e=sew");
        exit();
    }

    $covext = end((explode(".", $coverName))); # extra () to prevent notice
    echo $covext;

    if($covext != "jpg"){
        header("location: ../upload.php?e=scew");
        exit();
    }

    $alcovext = end((explode(".", $albumcoverName))); # extra () to prevent notice
    echo $alcovext;

    if($alcovext != "jpg"){
        header("location: ../upload.php?e=acew");
        exit();
    }
    
    $sql5="SELECT * FROM albums WHERE  uploader=? AND albumtitle=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql5)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$accountname,$albumtitle);
    mysqli_stmt_execute($stmt);
    $result5=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum5=mysqli_num_rows($result5);
    $sql4 = "SELECT * FROM music;";
    $result4=mysqli_query($conn,$sql4);
    $rownum4=mysqli_num_rows($result4);
    $uniqueid=$rownum4+1;
    include 'functions.inc.php';
    if ($rownum5==0) {
        if($albumcoverName!=""){
            uploadalbum($conn,$albumtitle,$albumcoverName,$accountname,$albumcoverSize,$albumcoverTmpName);
        }
        
    }
    uploadmusic($conn,$uniqueid,$accountname,$songtitle,$artists,$songName,
    $songSize,$songTmpName,$coverName,$coverSize,$coverTmpName,$accountid,$uploadedtime,$genre,$streams,
    $uploaderprofile,$albumtitle,$albumcoverName,$albumcoverSize,$albumcoverTmpName);
    
  
}
else
{
    header("location: ../uploadmusic.php");
    exit();
}