<?php
session_start();
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}
?>

<?php

include 'includes/functions.inc.php';
include 'includes/accountdatabase.inc.php';
if (isset($_POST["query"])){
$search = mysqli_real_escape_string($conn,$_POST["query"]);


$userid=$_SESSION["userid"];
$catagory="Series";
$sql5="SELECT * FROM unlockedaccounts WHERE userid=? AND catagory=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql5)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"ss",$userid,$catagory);
mysqli_stmt_execute($stmt);
$data1=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum4=mysqli_num_rows($data1);

if($rownum4>0)

{

    while($row5=mysqli_fetch_assoc($data1)){
        include "includes/contentdatabase.inc.php";
        $fullname=$row5["accountname"];
        $sql4="SELECT * FROM videos WHERE  uploader=? AND videotitle LIKE CONCAT('%',?,'%') ORDER BY id DESC ;";
        $stmt=mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql4)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt,"ss",$fullname,$search);
        mysqli_stmt_execute($stmt);
        $result4=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
       
        $rownum3=mysqli_num_rows($result4);
        
            if($rownum3>0)
            {
                while( $row4=mysqli_fetch_assoc($result4))
                {
                    $views=$row4["views"];
                            $views = currencyFormat($views);
                    $time=$row4["uploadedtime"];
                    $currenttime=uploadedtime($time);
                    include "includes/accountdatabase.inc.php";
                            $sql8="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql8)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_bind_param($stmt,"s",$row4["uploader"]);
                            mysqli_stmt_execute($stmt);
                            $result8=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row8=mysqli_fetch_assoc($result8);
                            
                            include "includes/contentdatabase.inc.php";
                    echo '
                    <div class="video">
                            <form action="includes/views.inc.php" method="POST">
                            <input type="hidden" value="'.$row4["uniqueid"].'" name="uniqueid">
                            <input type="image" src="content/videos/thumbnails/'.$row8["directoryname"].'/'.$row4["thumbnail"].'" class="thumbnail" name="thumbnail" title="Watch '.$row4["videotitle"].'">
                            </form>
                            <p class="videodescription">'.$row4["videotitle"].'
                            </p>
                            <div class="videodetails flex-div">
                                <a href="account.php?ID='.$row8["id"].'"><img src="profilepictures/'.$row5["profileimage"].'" class="accounticon"></a>
                                <div class="videoinfo">
                                <div class="verify">
                                <p class="videoviews" id="time" title="'.$row4["uploader"].'"> <a href="account.php?ID='.$row8["id"].'">'.$row4["uploader"].'<img src="images/check.png" alt=""></a></p>
                                </div>
                                    <p class="videoviews" id="time">'.$views.' Views &bullet; '.$currenttime.'</p>
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
        }
}



}
?>