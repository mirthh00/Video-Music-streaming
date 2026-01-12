<?php
session_start();
?>
<?php
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}
?>

<?php
if(isset($_GET["v"])){
    include 'includes/contentdatabase.inc.php';
    $uniqueid=mysqli_real_escape_string($conn,$_GET["v"]);
}
if(isset($_GET["a"]))
{
    $theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
    }
    else{
        $color="dark-theme";
    }
    include 'includes/accountdatabase.inc.php';
   
    $accountid=mysqli_real_escape_string($conn,$_GET["a"]);
    
    $sql="SELECT * FROM intellipreneurs WHERE id=$accountid;";
    $data=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($data);
    $sql2="SELECT * FROM unlockedaccounts WHERE accountid=$accountid;";
    $data2=mysqli_query($conn,$sql2);
    $row2=mysqli_num_rows($data2);
 
    include 'includes/contentdatabase.inc.php';
    
    $sql16="SELECT * FROM videos WHERE uniqueid='$uniqueid';";
    $data16=mysqli_query($conn,$sql16);
    $row16=mysqli_fetch_assoc($data16);

    $thumbnail=$row16["thumbnail"];
    $videotitle=$row16["videotitle"];
    $uploader=$row16["uploader"];
    $genre=$row16["genre"];
    $directoryname=$row["directoryname"];

    boost($conn,$uniqueid,$thumbnail,$videotitle,$uploader,$genre,$directoryname,$accountid);   
}

    

?>
