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
if(isset($_GET["a"])){

    include 'includes/accountdatabase.inc.php';
    $accountid=mysqli_real_escape_string($conn,$_GET["a"]);

    $sql="SELECT * FROM intellipreneurs WHERE id=$accountid;";
    $data=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($data);

    $accountname=$row["accountname"];
    $catagory=$row["catagory"];
    $profileimage=$row["profileimage"];
    
    featured($conn,$accountname,$catagory,$profileimage,$accountid);
}