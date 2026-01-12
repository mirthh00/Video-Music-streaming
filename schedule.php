<?php
session_start();
date_default_timezone_set("Africa/Johannesburg");
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}
$username=$_SESSION["username"];
$theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
    }
    else{
        $color="dark-theme";
    }

include 'includes/accountdatabase.inc.php';


$sql5="SELECT * FROM unlockedaccounts WHERE username=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql5)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$data1=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum4=mysqli_num_rows($data1);

$sql7="SELECT * FROM unlockedaccounts WHERE username=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql7)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$data7=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum7=mysqli_num_rows($data7);

$sql8="SELECT * FROM unlockedaccounts WHERE username=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql8)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$data8=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum8=mysqli_num_rows($data8);

$sql9="SELECT * FROM unlockedaccounts WHERE username=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql9)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$data9=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum9=mysqli_num_rows($data9);

$sql10="SELECT * FROM unlockedaccounts WHERE username=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql10)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$data10=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum10=mysqli_num_rows($data10);

$sql11="SELECT * FROM unlockedaccounts WHERE username=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql11)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$data11=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum11=mysqli_num_rows($data11);

$sql12="SELECT * FROM unlockedaccounts WHERE username=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql12)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$data12=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum12=mysqli_num_rows($data12);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mirthh - Schedule</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <meta lang="en" charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/schedule/schedule.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        .responses h6 {
            color: red;
            font-style: italic;
        }
    </style>
