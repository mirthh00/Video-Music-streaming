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
include "accountdatabase.inc.php";
    $roomid=mysqli_real_escape_string($conn,$_POST["roomid"]);
    $message=mysqli_real_escape_string($conn,$_POST["message"]);
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $messagetime=mysqli_real_escape_string($conn,$_POST["messagetime"]);
    $fullname=$_SESSION["fullname"];
    

                    $sql6="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                    $stmt=mysqli_stmt_init($conn);
    
                    if(!mysqli_stmt_prepare($stmt,$sql6)){
                             header("location: ../signup.php?error=stmtfailed");
                    exit();
                    }
    
                    mysqli_stmt_bind_param($stmt,"s",$username);
                    mysqli_stmt_execute($stmt);
                    $result6=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row6=mysqli_fetch_assoc($result6);
                    $rownum6=mysqli_num_rows($result6);

                    $sql7="SELECT * FROM rooms WHERE  roomid=?;";
                    $stmt=mysqli_stmt_init($conn);
    
                    if(!mysqli_stmt_prepare($stmt,$sql7)){
                             header("location: ../signup.php?error=stmtfailed");
                    exit();
                    }
    
                    mysqli_stmt_bind_param($stmt,"s",$roomid);
                    mysqli_stmt_execute($stmt);
                    $result7=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row7=mysqli_fetch_assoc($result7);
                    $status='Online';
                    $sql7="SELECT * FROM unlockedaccounts WHERE  accountname=? AND status=?;";
                    $stmt=mysqli_stmt_init($conn);
    
                    if(!mysqli_stmt_prepare($stmt,$sql7)){
                             header("location: ../signup.php?error=stmtfailed");
                    exit();
                    }
    
                    mysqli_stmt_bind_param($stmt,"ss",$row7["roomname"],$status);
                    mysqli_stmt_execute($stmt);
                    $result7=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    while ($row7=mysqli_fetch_assoc($result7)) {
                        include "contentdatabase.inc.php";
                        $sql8="INSERT INTO readchats(chat,roomid,readby) VALUES (?,?,?);";
                        $stmt=mysqli_stmt_init($conn);
                
                        if(!mysqli_stmt_prepare($stmt,$sql8)){
                            header("location: ../signup.php?error=stmtfailed");
                            exit();
                        }
                
                        mysqli_stmt_bind_param($stmt, "sss",$message,$roomid,$row7["username"]);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                    }
                    

    if($rownum6>0)
    {
        
        $imagename=$row6["profileimage"];
        include "contentdatabase.inc.php";
        include "functions.inc.php";
        chat($conn,$roomid,$message,$messagetime,$username,$imagename);
        exit();
    }
    else{
        include "dbh.inc.php";
        $sql4="SELECT * FROM users WHERE  usersUid=?;";
        $stmt=mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt,$sql4)){
                 header("location: ../signup.php?error=stmtfailed");
        exit();
        }
    
        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        $result4=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row4=mysqli_fetch_assoc($result4);
        $rownum4=mysqli_num_rows($result4);
        $imagename=$row4["usersImage"];
        include "contentdatabase.inc.php";
        include "functions.inc.php";
        chat($conn,$roomid,$message,$messagetime,$username,$imagename);
        exit();
    }


