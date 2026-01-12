<?php
session_start();
if(isset($_GET["ID"]))
{
    include 'includes/accountdatabase.inc.php';
    $ID=mysqli_real_escape_string($conn,$_GET["ID"]);
    $sql="SELECT * FROM intellipreneurs WHERE id=$ID;";
    $data=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($data);

    $accountname=$row["accountname"];
    $sql2="SELECT * FROM rooms WHERE roomname=?;";
$stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql2)){
                         header("location: ../signup.php?error=stmtfailed");
                exit();
                }

                mysqli_stmt_bind_param($stmt,"s",$accountname);
                mysqli_stmt_execute($stmt);
                $data2=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                $row2=mysqli_fetch_assoc($data2);
}
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

<!DOCTYPE html>
<html>
    <head>
    <title>Mirthh Payment</title>
        <link href="css/Home/contentpage.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
    </head>
    <body>
    <div id="preloader"></div>
        <script>
            var loader=document.getElementById("preloader");
            window.addEventListener("load",function() {
                loader.style.display="none";
                
            })
        </script>
        <nav class="flex-div">
            <div class="nav-left">
                <label for="check">
                    <i class="fas fa-bars" id="btn"></i>
                  </label>
                <a href="home.php"><img src="images/Logopit_1648978873138.png"></a>
            </div>
            <div class="nav-middle flex-div" >
                <input type="text" class="search" placeholder="Search Movies">
                <a href="#"><i class="fas fa-magnifying-glass" id="search-icon"></i></a>
                <a href="#"><i class="fas fa-microphone-lines" id="voice-icon"></i></a>
            </div>
            <div class="nav-right flex-div">
                <ul>
                    <li> <i class="fas fa-moon" id="theme-icon"></i></li>
                    <li> <a href="#"><i class="fas fa-bell"></i></a></li>
                    <li><a href="#"><i class="fas fa-folder"></i></a></li>
                    <li> <a href="#"><i class="fas fa-cloud"></i></a></li>
                </ul>

                <?php
                        if(isset($_SESSION['username']))
                        {
                            $imagename=$_SESSION['userimage'];
                            echo "<img id='account-btn' class='account' src='profilepictures/$imagename'>
                            <div id='submenu' class='minimenu'>
                            <ul>
                             <li><a  href='profileupdate.php'><i class='fas fa-user'></i>Profile Update</a></li>
                             <li><a  href='intellipreneurship.php'><i class='fas fa-user-check'></i>IP Account</a></li>
                             <li><a  href='#'><i class='fas fa-chart-line'></i>Analytics</a></li>
                             <li><a  href='#'><i class='fas fa-gear'></i>Settings</a></li>
                             <li><a  href='includes/logout.inc.php'><i class='fas fa-arrow-right-from-bracket'></i>Log Out</a></li>
                            </ul>
                            </div>
                            ";
                        } 
                    ?>
                    <script>
                        const button=document.getElementById("account-btn");
                        const list=document.getElementById("submenu");
                        list.style.display="none";
                        button.addEventListener("click",(event)=>{
                            if(list.style.display=="none"){
                                list.style.display="block";  
                            }
                            else{
                                list.style.display="none";  
                            }
                        })
                     </script>
               
            </div>
        </nav>
        <input type="checkbox" id="check">
        <label for="check">
          <i class="fas fa-xmark" id="cancel"></i>
        </label>
        <div class="sidebar">
            <ul>
                <li><a href="home.php" ><i class="fas fa-film"></i>Movies</a></li>
                <li><a href="series.php"><i class="fas fa-clapperboard"></i>Series</a></li>
                <li><a href="videos.php"><i class="fas fa-video"></i>Videos</a></li>
                <li><a href="music.php"><i class="fas fa-music"></i>Music</a></li>
                <li><a href="books.php"><i class="fas fa-book-open"></i>Books</a></li>
                <li><a href="pictures.php"><i class="fas fa-images"></i>Pictures</a></li>
                <li><a href="rooms.php"><i class="fas fa-comments"></i>Rooms</a></li>
                <li><a href="#"><i class="fas fa-eye"></i>History</a></li>
                <li><a href="#"><i class="fas fa-lock-open"></i>Unlocked Accounts</a></li>
                <li><a href="intellipreneurship.php"><i class="fas fa-circle-dollar-to-slot"></i>Intellipreneurship</a></li>
                <li><a href="#"><i class="fas fa-chart-simple"></i>Charts</a></li>
                 <br><br><br>
            </ul>
        </div>

        <div class="container">
            <div class="banner">
            <script src="js/welcome.js"></script>
                <?php
                    if(isset($_SESSION["username"]))
                    echo "<h1> !  "  . $_SESSION["username"] . "</h1>";
                    else{
                        echo"<h1>! You Are Not Logged In!<h1>";
                    }
                ?>
            </div>
            <div class="secondbanner">
            <?php
                if (isset($_SESSION["username"]))
                {
                    $weekdays=date("w");
                    switch($weekdays)
                    {
                        case 1:
                            echo "<h1>HAPPY MONDAY!</h1>";
                            break;
                        case 2:
                            echo "<h1>HAPPY TUESDAY!</h1>";
                            break;
                        case 3:
                            echo "<h1>HAPPY WEDNESDAY!</h1>";
                            break;
                        case 4:
                            echo "<h1>HAPPY THURSDAY!</h1>";
                            break;
                        case 5:
                            echo "<h1>HAPPY FRIDAY!</h1>";
                            break;
                        case 6:
                            echo "<h1>HAPPY SATURDAY!</h1>";
                            break;
                        case 0:
                            echo "<h1>HAPPY SUNDAY!</h1>";
                            break;
                    }
                }
                else{
                    echo "<a href='login.php'>LOGIN</a>";
                }
        ?>
        <i class="fas fa-face-grin-hearts"></i>
        </div>
        </div>
        <div class="subscribe">
            <div class="subscribebox">
                <div class="subaccount">
                    <img id="account" class="ipaccount" src="profilepictures/<?php echo $row["profileimage"];?>">
                </div>
                <p id="paymentinfo">Pay to unlock the content inside this account for your loved one.The 
                    payment will grant them access to this account for
                    a month and will not be auto billed.Enter the email of the person you want to gift below...
                </p>
                <div class="subaccount">
                <form method="POST" action="includes/gift.inc.php">
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
                $useremail=$row2["roomid"];
                echo "$useremail";
                ?>" name="roomid"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row2["roomname"];
                echo "$useremail";
                ?>" name="roomname"> 
                 <input type="hidden" class="input-box" value="<?php 
                $price=$row["price"];
                echo "$price";
                ?>" name="price"> 

                <input type="email" class="input-box" placeholder="Enter Email Adress" name="giftemail"> 
                <button name="pay" id="paymentbutton"><?php echo $row["price"];?> <?php echo $row["currency"];?>s</button>
                </div>
                </form>
            </div>
        </div>
       <script>
           var icon=document.getElementById("theme-icon");
           icon.onclick = function(){
               document.body.classList.toggle("white-theme");
              
           }
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