<?php
require 'dbh.inc.php';
if(isset($_POST["submit"]))
{
    $selector=mysqli_real_escape_string($conn,$_POST["selector"]);
    $validator=mysqli_real_escape_string($conn,$_POST["validator"]);
    $password=mysqli_real_escape_string($conn,$_POST["password"]);
    $password2=mysqli_real_escape_string($conn,$_POST["password2"]);

    if(empty($password) || empty($password2))
    {
        header("location: ../login.php");
        exit();
    }

    else if($password!=$password2)
    {
        header("location: ../login.php");
        exit();
    }

    $currentDate=date("U");
    

    $sql = "SELECT * FROM passwordreset WHERE passwordResetSelector=? AND passwordResetExpires>=$currentDate;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        echo "An error occured!!!";
        exit();

    }

    else{
            mysqli_stmt_bind_param($stmt,"s",$selector);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if(!$row = mysqli_fetch_assoc($result))
            {
                echo "An error occured submit your reset request again!";
                exit();
            }
            else
            {
                $tokenBin=hex2bin($validator);
                $tokenCheck=password_verify($tokenBin,$row["passwordResetToken"]);

                if($tokenCheck === false)
                {
                    echo "An error occured submit your reset request again!";
                    exit();
                }
                else if($tokenCheck===true)
                {
                    $tokenEmail=$row["passwordResetEmail"];
                    $sql = "SELECT * FROM users WHERE usersEmail=?;";
                    $stmt = mysqli_stmt_init($conn);

                     if(!mysqli_stmt_prepare($stmt,$sql))
                     {
                     echo "An error occured!!!";
                     exit();

                     }

                    else{
                         mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                         mysqli_stmt_execute($stmt);
                         $result = mysqli_stmt_get_result($stmt);
                         if(!$row = mysqli_fetch_assoc($result))
                         {
                             echo "An error occured!";
                             exit();
                         }
                         else
                         {
                            $sql = "UPDATE users SET usersPwd=? WHERE usersEmail=?;";
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql))
                            {
                                echo "An error occured!!!";
                                exit();
                        
                            }
                        
                            else{
                                    $newpasswordhashed=password_hash($password, PASSWORD_DEFAULT);
                                    mysqli_stmt_bind_param($stmt,"ss",$newpasswordhashed,$tokenEmail);
                                    mysqli_stmt_execute($stmt);

                                    $sql="DELETE FROM passwordreset WHERE passwordResetEmail=?;";
                                    $stmt = mysqli_stmt_init($conn);

                                        if(!mysqli_stmt_prepare($stmt,$sql))
                                        {
                                         echo "An error occured!!!";
                                            exit();

                                     }

                                        else{
                                                mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                                                mysqli_stmt_execute($stmt);
                                                header("location: ../login.php?report=passwordupdated");

                                     }
                        
                            }
                         }
                         }
                }
            }

    }
}
else
{

    header("location: ../login.php");
    exit();
}