<?php
    session_start();

?>
<?php
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}
include "includes/contentdatabase.inc.php";
        $roomid="amahle1312";
        $sql3="SELECT * FROM chats WHERE  roomid=? ORDER BY id DESC;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql3)){
                 header("location: ../signup.php?error=stmtfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$roomid);
        mysqli_stmt_execute($stmt);
        $result3=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        date_default_timezone_set("Africa/Johannesburg");
        $date=date("F j");
?>
<!DOCTYPE html>
<head>
    <title>Mirth</title>
    <meta lang="en" charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/room/room.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        .responses h6 {
            color: red;
            font-style: italic;
        }
    </style>
   
</head>
<body>
    <header>
        <nav>
        <a href="home.php"><img src="images/9.jpg"></a>
        </nav>
       
    </header>
    <div class="roomname center ">
        <h1 class="text">Amahle</h1>
        <img src="images/check.png" alt="">
    </div>
  
    <div class="roomspace">
        <div class="roomcontent">
            
        <?php
                while($row3=mysqli_fetch_assoc($result3)){
                    
                    include "includes/dbh.inc.php";
                    $username=$row3["username"];
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
                    $time=$row3["messagetime"];
                    $currenttime=uploadedtime($time);

                    echo '<div class="chatbox">
                    <p class="trash">.</p>
                    <div class="user flex text">
                        <img src="profilepictures/'.$row3["profileimage"].'" alt="" id="account" class="marginleft">
                        <p class="marginleft">'.$row3["username"].'</p>
                    </div>
                    
                    <div class="chat marginleft">  
                        
                        <p>'.$row3["chat"].'</p>
                        <br>
                        <p>'.$currenttime.'</p>
                    </div>
                </div>';
                }
            ?>


            <div class="chatbox">
                <p class="trash">.</p>
                <div class="user flex text">
                    <img src="images/9.jpg" alt="" id="account" class="marginleft">
                    <p class="marginleft">Amahle</p>
                </div>
                
                <div class="chat marginleft">  
                    
                    <p>Hello <?php echo $_SESSION["username"]; ?> <br> I am Amahle,your friend in times of need,your shoulder
                to lean on when you need one,your diary in which you can confide.<br> What do you want us to talk about today?</p>
                    <br>
                    <p><?php echo "$date"; ?></p>
                </div>
            </div>
            
        </div>
        
    </div>
    <div class="input flex">
        <form action="includes/chat.inc.php" method="post">
            <div class="send flex">
                <textarea name="message" id="message" cols="30" rows="2"></textarea>
                <input type="hidden" name="username" value="<?php
                            $username=$_SESSION["username"];
                            echo "$username";
                        ?>">
                          <input type="hidden" name="fullname" value="<?php
                            $fullname=$_SESSION["fullname"];
                            echo "$fullname";
                        ?>">
                     
                          <input type="hidden" name="messagetime" value="<?php
                            $messagetime=time();
                            echo "$messagetime";
                        ?>">
                <button type="submit" name="submit" class="marginleft" id="send">Send</button>
            </div>
        </form>
    </div>
    <noscript>
        <style type="text/css">
            html{
                display: none;
            }
            
        </style>
        <meta http-equiv="refresh" content="0.0;url=offline.php">
    </noscript>
</body>