<?php
    session_start();
    date_default_timezone_set("Africa/Johannesburg");
?>
<?php
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}
$userfullname=$_SESSION["fullname"];
$onlineusername=$_SESSION["username"];
$musicArray=array();
$counter=0;
$counterb=0;
?>
<?php
    if(isset($_GET["r"])){
        $theme=$_SESSION["theme"];
if($theme == 'light'){
    $color="white-theme";
}
else{
    $color="dark-theme";
}
        include "includes/accountdatabase.inc.php";
        $roomid=mysqli_real_escape_string($conn,$_GET["r"]);
        $sql="SELECT * FROM rooms WHERE  roomid=?;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
                 header("location: ../signup.php?error=stmtfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$roomid);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row=mysqli_fetch_assoc($result);
        $rownum=mysqli_num_rows($result);

        
        $roomname=$row["roomname"];

        $status="Online";
        $username1=$_SESSION["username"];
       
        $sql15="UPDATE unlockedaccounts SET status='$status' WHERE username='$username1' AND accountname='$roomname';";
        mysqli_query($conn,$sql15);
        

        $sql2="SELECT * FROM intellipreneurs WHERE  accountname=?;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql2)){
                 header("location: ../signup.php?error=stmtfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$roomname);
        mysqli_stmt_execute($stmt);
        $result2=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row2=mysqli_fetch_assoc($result2);
        $rownum2=mysqli_num_rows($result2);

        $sql6="SELECT * FROM intellipreneurs WHERE  accountholder=?;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql6)){
                 header("location: ../signup.php?error=stmtfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$userfullname);
        mysqli_stmt_execute($stmt);
        $result6=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row6=mysqli_fetch_assoc($result6);
        $rownum6=mysqli_num_rows($result6);
        if($rownum6>0){
            $username=$row6["accountname"];
        }
        else{
            $username=$_SESSION["username"];
        }

        $sql5="SELECT * FROM unlockedaccounts WHERE  accountname=?;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql5)){
                 header("location: ../signup.php?error=stmtfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$roomname);
        mysqli_stmt_execute($stmt);
        $result5=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row5=mysqli_fetch_assoc($result5);
        $rownum5=mysqli_num_rows($result5);
        $rownum5 = currencyFormat($rownum5);
        $status="Online";
        $sql14="SELECT * FROM unlockedaccounts WHERE  accountname=? AND status=?;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql14)){
                 header("location: ../signup.php?error=stmtfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt,"ss",$roomname,$status);
        mysqli_stmt_execute($stmt);
        $result14=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row14=mysqli_fetch_assoc($result14);
        $rownum14=mysqli_num_rows($result14);
        $rownum14 = currencyFormat($rownum14);
        $userid=$_SESSION["userid"];
        $catagory="Music";
        $sql7="SELECT * FROM unlockedaccounts WHERE userid=? AND catagory=?;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql7)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ss",$userid,$catagory);
        mysqli_stmt_execute($stmt);
        $data7=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $rownum7=mysqli_num_rows($data7);
        include "includes/contentdatabase.inc.php";
        
        
       if($rownum7>0){

        while ($row7=mysqli_fetch_assoc($data7)) {
            $uploader=$row7["accountname"];
            $sql8="SELECT * FROM music WHERE  uploader=? ORDER BY id DESC;";
            $stmt=mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql8)){
                header("location: ../signup.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt,"s",$uploader);
            mysqli_stmt_execute($stmt);
            $result8=mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            $rownum8=mysqli_num_rows($result8);
            $rownum13=mysqli_num_rows($result8);
            if($rownum8>0){
            while ($row8=mysqli_fetch_assoc($result8)) {
                array_push($musicArray,$row8["song"]);
                $counter++;
            }
            $music=$musicArray[0];
        }
        
    }
}
else{
    $rownum13=0;
}
        $sql10="SELECT * FROM polls WHERE  roomid=? ORDER BY id DESC;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql10)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                }

                mysqli_stmt_bind_param($stmt,"s",$roomid);
                mysqli_stmt_execute($stmt);
                $result10=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                $row10=mysqli_fetch_assoc($result10);
                $rownum10=mysqli_num_rows($result10);

                if($rownum10>0)
                {
                $pollid=$row10["id"];

                $pollstatement=$row10["pollstatement"];
                $option1=$row10["option1"];
                $option2=$row10["option2"];
                $option3=$row10["option3"];
                $option4=$row10["option4"];
                $option5=$row10["option5"];
                $option6=$row10["option6"];
                $option7=$row10["option7"];
                $option8=$row10["option8"];
                $option9=$row10["option9"];
                $option10=$row10["option10"];

                $unlockdate=$row10["createdat"];
    $accountexpirydate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($unlockdate))." + 1 day"));
    $currentdate=date("Y-m-d");
    if($currentdate>=$accountexpirydate){
        $sql13="DELETE FROM polls WHERE roomid=? AND id=?;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql13)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ss",$roomid,$pollid);
        mysqli_stmt_execute($stmt);
        $data13=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        $sql13="DELETE FROM votes WHERE roomid=? AND pollid=?;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql13)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ss",$roomid,$pollid);
        mysqli_stmt_execute($stmt);
        $data13=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row["roomname"]; ?> Fansroom</title>
    <meta lang="en" charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="profilepictures/<?php echo $row2["profileimage"];?>">
    <link href="css/room/room.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
    </style>
    
</head>
<body class="<?php echo "$color";?>">
    
        <nav>
        <div class="center">
        <img src="profilepictures/<?php echo $row2["profileimage"]; ?>">
        </div>
       
    
    <div class="roomname center ">
        <h1 class="text"><?php echo $row["roomname"]; ?></h1>
        <img src="images/check.png" alt="">
    </div>
    <div class="memberscount center">
        <p class="members text"><?php echo "$rownum5"; ?> Members</p>
        <p class="active">&bullet; </p>
        <p class="members text"><?php echo "$rownum14"; ?> Online</p>
        <p class="online">&bullet; </p>
        <a href="offroom.php?rm=<?php echo $row["roomname"]; ?>" class="off"><p class="members text">Go Offline</p></a>
        <p class="offline">&bullet; </p>
    </div>
    <?php
    if($rownum13>0)
    {
    ?>
    <div class="player">
    <i id="back" class="fa-solid fa-backward-step"></i>
    <i id="masterPlay" class="fa-solid fa-play"></i>
    <i id="next" class="fa-solid fa-forward-step"></i>
    <i id="repeat" class="bi bi-repeat"></i>
    </div>
    <?php
    }
    else{
    
        ?>
        <marquee>Unlock Music Accounts To Play Music While Chatting!</marquee>
           <?php
    }
 
    ?>
      </nav>
    
    <div class="roomspace">
    <div id="create-poll-container" class="create-poll-container">
            <div class="poll">
                
                <div class="p">
                <h2 class="poll-statement">Create Your Poll Today!</h2>
               <form action="includes/poll.inc.php" method="post">
                <p class="poll-statement">Poll Statement:</p>
                <input type="text" name="pollstatement" id="" class="input-box" placeholder="Type Your Poll Statement">
                <p class="poll-statement">Poll Options:</p>
                <p class="poll-statement">fill in only the options you want and ignore remaning ones.</p>

                <p class="poll-statement">Option 1:</p>
                <input type="text" name="option1" id="" class="input-box" placeholder="Type Your First Option">

                <p class="poll-statement">Option 2:</p>
                <input type="text" name="option2" id="" class="input-box" placeholder="Type Your Second Option">

                <p class="poll-statement">Option 3:</p>
                <input type="text" name="option3" id="" class="input-box" placeholder="Type Your Third Option">

                <p class="poll-statement">Option 4:</p>
                <input type="text" name="option4" id="" class="input-box" placeholder="Type Your Forth Option">

                <p class="poll-statement">Option 5:</p>
                <input type="text" name="option5" id="" class="input-box" placeholder="Type Your Fifth Option">

                <p class="poll-statement">Option 6:</p>
                <input type="text" name="option6" id="" class="input-box" placeholder="Type Your Sixth Option">

                <p class="poll-statement">Option 7:</p>
                <input type="text" name="option7" id="" class="input-box" placeholder="Type Your Seventh Option">

                <p class="poll-statement">Option 8:</p>
                <input type="text" name="option8" id="" class="input-box" placeholder="Type Your Eighth Option">

                <p class="poll-statement">Option 9:</p>
                <input type="text" name="option9" id="" class="input-box" placeholder="Type Your Nineth Option">

                <p class="poll-statement">Option 10:</p>
                <input type="text" name="option10" id="" class="input-box" placeholder="Type Your Tenth Option">
                <input type="hidden" name="roomid" value="<?php echo "$roomid"; ?>">
               <button type="submit" class="sp" name="submit">
                    <p class="poll-option">CREATE!</p>
                </button>
               </form>
                </div>
            </div>
        </div>
        <div id="poll-container" class="poll-container">
            <div class="poll">
                
                <div class="p">
                <p class="poll-statement"><?php echo "$pollstatement"; ?></p>
                <?php 
                     $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                     $stmt=mysqli_stmt_init($conn);
     
                     if(!mysqli_stmt_prepare($stmt,$sql12)){
                             header("location: ../signup.php?error=stmtfailed");
                             exit();
                     }
     
                     mysqli_stmt_bind_param($stmt,"ss",$roomid,$option1);
                     mysqli_stmt_execute($stmt);
                     $result12=mysqli_stmt_get_result($stmt);
                     mysqli_stmt_close($stmt);
                     $rownum12=mysqli_num_rows($result12);

                     $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                     $stmt=mysqli_stmt_init($conn);
     
                     if(!mysqli_stmt_prepare($stmt,$sql11)){
                             header("location: ../signup.php?error=stmtfailed");
                             exit();
                     }
     
                     mysqli_stmt_bind_param($stmt,"sss",$roomid,$option1,$onlineusername);
                     mysqli_stmt_execute($stmt);
                     $result11=mysqli_stmt_get_result($stmt);
                     mysqli_stmt_close($stmt);
                     $row11=mysqli_fetch_assoc($result11);
                     $rownum11=mysqli_num_rows($result11);
                     if($rownum11>0){
                        echo '
                        <form action="includes/vote.inc.php" method="post">
                <input type="hidden" name="roomid" value="'.$roomid.'">
                <input type="hidden" name="pollid" value="'.$pollid.'">
                <input type="hidden" name="optionid" value="'.$option1.'">
               <button type="submit" name="submit" class="sp selected">
                    <p class="poll-option">'.$option1.'</p>
                    <p>'.$rownum12.' votes</p>
                </button>
               </form>';
                     }
                     else{
                        echo '
                        <form action="includes/vote.inc.php" method="post">
                        <input type="hidden" name="roomid" value="'.$roomid.'">
                        <input type="hidden" name="pollid" value="'.$pollid.'">
                        <input type="hidden" name="optionid" value="'.$option1.'">
                       <button type="submit" name="submit" class="sp">
                            <p class="poll-option">'.$option1.'</p>
                            <p>'.$rownum12.' votes</p>
                        </button>
                       </form>';
                     }
                     $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                     $stmt=mysqli_stmt_init($conn);
     
                     if(!mysqli_stmt_prepare($stmt,$sql12)){
                             header("location: ../signup.php?error=stmtfailed");
                             exit();
                     }
     
                     mysqli_stmt_bind_param($stmt,"ss",$roomid,$option2);
                     mysqli_stmt_execute($stmt);
                     $result12=mysqli_stmt_get_result($stmt);
                     mysqli_stmt_close($stmt);
                     $rownum12=mysqli_num_rows($result12);
                     $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                     $stmt=mysqli_stmt_init($conn);
     
                     if(!mysqli_stmt_prepare($stmt,$sql11)){
                             header("location: ../signup.php?error=stmtfailed");
                             exit();
                     }
     
                     mysqli_stmt_bind_param($stmt,"sss",$roomid,$option2,$onlineusername);
                     mysqli_stmt_execute($stmt);
                     $result11=mysqli_stmt_get_result($stmt);
                     mysqli_stmt_close($stmt);
                     $row11=mysqli_fetch_assoc($result11);
                     $rownum11=mysqli_num_rows($result11);
                     if($rownum11>0){
                        echo '
                        <form action="includes/vote.inc.php" method="post">
                <input type="hidden" name="roomid" value="'.$roomid.'">
                <input type="hidden" name="pollid" value="'.$pollid.'">
                <input type="hidden" name="optionid" value="'.$option2.'">
               <button type="submit" name="submit" class="sp selected">
                    <p class="poll-option">'.$option2.'</p>
                    <p>'.$rownum12.' votes</p>
                </button>
               </form>';
                     }
                     else{
                        echo '
                        <form action="includes/vote.inc.php" method="post">
                        <input type="hidden" name="roomid" value="'.$roomid.'">
                        <input type="hidden" name="pollid" value="'.$pollid.'">
                        <input type="hidden" name="optionid" value="'.$option2.'">
                       <button type="submit" name="submit" class="sp">
                            <p class="poll-option">'.$option2.'</p>
                            <p>'.$rownum12.' votes</p>
                        </button>
                       </form>';
                     }
               
               
            
                    if(!empty($option3)){

                        $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql12)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"ss",$roomid,$option3);
                        mysqli_stmt_execute($stmt);
                        $result12=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum12=mysqli_num_rows($result12);

                        $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql11)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"sss",$roomid,$option3,$onlineusername);
                        mysqli_stmt_execute($stmt);
                        $result11=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row11=mysqli_fetch_assoc($result11);
                        $rownum11=mysqli_num_rows($result11);
                        if($rownum11>0){
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                   <input type="hidden" name="roomid" value="'.$roomid.'">
                   <input type="hidden" name="pollid" value="'.$pollid.'">
                   <input type="hidden" name="optionid" value="'.$option3.'">
                  <button type="submit" name="submit" class="sp selected">
                       <p class="poll-option">'.$option3.'</p>
                       <p>'.$rownum12.' votes</p>
                   </button>
                  </form>';
                        }
                        else{
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                           <input type="hidden" name="roomid" value="'.$roomid.'">
                           <input type="hidden" name="pollid" value="'.$pollid.'">
                           <input type="hidden" name="optionid" value="'.$option3.'">
                          <button type="submit" name="submit" class="sp">
                               <p class="poll-option">'.$option3.'</p>
                               <p>'.$rownum12.' votes</p>
                           </button>
                          </form>';
                        }
                    }
               ?>
               <?php
                    if(!empty($option4)){
                        $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql12)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"ss",$roomid,$option4);
                        mysqli_stmt_execute($stmt);
                        $result12=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum12=mysqli_num_rows($result12);
                        $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql11)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"sss",$roomid,$option4,$onlineusername);
                        mysqli_stmt_execute($stmt);
                        $result11=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row11=mysqli_fetch_assoc($result11);
                        $rownum11=mysqli_num_rows($result11);
                        if($rownum11>0){
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                   <input type="hidden" name="roomid" value="'.$roomid.'">
                   <input type="hidden" name="pollid" value="'.$pollid.'">
                   <input type="hidden" name="optionid" value="'.$option4.'">
                  <button type="submit" name="submit" class="sp selected">
                       <p class="poll-option">'.$option4.'</p>
                       <p>'.$rownum12.' votes</p>
                   </button>
                  </form>';
                        }
                        else{
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                           <input type="hidden" name="roomid" value="'.$roomid.'">
                           <input type="hidden" name="pollid" value="'.$pollid.'">
                           <input type="hidden" name="optionid" value="'.$option4.'">
                          <button type="submit" name="submit" class="sp">
                               <p class="poll-option">'.$option4.'</p>
                               <p>'.$rownum12.' votes</p>
                           </button>
                          </form>';
                        }
                    }
               ?>
               <?php
                    if(!empty($option5)){
                        $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql12)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"ss",$roomid,$option5);
                        mysqli_stmt_execute($stmt);
                        $result12=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum12=mysqli_num_rows($result12);
                        $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql11)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"sss",$roomid,$option5,$onlineusername);
                        mysqli_stmt_execute($stmt);
                        $result11=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row11=mysqli_fetch_assoc($result11);
                        $rownum11=mysqli_num_rows($result11);
                        if($rownum11>0){
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                   <input type="hidden" name="roomid" value="'.$roomid.'">
                   <input type="hidden" name="pollid" value="'.$pollid.'">
                   <input type="hidden" name="optionid" value="'.$option5.'">
                  <button type="submit" name="submit" class="sp selected">
                       <p class="poll-option">'.$option5.'</p>
                       <p>'.$rownum12.' votes</p>
                   </button>
                  </form>';
                        }
                        else{
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                           <input type="hidden" name="roomid" value="'.$roomid.'">
                           <input type="hidden" name="pollid" value="'.$pollid.'">
                           <input type="hidden" name="optionid" value="'.$option5.'">
                          <button type="submit" name="submit" class="sp">
                               <p class="poll-option">'.$option5.'</p>
                               <p>'.$rownum12.' votes</p>
                           </button>
                          </form>';
                        }
                    }
               ?>
               <?php
                    if(!empty($option6)){
                        $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql12)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"ss",$roomid,$option6);
                        mysqli_stmt_execute($stmt);
                        $result12=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum12=mysqli_num_rows($result12);
                        $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql11)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"sss",$roomid,$option6,$onlineusername);
                        mysqli_stmt_execute($stmt);
                        $result11=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row11=mysqli_fetch_assoc($result11);
                        $rownum11=mysqli_num_rows($result11);
                        if($rownum11>0){
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                   <input type="hidden" name="roomid" value="'.$roomid.'">
                   <input type="hidden" name="pollid" value="'.$pollid.'">
                   <input type="hidden" name="optionid" value="'.$option6.'">
                  <button type="submit" name="submit" class="sp selected">
                       <p class="poll-option">'.$option6.'</p>
                       <p>'.$rownum12.' votes</p>
                   </button>
                  </form>';
                        }
                        else{
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                           <input type="hidden" name="roomid" value="'.$roomid.'">
                           <input type="hidden" name="pollid" value="'.$pollid.'">
                           <input type="hidden" name="optionid" value="'.$option6.'">
                          <button type="submit" name="submit" class="sp">
                               <p class="poll-option">'.$option6.'</p>
                               <p>'.$rownum12.' votes</p>
                           </button>
                          </form>';
                        }
                    }
               ?>
               <?php
                    if(!empty($option7)){
                        $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql12)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"ss",$roomid,$option7);
                        mysqli_stmt_execute($stmt);
                        $result12=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum12=mysqli_num_rows($result12);
                        $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql11)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"sss",$roomid,$option7,$onlineusername);
                        mysqli_stmt_execute($stmt);
                        $result11=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row11=mysqli_fetch_assoc($result11);
                        $rownum11=mysqli_num_rows($result11);
                        if($rownum11>0){
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                   <input type="hidden" name="roomid" value="'.$roomid.'">
                   <input type="hidden" name="pollid" value="'.$pollid.'">
                   <input type="hidden" name="optionid" value="'.$option7.'">
                  <button type="submit" name="submit" class="sp selected">
                       <p class="poll-option">'.$option7.'</p>
                       <p>'.$rownum12.' votes</p>
                   </button>
                  </form>';
                        }
                        else{
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                           <input type="hidden" name="roomid" value="'.$roomid.'">
                           <input type="hidden" name="pollid" value="'.$pollid.'">
                           <input type="hidden" name="optionid" value="'.$option7.'">
                          <button type="submit" name="submit" class="sp">
                               <p class="poll-option">'.$option7.'</p>
                               <p>'.$rownum12.' votes</p>
                           </button>
                          </form>';
                        }
                    }
               ?>
               <?php
                    if(!empty($option8)){
                        $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql12)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"ss",$roomid,$option8);
                        mysqli_stmt_execute($stmt);
                        $result12=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum12=mysqli_num_rows($result12);
                        $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql11)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"sss",$roomid,$option8,$onlineusername);
                        mysqli_stmt_execute($stmt);
                        $result11=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row11=mysqli_fetch_assoc($result11);
                        $rownum11=mysqli_num_rows($result11);
                        if($rownum11>0){
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                   <input type="hidden" name="roomid" value="'.$roomid.'">
                   <input type="hidden" name="pollid" value="'.$pollid.'">
                   <input type="hidden" name="optionid" value="'.$option8.'">
                  <button type="submit" name="submit" class="sp selected">
                       <p class="poll-option">'.$option8.'</p>
                       <p>'.$rownum12.' votes</p>
                   </button>
                  </form>';
                        }
                        else{
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                           <input type="hidden" name="roomid" value="'.$roomid.'">
                           <input type="hidden" name="pollid" value="'.$pollid.'">
                           <input type="hidden" name="optionid" value="'.$option8.'">
                          <button type="submit" name="submit" class="sp">
                               <p class="poll-option">'.$option8.'</p>
                               <p>'.$rownum12.' votes</p>
                           </button>
                          </form>';
                        }
                    }
               ?>
               <?php
                    if(!empty($option9)){
                        $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql12)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"ss",$roomid,$option9);
                        mysqli_stmt_execute($stmt);
                        $result12=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum12=mysqli_num_rows($result12);
                        $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql11)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"sss",$roomid,$option9,$onlineusername);
                        mysqli_stmt_execute($stmt);
                        $result11=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row11=mysqli_fetch_assoc($result11);
                        $rownum11=mysqli_num_rows($result11);
                        if($rownum11>0){
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                   <input type="hidden" name="roomid" value="'.$roomid.'">
                   <input type="hidden" name="pollid" value="'.$pollid.'">
                   <input type="hidden" name="optionid" value="'.$option9.'">
                  <button type="submit" name="submit" class="sp selected">
                       <p class="poll-option">'.$option9.'</p>
                       <p>'.$rownum12.' votes</p>
                   </button>
                  </form>';
                        }
                        else{
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                           <input type="hidden" name="roomid" value="'.$roomid.'">
                           <input type="hidden" name="pollid" value="'.$pollid.'">
                           <input type="hidden" name="optionid" value="'.$option9.'">
                          <button type="submit" name="submit" class="sp">
                               <p class="poll-option">'.$option9.'</p>
                               <p>'.$rownum12.' votes</p>
                           </button>
                          </form>';
                        }
                    }
               ?>
               <?php
                    if(!empty($option10)){
                        $sql12="SELECT * FROM votes WHERE  roomid=? AND optionid=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql12)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"ss",$roomid,$option10);
                        mysqli_stmt_execute($stmt);
                        $result12=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum12=mysqli_num_rows($result12);
                        $sql11="SELECT * FROM votes WHERE  roomid=? AND optionid=? AND username=?;";
                        $stmt=mysqli_stmt_init($conn);
        
                        if(!mysqli_stmt_prepare($stmt,$sql11)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                        }
        
                        mysqli_stmt_bind_param($stmt,"sss",$roomid,$option10,$onlineusername);
                        mysqli_stmt_execute($stmt);
                        $result11=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row11=mysqli_fetch_assoc($result11);
                        $rownum11=mysqli_num_rows($result11);
                        if($rownum11>0){
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                   <input type="hidden" name="roomid" value="'.$roomid.'">
                   <input type="hidden" name="pollid" value="'.$pollid.'">
                   <input type="hidden" name="optionid" value="'.$option10.'">
                  <button type="submit" name="submit" class="sp selected">
                       <p class="poll-option">'.$option10.'</p>
                       <p>'.$rownum12.' votes</p>
                   </button>
                  </form>';
                        }
                        else{
                           echo '
                           <form action="includes/vote.inc.php" method="post">
                           <input type="hidden" name="roomid" value="'.$roomid.'">
                           <input type="hidden" name="pollid" value="'.$pollid.'">
                           <input type="hidden" name="optionid" value="'.$option10.'">
                          <button type="submit" name="submit" class="sp">
                               <p class="poll-option">'.$option10.'</p>
                               <p>'.$rownum12.' votes</p>
                           </button>
                          </form>';
                        }
                    }
               ?>
                </div>
            </div>
        </div>
        <div id="roomcontent" class="roomcontent"> 
          
        </div>
        
    </div>
    <div class="send">
    <div class="input flex">
        <?php
        $sql9="SELECT * FROM polls WHERE  roomid=? ORDER BY id DESC;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql9)){
                header("location: ../signup.php?error=stmtfailed");
                exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$roomid);
        mysqli_stmt_execute($stmt);
        $result9=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $rownum9=mysqli_num_rows($result9);
        if($rownum6>0){

        
            if($row["roomname"]==$row6["accountname"]){
                
                if($rownum9>0)
                {
                    echo'<button id="poll-btn" class="poll-btn"></button>';
                }
                else{
                    
                    echo '<button id="create-poll-btn" class="poll-btn"></button>';
                }

            }
        }
            else{
                if($rownum10>0){
                    echo'<button id="poll-btn" class="poll-btn"></button>';
                }
                
            }
        
        ?>
        
        <script>
                        const button=document.getElementById("poll-btn");
                        const list=document.getElementById("poll-container");
                        const list3=document.getElementById("roomcontent");
                        list.style.display="none";
                        list3.style.display="contents";
                        button.innerText="View Poll";  
                        button.addEventListener("click",(event)=>{
                            if(list.style.display=="none"){
                                list.style.display="flex";
                                button.innerText="Close Poll"; 
                                list3.style.display="none"; 
                            }
                            else{
                                list.style.display="none";
                                list3.style.display="contents";
                                button.innerText="View Poll";  
                            }
                        })
                       
                     </script>
                     
        <form action="#" class="typing-area" autocomplete="off" method="post">
            <div class="center">
            <div class="flex" id="sendform">
                <textarea name="message" placeholder="  Type Your Message..." class="input-field" id="message" cols="30" rows="2"></textarea>
                <input type="hidden" name="username" value="<?php
                            echo "$username";
                        ?>">
                          <input type="hidden" name="fullname" value="<?php
                            $fullname=$_SESSION["fullname"];
                            echo "$fullname";
                        ?>">
                         <input type="hidden" name="roomid" value="<?php
                            $roomid=$_GET["r"];
                            echo "$roomid";
                        ?>">
                          <input type="hidden" name="messagetime" value="<?php
                            $messagetime=time();
                            echo "$messagetime";
                        ?>">
                <button type="submit" class="marginleft" id="send"><i class="fa-solid fa-paper-plane"></i></button>
            </div>
            </div>
        </form>
        </div>
        <script>
                        const button1=document.getElementById("create-poll-btn");
                        const list1=document.getElementById("create-poll-container");
                        const list2=document.getElementById("roomcontent");
                        const list4=document.getElementById("sendform");
                         list1.style.display="none";
                         list2.style.display="contents";
                        button1.innerText="Create Poll";  
                        button1.addEventListener("click",(event)=>{
                            if(list1.style.display=="none"){
                                list1.style.display="flex";
                                button1.innerText="Close Poll"; 
                                list2.style.display="none";
                                list4.style.display="none";
                            }
                            else{
                                list1.style.display="none";
                                list2.style.display="contents";
                                button1.innerText="Create Poll"; 
                                list4.style.display="flex"; 
                            }
                        })
                     </script>
    </div>
    <script src="chat.js"></script>
    <script>
        let song = <?php echo "$music"; ?>;
        let counter = <?php echo "$counter"; ?>;
        let count = 0;
        let music = new Audio('none');
        music.src = `music/${song}.mp3`;
        let masterPlay = document.getElementById('masterPlay');
