<?php

include 'includes/contentdatabase.inc.php';
    $sql14="SELECT * FROM likedvideos  WHERE  videoid=?;";
    $stmt=mysqli_stmt_init($conn);
                               
    if(!mysqli_stmt_prepare($stmt,$sql14)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$vidid);
    mysqli_stmt_execute($stmt);
    $result14=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $likes=mysqli_num_rows($result14);