</head>
<body class="<?php echo "$color";?>">
    <header>
        <nav>
        <a href="home.php"><img src="images/Logopit_1648978873138.png"></a>
        </nav>
       
    </header>

    <div class="chartspace">
      
       

        <div class="board">
            <h1 id="boardtitle">WELCOME <?php echo "$username"; ?>!</h1>
            <h1 id="boardtitle">SCHEDULE</h1>
            
         
                <div class="info-container">
                    <div class="information">
                        
                        <p class="weekdays">Monday</p>
                        <?php
                        if($rownum4>0){
                            while($row=mysqli_fetch_assoc($data1))
                            {
                                $accountname = $row["accountname"];
                                $sql6="SELECT * FROM intellipreneurs WHERE accountname=?;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql6)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $data2=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row2=mysqli_fetch_assoc($data2);
                                if(strpos($row2["uploadays"],"Monday")>-1){

                                ?>
                            
                        
                        <div class="ct">
                            <img src="profilepictures/<?php echo $row["profileimage"];?>" class="thumbnail">
                            <div class="dt">
                                <p class="videotitle"><?php echo $row["accountname"];?> will release new content on this day.</p>
                                <p class="time">Time of Upload: <?php echo $row2["uploadtime"];?> (<?php echo $row2["timezone"];?>)</p>
                            </div>
                        </div>
                      
                        <?php
                                }
                                else{
                                    echo '
                                    <div class="ct">
                            <img src="images/c.gif" class="thumbnail">
                            <div class="dt">
                            <p class="videotitle">Nothing new coming from '.$row["accountname"].' on this day.</p> 
                            </div>
                        </div>
                                    ';
                                }
                            }
                        }
                        ?>
                        <p class="weekdays">Tuesday</p>
                        
                        <?php
                        if($rownum7>0){
                            while($row7=mysqli_fetch_assoc($data7))
                            {
                                $accountname = $row7["accountname"];
                                $sql13="SELECT * FROM intellipreneurs WHERE accountname=?;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql13)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $data13=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row13=mysqli_fetch_assoc($data13);
                                if(strpos($row13["uploadays"],"Tuesday")>-1){

                                ?>
                                <div class="ct">
                            <img src="profilepictures/<?php echo $row7["profileimage"];?>" class="thumbnail">
                            <div class="dt">
                                <p class="videotitle"><?php echo $row7["accountname"];?> will release new content</p>
                                <p class="time">Time of Upload: <?php echo $row13["uploadtime"];?> (<?php echo $row13["timezone"];?>)</p>
                            </div>
                        </div>
                        <?php
                                }
                                else{
                                    echo '
                                    <div class="ct">
                            <img src="images/c.gif" class="thumbnail">
                            <div class="dt">
                            <p class="videotitle">Nothing new coming from '.$row7["accountname"].' on this day.</p> 
                            </div>
                        </div>
                                    ';
                                }
                            }
                        }
                        ?>


                        <p class="weekdays">Wednesday</p>
                        <?php
                        if($rownum8>0){
                            while($row8=mysqli_fetch_assoc($data8))
                            {
                                $accountname = $row8["accountname"];
                                $sql14="SELECT * FROM intellipreneurs WHERE accountname=?;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql14)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $data14=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row14=mysqli_fetch_assoc($data14);
                                if(strpos($row14["uploadays"],"Wednesday")>-1){

                                ?>
                                <div class="ct">
                            <img src="profilepictures/<?php echo $row8["profileimage"];?>" class="thumbnail">
                            <div class="dt">
                                <p class="videotitle"><?php echo $row8["accountname"];?> will release new content</p>
                                <p class="time">Time of Upload: <?php echo $row14["uploadtime"];?> (<?php echo $row14["timezone"];?>)</p>
                            </div>
                        </div>
                        <?php
                                }
                                else{
                                    echo '
                                    <div class="ct">
                            <img src="images/c.gif" class="thumbnail">
                            <div class="dt">
                            <p class="videotitle">Nothing new coming from '.$row8["accountname"].' on this day.</p> 
                            </div>
                        </div>
                                    ';
                                }
                            }
                        }
                        ?>
                        <p class="weekdays">Thursday</p>
                        <?php
                        if($rownum9>0){
                            while($row9=mysqli_fetch_assoc($data9))
                            {
                                $accountname = $row9["accountname"];
                                $sql15="SELECT * FROM intellipreneurs WHERE accountname=?;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql15)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $data15=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row15=mysqli_fetch_assoc($data15);
                                if(strpos($row15["uploadays"],"Thursday")>-1){

                                ?>
                            
                        
                            <div class="ct">
                            <img src="profilepictures/<?php echo $row9["profileimage"];?>" class="thumbnail">
                            <div class="dt">
                                <p class="videotitle"><?php echo $row9["accountname"];?> will release new content</p>
                                <p class="time">Time of Upload: <?php echo $row15["uploadtime"];?> (<?php echo $row15["timezone"];?>)</p>
                            </div>
                        </div>
                        <?php
                                }
                                else{
                                    echo '
                                    <div class="ct">
                            <img src="images/c.gif" class="thumbnail">
                            <div class="dt">
                            <p class="videotitle">Nothing new coming from '.$row9["accountname"].' on this day.</p> 
                            </div>
                        </div>
                                    ';
                                }
                            }
                        }
                        ?>
                        <p class="weekdays">Friday</p>
                        <?php
                        if($rownum10>0){
                            while($row10=mysqli_fetch_assoc($data10))
                            {
                                $accountname = $row10["accountname"];
                                $sql16="SELECT * FROM intellipreneurs WHERE accountname=?;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql16)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $data16=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row16=mysqli_fetch_assoc($data16);
                                if(strpos($row16["uploadays"],"Friday")>-1){

                                ?>
                           <div class="ct">
                            <img src="profilepictures/<?php echo $row10["profileimage"];?>" class="thumbnail">
                            <div class="dt">
                                <p class="videotitle"><?php echo $row10["accountname"];?> will release new content</p>
                                <p class="time">Time of Upload: <?php echo $row16["uploadtime"];?> (<?php echo $row16["timezone"];?>)</p>
                            </div>
                        </div>
                        <?php
                                }
                                else{
                                    echo '
                                    <div class="ct">
                            <img src="images/c.gif" class="thumbnail">
                            <div class="dt">
                            <p class="videotitle">Nothing new coming from '.$row10["accountname"].' on this day.</p> 
                            </div>
                        </div>
                                    ';
                                }
                            }
                        }
                        ?>
                        <p class="weekdays">Saturday</p>
                        <?php
                        if($rownum11>0){
                            while($row11=mysqli_fetch_assoc($data11))
                            {
                                $accountname = $row11["accountname"];
                                $sql17="SELECT * FROM intellipreneurs WHERE accountname=?;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql17)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $data17=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row17=mysqli_fetch_assoc($data17);
                                if(strpos($row17["uploadays"],"Saturday")>-1){

                                ?>
                            
                            <div class="ct">
                            <img src="profilepictures/<?php echo $row11["profileimage"];?>" class="thumbnail">
                            <div class="dt">
                                <p class="videotitle"><?php echo $row11["accountname"];?> will release new content</p>
                                <p class="time">Time of Upload: <?php echo $row17["uploadtime"];?> (<?php echo $row17["timezone"];?>)</p>
                            </div>
                        </div>
                        <?php
                                }
                                else{
                                    echo '
                                    <div class="ct">
                            <img src="images/c.gif" class="thumbnail">
                            <div class="dt">
                            <p class="videotitle">Nothing new coming from '.$row11["accountname"].' on this day.</p> 
                            </div>
                        </div>
                                    ';
                                }
                            }
                        }
                        ?>
                        <p class="weekdays">Sunday</p>
                        <?php
                        if($rownum12>0){
                            while($row12=mysqli_fetch_assoc($data12))
                            {
                                $accountname = $row12["accountname"];
                                $sql18="SELECT * FROM intellipreneurs WHERE accountname=?;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql18)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $data18=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row18=mysqli_fetch_assoc($data18);
                                if(strpos($row18["uploadays"],"Sunday")>-1){

                                ?>
                            
                            <div class="ct">
                            <img src="profilepictures/<?php echo $row12["profileimage"];?>" class="thumbnail">
                            <div class="dt">
                                <p class="videotitle"><?php echo $row12["accountname"];?> will release new content</p>
                                <p class="time">Time of Upload: <?php echo $row18["uploadtime"];?> (<?php echo $row18["timezone"];?>)</p>
                            </div>
                        </div>
                        <?php
                                }
                                else{
                                    echo '
                                    <div class="ct">
                            <img src="images/c.gif" class="thumbnail">
                            <div class="dt">
                            <p class="videotitle">Nothing new coming from '.$row12["accountname"].' on this day.</p> 
                            </div>
                        </div>
                                    ';
                                }
                            }
                        }
                        ?>
                        <br><br>
                    </div>
                    
                </div>
              
            
          

            <br><br><br><br>
        </div>
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
</html>