masterPlay.addEventListener('click',()=>{
    if(music.paused)
    {
        music.play();
        masterPlay.classList.remove('fa-play');
        masterPlay.classList.add('fa-pause');
    }
    else{
        music.pause();
        masterPlay.classList.remove('fa-pause');
        masterPlay.classList.add('fa-play');
        
    }
})
let repeat = document.getElementById("repeat");

repeat.addEventListener('click',()=>{
    if (repeat.classList=='bi bi-repeat') {
        repeat.classList.remove('bi-repeat');
        repeat.classList.add('bi-repeat-1');
    }
    else{
        repeat.classList.remove('bi-repeat-1');
        repeat.classList.add('bi-repeat');
       
    }
   
})

let back = document.getElementById('back');
let next = document.getElementById('next');

var passedArray = 
    <?php echo json_encode($musicArray); ?>;

next.addEventListener('click',()=>{
    if(repeat.classList=='bi bi-repeat-1') {
        count=count;
        song=song;
        music.src = `music/${song}.mp3`;
        music.play();
        
    }
    else{
   // Access the array elements

       
// Display the array elements
    if(count==counter-1){
        count=0;
    }
    else{
        count = count + 1;
    }
    
    song = passedArray[count]; 
    music.src = `music/${song}.mp3`;

    music.play();
    if(masterPlay.classList=="fa-solid fa-play"){
        masterPlay.classList.remove('fa-play');
        masterPlay.classList.add('fa-pause');  
    }
}
    
})

back.addEventListener('click',()=>{
    if(repeat.classList=='bi bi-repeat-1') {
        count=count;
        song=song;
        music.src = `music/${song}.mp3`;
        music.play();
        
    }
    else{
       
// Display the array elements
    if(count==0){
        count=counter-1;
    }
    else{
        count = count - 1;
    }
    
    song = passedArray[count]; 
    music.src = `music/${song}.mp3`;

    music.play();
    if(masterPlay.classList=="fa-solid fa-play"){
        masterPlay.classList.remove('fa-play');
        masterPlay.classList.add('fa-pause');  
    }
}
    
    
})



music.addEventListener('ended',()=>{
    
    if(repeat.classList=='bi bi-repeat-1') {
        count=count;
        song=song;
        music.src = `music/${song}.mp3`;
        music.play();
        
    }

    else{
        if(count==counter-1){
        count=0;
    }
    else{
        count = count + 1;
    }
    
    song = passedArray[count]; 
    music.src = `music/${song}.mp3`;
   
        music.play();
        
    }
 
})
    </script>
      <noscript>
        <style type="text/css">
            html{
                display: none;
            }
            
        </style>
        <meta http-equiv="refresh" content="0.0;url=offline.php">
    </noscript>
</body>
</html>