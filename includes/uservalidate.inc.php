<?php
include 'dbh.inc.php';
 if (isset($_POST["submit"])){

     $value=mysqli_real_escape_string($conn,$_POST["code"]);
     
         $sql="SELECT * FROM users WHERE validator=?;";
         $stmt=mysqli_stmt_init($conn);

         if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
         }

         mysqli_stmt_bind_param($stmt,"s",$value);
         mysqli_stmt_execute($stmt);
         $data=mysqli_stmt_get_result($stmt);
         mysqli_stmt_close($stmt);
         $rownum=mysqli_num_rows($data);
     if ($rownum==1){
        header("location: ../login.php");
        exit();
     }
     else{
        header("location: ../uservalidate.php");
     }
 }
