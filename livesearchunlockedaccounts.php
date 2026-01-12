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

include 'includes/accountdatabase.inc.php';
if(isset($_POST["query"])){
    $search = mysqli_real_escape_string($conn,$_POST["query"]);
    
$sql="SELECT * FROM unlockedaccounts WHERE  accountname LIKE CONCAT('%',?,'%') AND  username=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"ss",$search,$_SESSION["username"]);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum=mysqli_num_rows($data);


if($rownum>0)
        {
            while($row=mysqli_fetch_assoc($data)){
                include 'includes/accountdatabase.inc.php';
                $accountname=$row["accountname"];
                $sql13="SELECT * FROM unlockedaccounts WHERE  accountname=?;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql13)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt,"s",$accountname,);
                mysqli_stmt_execute($stmt);
                $result13=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                $rownum13=mysqli_num_rows($result13);

                $sql15="SELECT * FROM intellipreneurs WHERE accountname=?;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql15)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt,"s",$accountname);
                mysqli_stmt_execute($stmt);
                $result15=mysqli_stmt_get_result($stmt);
                $row15=mysqli_fetch_assoc($result15);
                mysqli_stmt_close($stmt);
                
                include 'includes/contentdatabase.inc.php';

                $sql14="SELECT * FROM ratings WHERE accountname=?;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql14)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt,"s",$accountname);
                mysqli_stmt_execute($stmt);
                $result14=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                $rownum14=mysqli_num_rows($result14);
                $star1=0;
                $star2=0;
                $star3=0;
                $star4=0;
                $star5=0;
                $rownum15=$rownum14;
                if($rownum14 > 0){
                    while($row14=mysqli_fetch_assoc($result14)){
                        if($row14["rating"]==1){
                            $star1++;
                        }
                        elseif ($row14["rating"]==2) {
                            $star2++;
                        }
                        elseif ($row14["rating"]==3) {
                            $star3++;
                        }
                        elseif ($row14["rating"]==4) {
                            $star4++;
                        }
                        elseif ($row14["rating"]==5) {
                            $star5++;
                        }
                    }
                    
                }
                
                echo '
                <div class="chatbox">
                <div class="room">
                <img class="ipaccountverify" src="profilepictures/'.$row["profileimage"].'">
                <div class="r">
                    <p class="accountname">'.$accountname.'<img class="roomverify" src="images/check.png" alt=""></p>
                    ';
                    echo '<p class="un">Uploads '.$row15["uploads"].' times per month on '.$row15['uploadays'].' at '.$row15["uploadtime"].' '.$row15["timezone"].' </p>
                    </div>
                </div>';
                if($rownum14>0){
                if($star5>$star4 && $star5>$star3 && $star5>$star2 && $star5>$star1){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> </p>';
                }

                elseif($star4>$star5 && $star4>$star3 && $star4>$star2 && $star4>$star1){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> </p>';
                }

                elseif($star3>$star5 && $star3>$star4 && $star3>$star2 && $star3>$star1){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> </p>';
                }

                elseif($star2>$star5 && $star2>$star4 && $star2>$star3 && $star2>$star1){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> </p>';
                }

                elseif($star1>$star5 && $star1>$star4 && $star1>$star3 && $star1>$star2){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> </p>';
                }
                else{
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; equal rating </p>';
                }

            }
            else{
                echo '<p class="chat">'.$rownum13.' Unlockers &bullet; no rating yet </p>';
            }
                
                echo'
                <div class="unlockbtn">
                <a href="account.php?ID='.$row15["id"].'"><button>Open</button></a>
                </div>
                </div>
            ';
                
                }
        }
        else{
            echo '
            <div class="thirdbanner">
            <h1>We cannot find the account you are searching for!</h1>
            </div>
            ';
        }
}

        ?>