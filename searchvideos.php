<?php
session_start();
include 'includes/accountdatabase.inc.php';
$fullname=$_SESSION["fullname"];
$sql3="SELECT * FROM intellipreneurs WHERE  accountholder=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql3)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname);
mysqli_stmt_execute($stmt);
$result3=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row3=mysqli_fetch_assoc($result3);
$rownum2=mysqli_num_rows($result3);
$fullname2=$_SESSION["fullname"];
$sql11="SELECT * FROM intellipreneurs WHERE  accountholder=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql11)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname2);
mysqli_stmt_execute($stmt);
$result11=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row11=mysqli_fetch_assoc($result11);
$rownum11=mysqli_num_rows($result11);
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
    <title>Search Results</title>
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
            <form method="POST" action="searchvideos.php">
                <input type="text" class="search" placeholder="Search Videos Accounts" name="search">
                <button id="button" name="submit-search"><i class="fas fa-magnifying-glass" id="search-icon" ></i></button>
                </form>
                <a href="#"><i class="fas fa-microphone-lines" id="voice-icon"></i></a>
            </div>
            <div class="nav-right flex-div">
               

               <?php
                       if(isset($_SESSION['username']))
                       {
                           if($rownum11>0)
                           {
                               $imagename=$_SESSION['userimage'];
                           $id=$row11["id"];
                           echo "
                           <ul>
                           <li> <i class='fas fa-moon' id='theme-icon'></i></li>
                           <li> <a href='#'><i class='fas fa-bell'></i></a></li>
                           <li><a href='upload.php'><i class='fas fa-cloud-arrow-up'></i></a></li>
                           </ul>


                           <img id='account-btn' class='account' src='profilepictures/$imagename'>
                           <div id='submenu' class='minimenu'>
                           <ul>
                            <li><a  href='profileupdate.php'><i class='fas fa-user'></i>Profile Update</a></li>
                            <li><a  href=''><i class='fas fa-user'></i>Account Update</a></li>
                            <li><a  href='account.php?ID=$id'><i class='fas fa-user-check'></i>My Account</a></li>
                            <li><a  href='includes/deleteaccount.inc.php'><i class='fas fa-user-slash'></i>Delete Account</a></li>
                            <li><a  href='upload.php'><i class='fas fa-upload'></i>Upload</a></li>
                            <li><a  href='unlockedaccounts.php'><i class='fas fa-chart-line'></i>Analytics</a></li>
                            <li><a  href='includes/logout.inc.php'><i class='fas fa-arrow-right-from-bracket'></i>Log Out</a></li>
                           </ul>
                           </div>
                           ";
                           }
                           else{
                               $imagename=$_SESSION['userimage'];
                           echo "
                           
                           <ul>
                           <li> <i class='fas fa-moon' id='theme-icon'></i></li>
                           <li> <a href='#'><i class='fas fa-bell'></i></a></li>
                           <li><a href='intellipreneurship.php'><i class='fas fa-cloud-arrow-up'></i></a></li>
                           </ul>
                           
                           
                           <img id='account-btn' class='account' src='profilepictures/$imagename'>
                           <div id='submenu' class='minimenu'>
                           <ul>
                            <li><a  href='profileupdate.php'><i class='fas fa-user'></i>Profile Update</a></li>
                            <li><a  href='intellipreneurship.php'><i class='fas fa-user'></i>Create Account</a></li>
                            <li><a  href='includes/logout.inc.php'><i class='fas fa-arrow-right-from-bracket'></i>Log Out</a></li>
                           </ul>
                           </div>
                           ";
                           }
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
                <li><a href="home.php"><i class="fas fa-film"></i>Movies</a></li>
                <li><a href="series.php"><i class="fas fa-clapperboard"></i>Series</a></li>
                <li><a href="videos.php"><i class="fas fa-video"></i>Videos</a></li>
                <li><a href="music.php"><i class="fas fa-music"></i>Music</a></li>
                <li><a href="books.php"><i class="fas fa-bolt"></i>Shorts</a></li>
                <li><a href="rooms.php"><i class="fas fa-comments"></i>Rooms</a></li>
                <li><a href="#"><i class="fas fa-eye"></i>History</a></li>
                <li><a href="#"><i class="fas fa-heart-circle-check"></i>Liked Movies</a></li>
                <li><a href="unlockedaccounts.php"><i class="fas fa-lock-open"></i>Unlocked Accounts</a></li>
                <li><a href="intellipreneurship.php"><i class="fas fa-circle-dollar-to-slot"></i>Intellipreneurship</a></li>
                <li><a href="#"><i class="fas fa-chart-simple"></i>Trending</a></li>
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
        <div class="accountscontainer">
        <?php 
        
        if(isset($_POST["submit-search"]))
        {
            $movies="Music";
            $search=mysqli_real_escape_string($conn,$_POST["search"]);
            $search=strtolower($search);
            $sql="SELECT * FROM intellipreneurs WHERE  accountname LIKE '%$search%' and catagory LIKE '%$movies%';";
            $result=mysqli_query($conn,$sql);
            $searchQueryResult=mysqli_num_rows($result);
           
            if($searchQueryResult != 0)
            {
                   
                    while($row=mysqli_fetch_assoc($result)){
                        $userid=$_SESSION["fullname"];
                        $sql2="SELECT * FROM unlockedaccounts WHERE  userfullname=? AND accountid=?;";
                        $stmt=mysqli_stmt_init($conn);
            
                        if(!mysqli_stmt_prepare($stmt,$sql2)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                        }
            
                        mysqli_stmt_bind_param($stmt,"ss",$userid,$row["id"]);
                        mysqli_stmt_execute($stmt);
                        $result2=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row2=mysqli_fetch_assoc($result2);
                        $rowsnumber=mysqli_num_rows($result2);
                        
                        if($rowsnumber>0)
                        {
                            echo '
                          
                            <a href="account.php?ID='.$row["id"].'"><img class="ipaccount" src="profilepictures/'.$row["profileimage"].'"></a>
                            
                            ';
                        }
                        
                        else{
                            echo '
                           
                            <a href="subscribe.php?ID='.$row["id"].'"><img class="ipaccount" src="profilepictures/'.$row["profileimage"].'"></a>
                            
                            ';
                        }
                    
                    }
                
                   
                
            }
            else{
                echo '
                <div class="subscribe">
                <div class="subscribebox">
                    <div class="subaccount">
                        <img id="account" class="ipaccount" src="images/c.gif">
                    </div>
                    <div class="subaccount">
                        <p id="searchfail">Sorry,there are no matching results.Please search
                            again!
                        </p>  
                    </div>
                </div>
            </div>
                ';
            }
        }
        ?>
         </div>
        
       <script>
           var icon=document.getElementById("theme-icon");
           icon.onclick = function(){
               document.body.classList.toggle("white-theme");
              
           }
       </script>
    </body>
</html>