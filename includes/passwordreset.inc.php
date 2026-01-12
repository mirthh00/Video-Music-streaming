<?php

if(isset($_POST["submit"]))
{
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "localhost/Mirth/passwordreset.php?selector=". $selector ."&validator=". bin2hex($token);

    $expires = date("U") + 1800;

    require 'dbh.inc.php';

    $userEmail=mysqli_real_escape_string($conn,$_POST["email"]);

    $sql="DELETE FROM passwordreset WHERE passwordResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        echo "An error occured!!!";
        exit();

    }

    else{
            mysqli_stmt_bind_param($stmt,"s",$userEmail);
            mysqli_stmt_execute($stmt);

    }

    $sql = "INSERT INTO passwordreset(passwordResetEmail,passwordResetSelector,passwordResetToken,passwordResetExpires) VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        echo "An error occured!!!";
        exit();

    }

    else{
            $hashedToken=password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selector,$hashedToken,$expires);
            mysqli_stmt_execute($stmt);

    }
    mysqli_stmt_close($stmt);
    require 'functions.inc.php';
    sendPasswordMail($userEmail,$url);
    header("location: ../password.php?report=success");

}


else
{
    header("location: ../password.php");
    exit();
}