<?php
    session_start();

?>
<?php
if(isset($_SESSION["username"])){
    require_once "functions.inc.php";
}
else{
    header("location: ../login.php");
    exit();
}

   
    include 'contentdatabase.inc.php';
    $ID=mysqli_real_escape_string($conn,$_POST["watch"]);
  
    $sql14="SELECT * FROM likedvideos  WHERE  videoid=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql14)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$ID);
    mysqli_stmt_execute($stmt);
    $result14=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $likes=mysqli_num_rows($result14);

    echo '<p id="likescount" class="unlockers">'.$likes.' Hearts</p>';