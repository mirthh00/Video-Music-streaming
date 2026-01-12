<?php
session_start();
date_default_timezone_set("Africa/Johannesburg");
if(isset($_SESSION["username"])){
    include "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}

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

$catagory="Series";
$sql6="SELECT * FROM unlockedaccounts WHERE userid=? AND catagory=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql6)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"ss",$userid,$catagory);
mysqli_stmt_execute($stmt);
$data2=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
while ($row6=mysqli_fetch_assoc($data2)){
    $accountname=$row6["accountname"];
    $unlockdate=$row6["unlockdate"];
    $accountexpirydate=date("Y-m-d",strtotime(date("Y-m-d",strtotime($unlockdate))." + 30 day"));
    $currentdate=date("Y-m-d");
    if($currentdate>=$accountexpirydate){
        $userid=$_SESSION["userid"];
        $sql7="DELETE FROM unlockedaccounts WHERE accountname=? AND unlockdate=?;";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql7)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ss",$accountname,$unlockdate);
        mysqli_stmt_execute($stmt);
        $data3=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
    }
}

$userid=$_SESSION["userid"];
$catagory="Series";
$sql="SELECT * FROM unlockedaccounts WHERE userid=? AND catagory=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"ss",$userid,$catagory);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum=mysqli_num_rows($data);

$userid=$_SESSION["userid"];
$catagory="Series";
$sql5="SELECT * FROM unlockedaccounts WHERE userid=? AND catagory=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql5)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"ss",$userid,$catagory);
mysqli_stmt_execute($stmt);
$data1=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum4=mysqli_num_rows($data1);

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

$sql9="SELECT * FROM featuredaccounts WHERE catagory=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql9)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$catagory);
mysqli_stmt_execute($stmt);
$result9=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum9=mysqli_num_rows($result9);
?>


