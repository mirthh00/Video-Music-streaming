<?php
    session_start();

?>
<?php
if(isset($_SESSION["username"])){
    require_once "functions.inc.php";
}
else{
    header("location: ../login.php");
    exit();
}
$currentuser=$_SESSION["username"];
$currentuserfullname=$_SESSION["fullname"];

include "contentdatabase.inc.php";
$roomid=mysqli_real_escape_string($conn,$_POST["roomid"]);
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

while($row3=mysqli_fetch_assoc($result3)){
    
    
    $username=$row3["username"];

    include "accountdatabase.inc.php";
    $sql8="SELECT * FROM rooms WHERE  roomid=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql8)){
             header("location: ../signup.php?error=stmtfailed");
    exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$roomid);
    mysqli_stmt_execute($stmt);
    $result8=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row8=mysqli_fetch_assoc($result8);
    $rownum8=mysqli_num_rows($result8);

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

    $sql7="SELECT * FROM intellipreneurs WHERE  accountholder=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql7)){
             header("location: ../signup.php?error=stmtfailed");
    exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$currentuserfullname);
    mysqli_stmt_execute($stmt);
    $result7=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row7=mysqli_fetch_assoc($result7);
    $rownum7=mysqli_num_rows($result7);
    if($row8["roomname"]==$username){
            if($rownum6>0){

        $time=$row3["messagetime"];
        $currenttime=uploadedtime($time);

    
        echo '<div class="chatbox admin">
        <p class="trash">.</p>
        <div class="user flex text">
            <img src="profilepictures/'.$row3["profileimage"].'" alt="" id="account" class="marginleft">
            <p class="marginleft">'.$row3["username"].'</p>
            <img src="images/check.png" id="verification">
        </div>
        
        <div class="chat marginleft">  
            
            <p>'.$row3["chat"].'</p>
            <br>
            <div class="bottomdetails">
            <p id="time">'.$currenttime.' &bullet; from admin &bullet;</p>
            <form action="includes/deletechat.inc.php" method="post">
            <input type="hidden" value="'.$row3["id"].'" name="chatid">
            <input type="hidden" value="'.$row3["roomid"].'" name="roomid">';
            if($row6["accountholder"]==$currentuserfullname){
                echo '<button id="trashbtn" type="submit" name="submit"><i class="fa-solid fa-trash"></i></button>';
            }
            echo'
            </form>
            </div>
        </div>
    </div>';
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
        <div class="bottomdetails">
        <p id="time">'.$currenttime.' &bullet; from '.$row3["username"].' &bullet;</p>
        <form action="includes/deletechat.inc.php" method="post">
        <input type="hidden" value="'.$row3["id"].'" name="chatid">
        <input type="hidden" value="'.$row3["roomid"].'" name="roomid">
        <button id="trashbtn" type="submit" name="submit"><i class="fa-solid fa-trash"></i></button>
        </form>
        </div>
    </div>
</div>';
    }
}
else{
    if($rownum6>0){

        if($row6["accountholder"]==$currentuserfullname){
            $time=$row3["messagetime"];
        $currenttime=uploadedtime($time);

    
        echo '<div class="chatbox">
        <p class="trash">.</p>
        <div class="user flex text">
            <img src="profilepictures/'.$row3["profileimage"].'" alt="" id="account" class="marginleft">
            <p class="marginleft">'.$row3["username"].'</p>
            <img src="images/check.png" id="verification">
        </div>
        
        <div class="chat marginleft">  
            
            <p>'.$row3["chat"].'</p>
            <br>
            <div class="bottomdetails">
            <p id="time">'.$currenttime.' from '.$row3["username"].' &bullet;</p>
            <form action="includes/deletechat.inc.php" method="post">
            <input type="hidden" value="'.$row3["id"].'" name="chatid">
            <input type="hidden" value="'.$row3["roomid"].'" name="roomid">
            <button id="trashbtn" type="submit" name="submit"><i class="fa-solid fa-trash"></i></button>
            </form>
            </div>
        </div>
    </div>'; 
        }

        else{
        $time=$row3["messagetime"];
        $currenttime=uploadedtime($time);

    
        echo '<div class="chatbox">
        <p class="trash">.</p>
        <div class="user flex text">
            <img src="profilepictures/'.$row3["profileimage"].'" alt="" id="account" class="marginleft">
            <p class="marginleft">'.$row3["username"].'</p>
            <img src="images/check.png" id="verification">
        </div>
        
        <div class="chat marginleft">  
            
            <p>'.$row3["chat"].'</p>
            <br>
            <div class="bottomdetails">
            <p id="time">'.$currenttime.' from '.$row3["username"].' &bullet;</p>
            </div>
        </div>
    </div>';
        }
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
    $time=$row3["messagetime"];
    $currenttime=uploadedtime($time);

    if($row3["username"]==$_SESSION["username"]){
        echo '<div class="chatbox">
        <p class="trash">.</p>
        <div class="user flex text">
            <img src="profilepictures/'.$row3["profileimage"].'" alt="" id="account" class="marginleft">
            <p class="marginleft">'.$row3["username"].'</p>
        </div>
        
        <div class="chat marginleft">  
            
            <p>'.$row3["chat"].'</p>
            <br>
            <div class="bottomdetails">
            <p id="time">'.$currenttime.' &bullet; from you &bullet;</p>
            <form action="includes/deletechat.inc.php" method="post">
            <input type="hidden" value="'.$row3["id"].'" name="chatid">
            <input type="hidden" value="'.$row3["roomid"].'" name="roomid">
            <button id="trashbtn" type="submit" name="submit"><i class="fa-solid fa-trash"></i></button>
            </form>
            
            </div>
        </div>
    </div>';
    }
    else{
        echo '<div class="chatbox">
        <p class="trash">.</p>
        <div class="user flex text">
            <img src="profilepictures/'.$row3["profileimage"].'" alt="" id="account" class="marginleft">
            <p class="marginleft">'.$row3["username"].'</p>
        </div>
        
        <div class="chat marginleft">  
            
            <p>'.$row3["chat"].'</p>
            <br>
            <div class="bottomdetails">
            <p id="time">'.$currenttime.' from '.$row3["username"].' &bullet;</p>
            </div>
        </div>
    </div>';
    }


    }
}
        
}

