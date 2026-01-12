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
include 'includes/functions.inc.php';
if(isset($_POST["query"])){
                $search = mysqli_real_escape_string($conn,$_POST["query"]);
                
                $useremail=$_SESSION["useremail"];
                $username=$_SESSION["username"];
                $sql="SELECT * FROM unlockedrooms WHERE roomname LIKE CONCAT('%',?,'%') AND  unlockeremail=?;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql)){
                         header("location: ../signup.php?error=stmtfailed");
                exit();
                }

                mysqli_stmt_bind_param($stmt,"ss",$search,$useremail);
                mysqli_stmt_execute($stmt);
                $data=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                $rownum=mysqli_num_rows($data);



                if($rownum>0)
                {
                while($row=mysqli_fetch_assoc($data)){
                        $sql2="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                        $stmt=mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt,$sql2)){
                            header("location: ../signup.php?error=stmtfailed");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt,"s",$row["roomname"]);
                        mysqli_stmt_execute($stmt);
                        $result2=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
       
                        $rownum2=mysqli_num_rows($result2);
                        while($row2=mysqli_fetch_assoc($result2)){
                            include 'includes/contentdatabase.inc.php';
                            $sql3="SELECT * FROM chats WHERE roomid=? ORDER BY id DESC;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql3)){
                                 header("location: ../signup.php?error=stmtfailed");
                        exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"s",$row["roomid"]);
                        mysqli_stmt_execute($stmt);
                        $result3=mysqli_stmt_get_result($stmt);
                        $row3=mysqli_fetch_assoc($result3);
                        $rownum3=mysqli_num_rows($result3);
                        mysqli_stmt_close($stmt);
        
                        $roomid=$row["roomid"];
                        if($rownum3>0){
                        $sql4="SELECT * FROM chats WHERE roomid='$roomid';";
                        $query=mysqli_query($conn,$sql4);
        
                        $time=uploadedtime($row3["messagetime"]);
        
                        $count=mysqli_num_rows($query);
                        $sql4="SELECT * FROM readchats WHERE roomid='$roomid' AND readby='$username';";
                        $query1=mysqli_query($conn,$sql4);
                        $count1=mysqli_num_rows($query1);
                        $totalcount = $count - $count1;
                        include 'includes/accountdatabase.inc.php';
                            echo '
                            <div class="chatbox">
                            <div class="room">
                            <a href="fansroom.php?r='.$row["roomid"].'"><img class="ipaccountverify" src="profilepictures/'.$row2["profileimage"].'"></a>
                            <a href="fansroom.php?r='.$row["roomid"].'"><p class="roomname">'.$row["roomname"].'<img class="roomverify" src="images/check.png" alt=""></p></a>
                            </div>
                            <p class="chat">'.$row3["chat"].'</p>
                            ';
                            if($row3["username"]===$row["roomname"]){
        
                            echo'
                            <div class="unlockbtn">
                    <a href="fansroom.php?r='.$row["roomid"].'"><button>Open</button></a>
                    </div>
                            <p class="chattime">'.$time.' &bullet; from admin &bullet; <b>'.$totalcount.' new messages</b></p>
                            </div>
                        ';
                            }
                            else {
                                echo'
                                <div class="unlockbtn">
                    <a href="fansroom.php?r='.$row["roomid"].'"><button>Open</button></a>
                    </div>
                                <p class="chattime">'.$time.' &bullet; from '.$row3["username"].' &bullet; <b>'.$totalcount.' new messages</b></p>
                                </div>
                            ';
                            }
                        }
                        else{
                            echo '
                            <div class="chatbox">
                            <div class="room">
                            <a href="fansroom.php?r='.$row["roomid"].'"><img class="ipaccountverify" src="profilepictures/'.$row2["profileimage"].'"></a>
                            <a href="fansroom.php?r='.$row["roomid"].'"><p class="roomname">'.$row["roomname"].'<img class="roomverify" src="images/check.png" alt=""></p></a>
                            </div>
                            <div class="unlockbtn">
                    <a href="fansroom.php?r='.$row["roomid"].'"><button>Open</button></a>
                    </div>
                            <p class="chat">No chats yet,enter to start a conversation.</p>
                            </div>
                            ';
                        }
                        }
                    }
                }
                else{
                    echo '
                    <div class="thirdbanner">
                    <h1>We cannot find the room you are searching for!</h1>
                    </div>
                    ';
                    }
}

        ?>