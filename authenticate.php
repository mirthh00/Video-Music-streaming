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
?>

<?php

    include 'includes/accountdatabase.inc.php';
    $theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
    }
    else{
        $color="dark-theme";
    }
   
    $accountid=mysqli_real_escape_string($conn,$_GET["a"]);
    
    $sql="SELECT * FROM intellipreneurs WHERE id=$accountid;";
    $data=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($data);
    $sql2="SELECT * FROM unlockedaccounts WHERE accountid=$accountid;";
    $data2=mysqli_query($conn,$sql2);
    $row2=mysqli_num_rows($data2);
    $sql4="SELECT * FROM rooms WHERE  roomname=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql4)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result4=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row4=mysqli_fetch_assoc($result4);
    include 'includes/contentdatabase.inc.php';
    $sql3="SELECT * FROM videos WHERE  uploader=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql3)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result3=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum2=mysqli_num_rows($result3);
  
    

    $sql14="SELECT * FROM albums WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql14)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result14=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum14=mysqli_num_rows($result14);

    $sql22="SELECT * FROM podcasts WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql22)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result22=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum22=mysqli_num_rows($result22);

    

    $sql15="SELECT * FROM music WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql15)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result15=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum15=mysqli_num_rows($result15);
    
    include 'includes/dbh.inc.php';
   
    $username=$_SESSION["username"];
    $sql23="SELECT * FROM users WHERE usersUid=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql23)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);
    $data3=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row5=mysqli_fetch_assoc($data3);
    if(!empty($row5["recommender"])){

    
    $recommender=$row5["recommender"];
    }
    else{
        $recommender = "None";
    }
 
?>


<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $row["accountname"]; ?> Aunthenticate</title>
        <link href="css/bio/bio.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="profilepictures/<?php echo $row["profileimage"];?>">
        <meta lang="en" charset="UTF-8">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        </style>
    </head>
    <body class="<?php echo "$color";?>">
        <div class="coverbanner">
            <img class="cover" src="intelliprenuercoverpictures/<?php echo $row["coverimage"];?>" alt="">
            <div class="pd">
                <div class="pdn">
            <img class="profile" src="profilepictures/<?php echo $row["profileimage"];?>" >
            <div class="details">
                <div class="tv">
                <h1><?php echo $row["accountname"]; ?><img src="images/check.png" alt=""></h1>
                
                </div>
                
                <?php 
                     if($row["catagory"]=="Music"){
                        
                        echo '<p>'.$row2.' Unlockers | '.$rownum2.' Music Videos | '.$rownum14.' Albums | '.$rownum15.' Songs ';
                    }
                    else if($row["catagory"]=="Podcasts"){
                        echo '<p>'.$row2.' Unlockers | '.$rownum2.' Podcasts Videos | '.$rownum22.' Podcasts ';
                    }
                    else{
                        echo '<p>'.$row2.' Unlockers | '.$rownum2.' Videos';
                    }
                ?>
            </div>
            </div>
            </div>
        </div>
        <br><br><br><br>
        <div class="subscribe">
            <div class="subscribebox">
                
                <div class="subaccount">
                 <p id="details">Congrants!Your payment was processed successfully.You are one step away
                    from accessing the channel.Click the button below to authenticate further for security
                    purposes.
                 </p> 
                </div>
                <div class="subaccount">
                <form method="POST" action="includes/unlockedaccounts.inc.php">
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row["accountname"];
                echo "$useremail";
                ?>" name="accountname"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row["id"];
                echo "$useremail";
                ?>" name="accountid"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row["profileimage"];
                echo "$useremail";
                ?>" name="profilename"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$_SESSION["username"];
                echo "$useremail";
                ?>" name="username"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$_SESSION["fullname"];
                echo "$useremail";
                ?>" name="userfullname"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$_SESSION["useremail"];
                echo "$useremail";
                ?>" name="useremail"> 
                 <input type="hidden" class="input-box" value="<?php 
                $useremail=$row["catagory"];
                echo "$useremail";
                ?>" name="catagory"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$_SESSION["userid"];
                echo "$useremail";
                ?>" name="userid"> 
                 <input type="hidden" class="input-box" value="<?php 
                $useremail=$row4["roomid"];
                echo "$useremail";
                ?>" name="roomid"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row4["roomname"];
                echo "$useremail";
                ?>" name="roomname"> 
                <input type="hidden" class="input-box" value="<?php 
                echo "$recommender";
                ?>" name="recommender"> 
                  <input type="hidden" class="input-box" value="<?php 
                $price=$row["price"];
                echo "$price";
                ?>" name="price"> 
                <button name="pay" id="paymentbutton">Authenticate</button>
                </div>
                </form>
                
                
              
                
            </div>
        </div>
        <br><br>
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