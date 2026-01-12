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

if(isset($_GET["a"]))
{
    include 'includes/accountdatabase.inc.php';
    $theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
    }
    else{
        $color="dark-theme";
    }
   
    $accountid=mysqli_real_escape_string($conn,$_GET["a"]);
    if(isset($_GET["r"])){
        $roomid=mysqli_real_escape_string($conn,$_GET["r"]);
    }
    
    $sql="SELECT * FROM intellipreneurs WHERE id=$accountid;";
    $data=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($data);
    $sql2="SELECT * FROM unlockedaccounts WHERE accountid=$accountid;";
    $data2=mysqli_query($conn,$sql2);
    $row2=mysqli_num_rows($data2);
    $row2 = currencyFormat($row2);
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
    $rownum2 = currencyFormat($rownum2);
    $totalviews=0;
    while($row3=mysqli_fetch_assoc($result3)){
       
        $totalviews=$totalviews+$row3["views"];
    }
    

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
    $rownum14 = currencyFormat($rownum14);
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
    $rownum22 = currencyFormat($rownum22);
    $totalpodcaststreams=0;
    while($row22=mysqli_fetch_assoc($result22)){
        $totalpodcaststreams=$totalpodcaststreams+$row22["streams"];
    }

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
    $rownum15 = currencyFormat($rownum15);
    $totalstreams=0;
    while($row15=mysqli_fetch_assoc($result15)){
        $totalstreams=$totalstreams+$row15["streams"];
    }
 
    $totalstreams = currencyFormat($totalstreams);
    $totalpodcaststreams = currencyFormat($totalpodcaststreams);
    $totalviews = currencyFormat($totalviews);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $row["accountname"]; ?> Bio</title>
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
        <div class="navigation">
            <ul>
                <li ><a href="home.php" >Home</a></li>
                <li><a href="account.php?ID=<?php echo"$accountid"; ?>">Content</a></li>
                <?php
                if(isset($_GET["r"])){
                    ?>
                <li><a href="fansroom.php?r=<?php echo"$roomid"; ?>">Room</a></li>
                <?php
                }
                else{
                    ?>
                    <li><a href="#">Room</a></li> 
                    <?php
                }
                ?>
                <li id="home"><a href="#">About</a></li>
            </ul>
        </div>
        <br><br><br><br>
        <div class="subscribe">
            <div class="subscribebox">
            
                <div class="subaccount">
                    <p id="searchfail"><?php echo $row["bio"]; ?>
                       
                    </p>  
                </div>
                
                <div class="subaccount">
                <?php
                if($row["catagory"]=="Music"){
                    echo '<p id="details">'.$totalviews.' Total Views | '.$totalstreams.' Total Streams | Created At : '.$row["Date"].'
                    </p>';
                }
                else if($row["catagory"]=="Podcasts"){
                    echo '<p id="details">'.$totalviews.' Total Views | '.$totalpodcaststreams.' Total Streams | Created At : '.$row["Date"].'
                    </p>';
                }
                else{
                    echo '<p id="details">'.$totalviews.' Total Views | Created At : '.$row["Date"].'
                    </p>';
                } 
                ?>   
                </div>

                
              
                
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