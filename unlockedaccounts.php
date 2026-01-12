<?php
session_start();

if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}

date_default_timezone_set("Africa/Johannesburg");
include 'includes/accountdatabase.inc.php';
$userid=$_SESSION["userid"];
$theme=$_SESSION["theme"];
if($theme == 'light'){
    $color="white-theme";
    $icon = "fa-moon";
}
else{
    $color="dark-theme";
    $icon = "fa-sun";
}
$sql="SELECT * FROM unlockedaccounts WHERE userid=$userid;";
$data=mysqli_query($conn,$sql);
$rownum=mysqli_num_rows($data);
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


<!DOCTYPE html>
<html>
    <head>
    <title>All Unlocked Accounts</title>
        <link href="css/Home/contentpage.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body class="<?php echo "$color";?>">
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
                <img id="img" src="images/Logopit_1648978873138.png">
            </div>
            <div class="nav-middle flex-div" >
                
                <input type="text" class="search" placeholder="Search Accounts" id="search_query">
                <input type="text" class="search1" placeholder="Live Search Series" id="search_query1">
               
                <i class="fas fa-microphone-lines" id="voice-icon"></i>
            </div>
            <div class="nav-right flex-div">
               

                <?php
                        if(isset($_SESSION['username']))
                        {
                            if($rownum11>0)
                            {
                                $imagename=$_SESSION['userimage'];
                            $id=$row11["id"];
                            $catagory=$row11['catagory'];
                            if($catagory=="Podcasts"){
                                $link="uploadpodcast.php";
                            }
                            else if($catagory=="Music"){
                                $link="uploadmusic.php";
                            }
                            else{
                                $link="#";
                            }
                            echo "
                            <ul>
                            <li class='nav-right-icn' title='Search'> <i class='fa-solid fa-magnifying-glass' id='search'></i></li>
                            <li class='nav-right-icn' title='Change Theme'> <i class='fas $icon' id='theme-icon'></i></li>
                            <li class='nav-right-icn' title='Upload Video'><a href='upload.php' id='uploadvid'><i class='fa-solid fa-video'></i></a></li>
                            <li class='nav-right-icn' title='Upload Music'><a href='$link' id='uploadsong'><i class='fa-solid fa-headphones'></i></a></li>
                            </ul>


                            <img id='account-btn' class='account' src='profilepictures/$imagename'>
                            <div id='submenu' class='minimenu'>
                            <ul>
                            <li><a  href='profileupdate.php'><i class='bi bi-person-circle'></i>Profile Update</a></li>
                            <br>
                            <li><a  href='accountupdate.php'><i class='fas fa-user'></i>Account Update</a></li>
                            <br>
                            <li><a  href='account.php?ID=$id'><i class='fas fa-user-check'></i>My Account</a></li>
                            <br>
                            <li><a  href='analytics.php'><i class='fas fa-chart-line'></i>Analytics</a></li>
                            <br>
                            <div class='mobile'>
                            <li title='Upload Video'><a href='upload.php'><i class='fa-solid fa-video'></i>Upload Video</a></li>
                            <br>
                            <li title='Upload Music'><a href='$link'><i class='fa-solid fa-headphones'></i>Upload Music</a></li>
                            <br>
                            <li><a href='affiliatelinks.php'><i class='bi bi-share-fill'></i>Affiliate Links</a></li>
                            <br>
                            <li><a href='allaccounts.php'><i class='fas fa-user-check'></i>All Accounts</a></li>
                            <br>
                            <li><a href='unlockedaccounts.php'><i class='fas fa-lock-open'></i>Unlocked Accounts</a></li>
                            <br>
                            <li><a href='intellipreneurship.php'><i class='fas fa-circle-dollar-to-slot'></i>Intellipreneurship</a></li>
                            <br>
                            <li><a href='schedule.php'><i class='fa-regular fa-calendar-days'></i>My Schedule</a></li>
                            <br>
                            </div>
                            <li><a  href='includes/theme.inc.php?t=dark&l=unlockedaccounts'><i id='dark' class='fas fa-moon'></i>Dark Theme</a></li>
                             <br>
                             <li><a  href='includes/theme.inc.php?t=light&l=unlockedaccounts'><i id='light' class='fas fa-sun'></i>Light Theme</a></li>
                             <br>
                            <li><a  href='includes/logout.inc.php'><i class='fas fa-arrow-right-from-bracket'></i>Log Out</a></li>
                            <br>
                           </ul>
                            </div>
                            ";
                            }
                            else{
                                $imagename=$_SESSION['userimage'];
                            echo "
                            
                            <ul>
                            <li class='nav-right-icn' title='Search'> <i class='fa-solid fa-magnifying-glass' id='search'></i></li>
                            <li class='nav-right-icn' title='Change Theme'> <i class='fas $icon' id='theme-icon'></i></li>
                            <li class='nav-right-icn' title='Upload Video'><a href='intellipreneurship.php'><i class='fa-solid fa-video'></i></a></li>
                            <li class='nav-right-icn' title='Upload Music'><a  href='intellipreneurship.php'><i class='fa-solid fa-headphones'></i></a></li>
                            </ul>
                            
                            
                            <img id='account-btn' class='account' src='profilepictures/$imagename'>
                            <div id='submenu' class='minimenu'>
                            <ul>
                            <li><a  href='profileupdate.php'><i class='fas fa-user'></i>Profile Update</a></li>
                            <br>
                            <li><a  href='intellipreneurship.php'><i class='fas fa-user'></i>Create Account</a></li>
                            <br>
                            <div class='mobile'>
                            <li><a href='affiliatelinks.php'><i class='bi bi-share-fill'></i>Affiliate Links</a></li>
                            <br>
                            <li><a href='allaccounts.php'><i class='fas fa-user-check'></i>All Accounts</a></li>
                            <br>
                            <li><a href='unlockedaccounts.php'><i class='fas fa-lock-open'></i>Unlocked Accounts</a></li>
                            <br>
                            <li><a href='intellipreneurship.php'><i class='fas fa-circle-dollar-to-slot'></i>Intellipreneurship</a></li>
                            <br>
                            <li><a href='schedule.php'><i class='fa-regular fa-calendar-days'></i>My Schedule</a></li>
                            <br>
                            </div>
                            <li><a  href='includes/theme.inc.php?t=dark&l=unlockedaccounts'><i id='dark' class='fas fa-moon'></i>Dark Theme</a></li>
                             <br>
                             <li><a  href='includes/theme.inc.php?t=light&l=unlockedaccounts'><i id='light' class='fas fa-sun'></i>Light Theme</a></li>
                             <br>
                            <li><a  href='includes/logout.inc.php'><i class='fas fa-arrow-right-from-bracket'></i>Log Out</a></li>
                            <br>
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
            <li><a href="home.php" ><i class="fas fa-film"></i>Series</a></li>
                <li><a href="videos.php" ><i class="fas fa-video"></i>Videos</a></li>
                <li><a href="music.php" ><i class="fas fa-music"></i>Music</a></li>
                <li><a href="podcasts.php"><i class="fa-solid fa-podcast"></i>Podcasts</a></li>
                <li><a href="rooms.php"><i class="fas fa-comments"></i>Cribs</a></li>
                <li><a href="allaccounts.php" ><i class="fas fa-user-check"></i>All Channels</a></li>
                <li><a href="#" id="selected"><i class="fas fa-lock-open"></i>Unlocked Channels</a></li>
                <li><a href="affiliatelinks.php"><i class="bi bi-share-fill"></i>Affiliate Links</a></li>
                <li><a href="trendingseries.php"><i class="fas fa-chart-simple"></i>Trending</a></li>
                <li><a href="schedule.php"><i class="fa-regular fa-calendar-days"></i>My Schedule</a></li>
                <li><a href="reportbugs.php"><i class="fas fa-bug"></i>Report Bugs</a></li>
                <br><br>
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
        
        
        <div class="thirdbanner">
            <h1>ALL UNLOCKED ACCOUNTS</h1>
        </div>
        </div>
        <div class="cd">
        <div class="accountscontaine">
        <?php

        
        if($rownum>0)
        {
            while($row=mysqli_fetch_assoc($data)){
                $accountname=$row["accountname"];
                include 'includes/accountdatabase.inc.php';
                $sql13="SELECT * FROM unlockedaccounts WHERE accountname=?;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql13)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt,"s",$accountname);
                mysqli_stmt_execute($stmt);
                $result13=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                $rownum13=mysqli_num_rows($result13);

                $sql15="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql15)){
                header("location: ../signup.php?error=stmtfailed");
                exit();
                }
                mysqli_stmt_bind_param($stmt,"s",$accountname);
                mysqli_stmt_execute($stmt);
                $result15=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                $row15=mysqli_fetch_assoc($result15);
                

                include 'includes/contentdatabase.inc.php';

                $sql14="SELECT * FROM ratings WHERE accountname=?;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql14)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt,"s",$accountname);
                mysqli_stmt_execute($stmt);
                $result14=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                $rownum14=mysqli_num_rows($result14);
                $star1=0;
                $star2=0;
                $star3=0;
                $star4=0;
                $star5=0;
                $rownum15=$rownum14;

                

                
                if($rownum14 > 0){
                    while($row14=mysqli_fetch_assoc($result14)){
                        if($row14["rating"]==1){
                            $star1++;
                        }
                        elseif ($row14["rating"]==2) {
                            $star2++;
                        }
                        elseif ($row14["rating"]==3) {
                            $star3++;
                        }
                        elseif ($row14["rating"]==4) {
                            $star4++;
                        }
                        elseif ($row14["rating"]==5) {
                            $star5++;
                        }
                    }
                    
                }
                
                
                echo '
                <div class="chatbox">
                <div class="room">
                <img class="ipaccountverify" src="profilepictures/'.$row["profileimage"].'">
                <div class="r">
                    <p class="accountname">'.$accountname.'<img class="roomverify" src="images/check.png" alt=""></p>
                    ';
                    echo '<p class="un">Uploads '.$row15["uploads"].' times per month on '.$row15['uploadays'].' at '.$row15["uploadtime"].' '.$row15["timezone"].' </p>
                    </div>
                </div>';
                if($rownum14>0){
                if($star5>$star4 && $star5>$star3 && $star5>$star2 && $star5>$star1){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> &bullet; </p>';
                }

                elseif($star4>$star5 && $star4>$star3 && $star4>$star2 && $star4>$star1){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> &bullet; </p>';
                }

                elseif($star3>$star5 && $star3>$star4 && $star3>$star2 && $star3>$star1){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> &bullet; </p>';
                }

                elseif($star2>$star5 && $star2>$star4 && $star2>$star3 && $star2>$star1){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> &bullet; </p>';
                }

                elseif($star1>$star5 && $star1>$star4 && $star1>$star3 && $star1>$star2){
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; <i class="fa-solid fa-star"></i> &bullet; </p>';
                }
                else{
                    echo '<p class="chat">'.$rownum13.' Unlockers &bullet; equal rating &bullet; </p>';
                }

            }
            else{
                echo '<p class="chat">'.$rownum13.' Unlockers &bullet; no rating yet &bullet; </p>';
            }
                
                echo'
                <div class="unlockbtn">
                <a href="account.php?ID='.$row15["id"].'"><button>Open</button></a>
                </div>
                <br>
                </div>
            ';
                
                
                }
        }
        else{
            echo '
            <div class="secondbanner">
            <h1>You have no unlocked accounts.Please kindly unlock a channel of your choice in all channels page.Thank you.</h1>
            </div>
            ';
        }
        ?>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <div class="second-nav">
         <ul>
         <li id="start">  
            <div class="di">
                 <a href="home.php" ><i  class="fas fa-film"></i></a>
                 <p >Series</p>
            </div>
        </li>

         <li>
            <div class="di">
                <a href="videos.php"><i class="fas fa-video"></i></a> 
                <p>Videos</p>
            </div>
        </li>

        <li>
            <div class="di">
                <a href="music.php"><i class="fas fa-music"></i></a>
                <p>Music</p>
            </div>
                    
                
        </li>

        <li>
            <div class="di">
                <a href="podcasts.php"><i class="fa-solid fa-podcast"></i></a>
                <p>Podcasts</p>
            </div>
        </li>

        <li>
            <div class="di">
                <a href="rooms.php"><i class="fas fa-comments"></i></a>
                <p>Cribs</p>
            </div>
        </li>

        <li id="end">
            <div class="di">
                <a href="trendingseries.php"><i class="fas fa-chart-simple"></i></a>
                <p>Trending</p>
            </div>
        </li>       
        </ul>
        </div> 
        <script>
                        const button1=document.getElementById("search");
                        const list1=document.getElementById("search_query1");
                        const list2=document.getElementById("img");
                        const list3=document.getElementById("account-btn");
                        const list4=document.getElementById("theme-icon");
                        button1.addEventListener("click",(event)=>{
                            if(list1.style.display=="none"){
                                list1.style.display="block";  
                                list2.style.display="none";
                                list3.style.display="none";
                                list4.style.display="none";
                                button1.classList.remove("fa-magnifying-glass");
                                button1.classList.add("fa-arrow-right");
                            }
                            else{
                                list1.style.display="none";  
                                list2.style.display="unset";
                                list3.style.display="unset";
                                list4.style.display="unset";
                                button1.classList.remove("fa-arrow-right");
                                button1.classList.add("fa-magnifying-glass");
                                
                            }
                        })
                     </script> 
        
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

    <script>

const searchquery=document.getElementById("search_query");
            const voiceicon=document.getElementById("voice-icon");
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (SpeechRecognition) {
                const recognition = new SpeechRecognition();
                voiceicon.addEventListener("click",voiceiconclick);
                function voiceiconclick() {
                    if (voiceicon.classList.contains("fa-microphone-lines")) {
                       
                        recognition.start();
                    }
                    else{
                        
                        recognition.stop();
                    }
                }

                recognition.addEventListener("start",startSpeechRecognition);
                function startSpeechRecognition() {
                    voiceicon.classList.remove("fa-microphone-lines");
                    voiceicon.classList.add("fa-microphone-lines-slash");
                    searchquery.focus();
                    
                }

                recognition.addEventListener("end",endSpeechRecognition);
                function endSpeechRecognition() {
                    voiceicon.classList.remove("fa-microphone-lines-slash");
                    voiceicon.classList.add("fa-microphone-lines");
                    searchquery.focus();
                }

                recognition.addEventListener("result",resultOfSpeechRecognition);
                function resultOfSpeechRecognition(event) {
                    const transcript = event.results[0][0].transcript;
                    searchquery.value = transcript;
                    $(document).ready(function(){

                    var search = transcript;
    
                    if (search != " ") {
                        $.ajax({
                        url: 'livesearchunlockedaccounts.php',
                        type:'post',
                        data: {query: search},
                        success:function(data){
                            $(".accountscontaine").html(data);
                        }
                    })
                    }
   
                })
                }
            }
            else{
                voiceicon.classList.remove("fa-microphone-lines");
            }

           var icon=document.getElementById("theme-icon");
           icon.onclick = function(){
            if(document.body.classList.contains("white-theme")){
                    document.body.classList.remove("white-theme");
                    document.body.classList.add("dark-theme");
                    icon.classList.remove("fa-moon");
                    icon.classList.add("fa-sun");
               }
               else{
                document.body.classList.add("white-theme");
                    document.body.classList.remove("dark-theme");
                    icon.classList.remove("fa-sun");
                    icon.classList.add("fa-moon");
               }
              
           }
       </script>
              <script>
    $(document).ready(function(){

//when user searches for content


$("#search_query").keyup(function(){
    var search = $(this).val();
    
    if (search != " ") {
         $.ajax({
        url: 'livesearchunlockedaccounts.php',
        type:'post',
        data: {query: search},
        success:function(data){
            $(".accountscontaine").html(data);
        }
    })
    }
   
})
})
</script>
<script>
    $(document).ready(function(){

//when user searches for content


$("#search_query1").keyup(function(){
    var search = $(this).val();
    
    if (search != " ") {
         $.ajax({
        url: 'livesearchunlockedaccounts.php',
        type:'post',
        data: {query: search},
        success:function(data){
            $(".accountscontaine").html(data);
        }
    })
    }
   
})
})
</script>
    </body>
</html>