<!DOCTYPE html>
<html>
    <head>
    <title>Mirthh Series</title>
        <link href="css/Home/contentpage.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    <i class="fas fa-bars" id="btn" title='Open sidebar'></i>
                  </label>
                <img id="img" src="images/Logopit_1648978873138.png" >
            </div>
            <div class="nav-middle flex-div" >
                
                <input type="text" class="search" placeholder="Live search Series" id="search_query" title='Type to search live'>
                <input type="text" class="search1" placeholder="Live Search Series" id="search_query1">
                <i class="fas fa-microphone-lines" id="voice-icon" title='Record Voice Search'></i>
            </div>
            <div class="nav-right flex-div">
               

                <?php
                        if(isset($_SESSION['username']))
                        {
                            if($rownum2>0)
                            {

                            $imagename=$_SESSION['userimage'];
                            $id=$row3["id"];
                            $catagory=$row3['catagory'];
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
                             <li><a  href='includes/theme.inc.php?t=dark&l=home'><i id='dark' class='fas fa-moon'></i>Dark Theme</a></li>
                             <br>
                             <li><a  href='includes/theme.inc.php?t=light&l=home'><i id='light' class='fas fa-sun'></i>Light Theme</a></li>
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
                             <li><a  href='intellipreneurship.php'><i class='fas fa-user'></i>Create Channel</a></li>
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
                             <li><a  href='includes/theme.inc.php?t=dark&l=home'><i id='dark' class='fas fa-moon'></i>Dark Theme</a></li>
                             <br>
                             <li><a  href='includes/theme.inc.php?t=light&l=home'><i id='light' class='fas fa-sun'></i>Light Theme</a></li>
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
                <li><a href="#" id="selected"><i class="fas fa-film"></i>Series</a></li>
                <li><a href="videos.php"><i class="fas fa-video"></i>Videos</a></li>
                <li><a href="music.php"><i class="fas fa-music"></i>Music</a></li>
                <li><a href="podcasts.php"><i class="fa-solid fa-podcast"></i>Podcasts</a></li>
                <li><a href="rooms.php"><i class="fas fa-comments"></i>Cribs</a></li>
                <li><a href="allaccounts.php"><i class="fas fa-user-check"></i>All Channels</a></li>
                <li><a href="unlockedaccounts.php"><i class="fas fa-lock-open"></i>Unlocked Channels</a></li>
                <li><a href='affiliatelinks.php'><i class='bi bi-share-fill'></i>Affiliate Links</a></li>
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
                    echo "<h1>&bullet;"  . $_SESSION["username"] . " </h1>";
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
                            echo "<h1>HAPPY MONDAY</h1>";
                            break;
                        case 2:
                            echo "<h1>HAPPY TUESDAY</h1>";
                            break;
                        case 3:
                            echo "<h1>HAPPY WEDNESDAY</h1>";
                            break;
                        case 4:
                            echo "<h1>HAPPY THURSDAY</h1>";
                            break;
                        case 5:
                            echo "<h1>HAPPY FRIDAY</h1>";
                            break;
                        case 6:
                            echo "<h1>HAPPY SATURDAY</h1>";
                            break;
                        case 0:
                            echo "<h1>HAPPY SUNDAY</h1>";
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
            <h1>FEATURED ACCOUNTS</h1>
        </div>

        <div class="accountscontainer">
            <?php
            if($rownum9 > 0){
                $counter=0;
            while($row9=mysqli_fetch_assoc($result9)){
                while($counter!=100){
                    $counter++;
                 echo '
                <div class="a">
                <div class="aaa">
                <a href="subscribe.php?ID='.$row9["accountid"].'"><img class="ipaccount" src="profilepictures/'.$row9["profileimage"].'" title="'.$row9["accountname"].'"></a>
                </div>
                </div>
                ';
                }
            }
        }
        ?>
         </div>
        
        <div class="thirdbanner">
            <h1>SERIES</h1>
        </div>
        </div>
        <div class="cd">
        <div class="contentcontainer">
        <?php
        
        if($rownum4>0)

        {

            while($row5=mysqli_fetch_assoc($data1)){
                
                
                include "includes/contentdatabase.inc.php";
                $fullname=$row5["accountname"];
                $sql4="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC ;";
                $stmt=mysqli_stmt_init($conn);
                
                if(!mysqli_stmt_prepare($stmt,$sql4)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                }
                
                mysqli_stmt_bind_param($stmt,"s",$fullname);
                mysqli_stmt_execute($stmt);
                $result4=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
               
                $rownum3=mysqli_num_rows($result4);
                
                    if($rownum3>0)
                    {
                        while( $row4=mysqli_fetch_assoc($result4))
                        {
                            

                            
                            $views=$row4["views"];
                            $views = currencyFormat($views);
                            $time=$row4["uploadedtime"];
                            $currenttime=uploadedtime($time);
                            include "includes/accountdatabase.inc.php";
                            $sql8="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql8)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_bind_param($stmt,"s",$row4["uploader"]);
                            mysqli_stmt_execute($stmt);
                            $result8=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row8=mysqli_fetch_assoc($result8);
                            
                            include "includes/contentdatabase.inc.php";
                          
                            echo '
                            <div class="video">
                            <form action="includes/views.inc.php" method="POST">
                            <input type="hidden" value="'.$row4["uniqueid"].'" name="uniqueid">
                            <input type="image" src="content/videos/thumbnails/'.$row8["directoryname"].'/'.$row4["thumbnail"].'" class="thumbnail" name="thumbnail" title="Watch '.$row4["videotitle"].'">
                            </form>
                            <p class="videodescription">'.$row4["videotitle"].'
                            </p>
                            <div class="videodetails flex-div">
                                <a href="account.php?ID='.$row8["id"].'"><img src="profilepictures/'.$row5["profileimage"].'" class="accounticon"></a>
                                <div class="videoinfo">
                                <div class="verify">
                                <p class="videoviews" id="time" title="'.$row4["uploader"].'"> <a href="account.php?ID='.$row8["id"].'">'.$row4["uploader"].'<img src="images/check.png" alt=""></a></p>
                                </div>
                                    <p class="videoviews" id="time">'.$views.' Views &bullet; '.$currenttime.'</p>
                                </div>
                            </div>
                        </div>
                            ';
                           
                            
                        }
                    }
                }
        }
        else{
            echo "
            <div class='secondbanner'>
            <h1>You have no unlocked accounts for series therefore there's no content to watch.Please unlock an account.Thank you.
            </h1>
            </div>";
        }
       
        ?>
        </div>
    </div>
<br><br><br><br><br><br><br><br>
         <div class="second-nav">
            
         <ul>
         <li id="start">  
            <div class="di">
                 <a href="#" ><i id="chosen" class="fas fa-film"></i></a>
                 <p id="chosen">Series</p>
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
                        
                        button1.addEventListener("click",(event)=>{
                            if(list1.style.display=="none"){
                                list1.style.display="block";  
                                list2.style.display="none";
                                list3.style.display="none";
                               
                                button1.classList.remove("fa-magnifying-glass");
                                button1.classList.add("fa-arrow-right");
                            }
                            else{
                                list1.style.display="none";  
                                list2.style.display="unset";
                                list3.style.display="unset";
                                button1.classList.remove("fa-arrow-right");
                                button1.classList.add("fa-magnifying-glass");
                                
                            }
                        })
                     </script>  
      
        
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
                        url: 'livesearchseries.php',
                        type:'post',
                        data: {query: search},
                        success:function(data){
                            $(".contentcontainer").html(data);
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
        url: 'livesearchseries.php',
        type:'post',
        data: {query: search},
        success:function(data){
            $(".contentcontainer").html(data);
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
        url: 'livesearchseries.php',
        type:'post',
        data: {query: search},
        success:function(data){
            $(".contentcontainer").html(data);
        }
    })
    }
   
})



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