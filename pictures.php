<?php
session_start()

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
    <title>Mirth</title>
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
                <a href=""><img src="images/Logopit_1648978873138.png"></a>
            </div>
            <div class="nav-middle flex-div" >
                <input type="text" class="search" placeholder="Search Pictures">
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
                             <li><a  href='#'><i class='fas fa-user-check'></i>IP Account</a></li>
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
                <li><a href="home.php"><i class="fas fa-film"></i>Movies</a></li>
                <li><a href="series.php"><i class="fas fa-clapperboard"></i>Series</a></li>
                <li><a href="videos.php"><i class="fas fa-video"></i>Videos</a></li>
                <li><a href="music.php"><i class="fas fa-music"></i>Music</a></li>
                <li><a href="books.php"><i class="fas fa-book-open"></i>Books</a></li>
                <li><a href="#"id="selected"><i class="fas fa-images"></i>Pictures</a></li>
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