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
include 'includes/accountdatabase.inc.php';
$theme=$_SESSION["theme"];
if($theme == 'light'){
    $color="white-theme";
    $icon = "fa-moon";
}
else{
    $color="dark-theme";
    $icon = "fa-sun";
}

if(isset($_GET["c"])){
    include 'includes/contentdatabase.inc.php';
    $song=mysqli_real_escape_string($conn,$_GET["c"]);
    $sql6="SELECT * FROM podcasts WHERE  podcast=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql6)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$song);
    mysqli_stmt_execute($stmt);
    $result6=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row6=mysqli_fetch_assoc($result6);
    $rownum6=mysqli_num_rows($result6);
    include 'includes/accountdatabase.inc.php';

    $sql3="SELECT * FROM intellipreneurs WHERE  accountname=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql3)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$row6["uploader"]);
    mysqli_stmt_execute($stmt);
    $result3=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row3=mysqli_fetch_assoc($result3);
    $id1=$row3["id"];

    $userid=$_SESSION["userid"];
    $sql="SELECT * FROM unlockedaccounts WHERE userid=? AND accountname=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$userid,$row6["uploader"]);
    mysqli_stmt_execute($stmt);
    $data=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row=mysqli_fetch_assoc($data);
    $rownum=mysqli_num_rows($data);
    if($rownum==0){
        header("location: subscribe.php?ID=$id1");
        exit();
    }

}
$userid=$_SESSION["userid"];
$catagory="Podcasts";
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
$row=mysqli_fetch_assoc($data);
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

$sql19="SELECT * FROM unlockedaccounts WHERE  userfullname=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql19)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname);
mysqli_stmt_execute($stmt);
$result19=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row19=mysqli_fetch_assoc($result19);
$rownum19=mysqli_num_rows($result19);

include 'includes/contentdatabase.inc.php';
if($rownum>0){
    $uploader=$row["accountname"];
}
else{
    $uploader="No...!!!";
}

$sql6="SELECT * FROM podcasts WHERE  uploader=? ORDER BY id DESC ;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql6)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$uploader);
mysqli_stmt_execute($stmt);
$result6=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum6=mysqli_num_rows($result6);

if(isset($_POST["action"])){
    $videoid = mysqli_real_escape_string($conn,$_POST["post_id"]);
    $sql9="UPDATE podcasts SET streams=streams+1 WHERE podcast=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql9)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$videoid);
    mysqli_stmt_execute($stmt);
    $result9=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    date_default_timezone_set("Africa/Johannesburg");
    $day=date("F j");

    $sql20="SELECT * FROM podcastanalytics WHERE podcast=? AND day=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql20)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$videoid,$day);
    mysqli_stmt_execute($stmt);
    $data20=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row20=mysqli_fetch_assoc($data20);
    $rownum20=mysqli_num_rows($data20);

    $sql23="SELECT * FROM podcasts WHERE podcast=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql23)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$videoid);
    mysqli_stmt_execute($stmt);
    $data23=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row23=mysqli_fetch_assoc($data23);
    $rownum23=mysqli_num_rows($data23);
    $totalstreams=$row23["streams"];
    $uptime=$row23["uploadedtime"];

    if($rownum20==0){
        $streams=1;
        $sql21="INSERT INTO podcastanalytics(podcast,songtitle,songcover,streams,totalstreams,day,uploadedtime) VALUES (?,?,?,?,?,?,?);";
        $stmt=mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt,$sql21)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "sssssss",$videoid,$row23["songtitle"],$row23["podcast"],$streams,$totalstreams,$day,$uptime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    else{
        $sql22="UPDATE podcastanalytics SET streams=streams+1 WHERE podcast='$videoid' AND day='$day';";
        mysqli_query($conn,$sql22);
        $sql22="UPDATE podcastanalytics SET totalstreams='$totalstreams' WHERE podcast='$videoid' AND day='$day';";
        mysqli_query($conn,$sql22);
    }

    $country=$_SESSION["country"];

    $sql24="SELECT * FROM podcaststats WHERE podcast=? AND country=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql24)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$videoid,$country);
    mysqli_stmt_execute($stmt);
    $data24=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row24=mysqli_fetch_assoc($data24);
    $rownum24=mysqli_num_rows($data24);

    if($rownum24==0){
        $streams=1;
        $sql21="INSERT INTO podcaststats(podcast,songtitle,songcover,streams,totalstreams,uploaderprofile,country,uploadedtime) VALUES (?,?,?,?,?,?,?,?);";
        $stmt=mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt,$sql21)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "ssssssss",$videoid,$row23["songtitle"],$row23["podcast"],$streams,$totalstreams,$row23["uploaderprofile"],$country,$row23["uploadedtime"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    else{
        $sql22="UPDATE podcaststats SET streams=streams+1 WHERE podcast='$videoid' AND country='$country';";
        mysqli_query($conn,$sql22);
        $sql22="UPDATE podcaststats SET totalstreams='$totalstreams' WHERE podcast='$videoid' AND country='$country';";
        mysqli_query($conn,$sql22);
    }
}

?>


<!DOCTYPE html>
<html>
<head>
        <title>Mirthh Podcasts</title>
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <link href="css/music/music.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
                    <i class="fas fa-bars" id="btn"></i>
                  </label>
                  <img id="img" src="images/Logopit_1648978873138.png">
            </div>
            <div class="nav-middle flex-div" >
                
                <input type="text" class="search" placeholder="Search Podcasts" id="search_query">
                <input type="text" class="search1" placeholder="Search Podcasts" id="search_query1">
                <i class="fas fa-microphone-lines" id="voice-icon"></i>
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


                            <img id='account-btn' class='accountpic' src='profilepictures/$imagename'>
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
                            <li><a  href='includes/theme.inc.php?t=dark&l=podcasts'><i id='dark' class='fas fa-moon'></i>Dark Theme</a></li>
                             <br>
                             <li><a  href='includes/theme.inc.php?t=light&l=podcasts'><i id='light' class='fas fa-sun'></i>Light Theme</a></li>
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
                            
                            
                            <img id='account-btn' class='accountpic' src='profilepictures/$imagename'>
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
                            <li><a  href='includes/theme.inc.php?t=dark&l=podcasts'><i id='dark' class='fas fa-moon'></i>Dark Theme</a></li>
                             <br>
                             <li><a  href='includes/theme.inc.php?t=light&l=podcasts'><i id='light' class='fas fa-sun'></i>Light Theme</a></li>
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
                <li><a href="#" id="selected"><i class="fa-solid fa-podcast"></i>Podcasts</a></li>
                <li><a href="rooms.php"><i class="fas fa-comments"></i>Cribs</a></li>
                <li><a href="allaccounts.php"><i class="fas fa-user-check"></i>All Channels</a></li>
                <li><a href="unlockedaccounts.php"><i class="fas fa-lock-open"></i>Unlocked Channels</a></li>
                <li><a href="affiliatelinks.php"><i class="bi bi-share-fill"></i>Affiliate Links</a></li>
                <li><a href="trendingseries.php"><i class="fas fa-chart-simple"></i>Trending</a></li>
                <li><a href="schedule.php"><i class="fa-regular fa-calendar-days"></i>My Schedule</a></li>
                <li><a href="reportbugs.php"><i class="fas fa-bug"></i>Report Bugs</a></li>
                 <br><br>
            </ul>
        </div>
        <header>
        <div class="co">
            <div class="musicsection">
                <br><br>
                <div class="contentcontainer">
                    <?php
                    if(isset($_GET["song"])){
                        include 'includes/contentdatabase.inc.php';
                        $search = mysqli_real_escape_string($conn,$_GET["song"]) ;
                       

                        $sql12="SELECT * FROM podcasts WHERE  uploader LIKE CONCAT('%',?,'%') OR songtitle LIKE CONCAT('%',?,'%') ORDER BY id DESC ;";
                        $stmt=mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt,$sql12)){
                            header("location: ../signup.php?error=stmtfailed");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt,"ss",$search,$search);
                        mysqli_stmt_execute($stmt);
                        $result12=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum12=mysqli_num_rows($result12);
                        if($rownum12>0)
                        {
                            while ($row12=mysqli_fetch_assoc($result12)) {
                                $time=$row12["uploadedtime"];
                                $uploadedtime=uploadedtime($time);
                                $ID=$row12["podcast"];
                                $songtitle=$row12["songtitle"];
                                $artists=$row12["artists"];
                                $accountname=$row12['uploader'];
                                include 'includes/accountdatabase.inc.php';
                                $sql13="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                                $stmt=mysqli_stmt_init($conn);
    
                                if(!mysqli_stmt_prepare($stmt,$sql13)){
                                    header("location: ../signup.php?error=stmtfailed");
                                exit();
                                }
    
                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $result13=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row13=mysqli_fetch_assoc($result13);
                                ?>
                        <div class="video">
                            
                                <div class="play">
                                    <img src="" class="albumcover" id="songcover">
                                  
                                </div>
                            <div class="musicdetails">
                            <div class="c">
                                    <a href="account.php?ID=<?php echo $row13["id"];?>"><img id="account-btn" class="account" src="profilepictures/<?php
                                    $uploaderprofile=$row13["profileimage"];
                                    echo "$uploaderprofile";
                                    
                                    ?>"></a>
                                    
                                <div class="videodetails">
                                    <p class="videodescription">
                                    </p>
                                    <p class="artistsnames lowfont videodescription">
                                    </p>
                                    <div class="videoinfo">
                                        <p class="videoviews lowfont"><?php echo $row12["streams"]; ?> Streams | <?php echo "$uploadedtime"; ?></p>
                                    </div>
                                </div>
                                </div>
                                <?php 
                                       include 'includes/contentdatabase.inc.php';
                                       $sql14="SELECT * FROM likedpodcasts  WHERE  podcastid=? and username=?;";
                                       $stmt=mysqli_stmt_init($conn);
                                   
                                       if(!mysqli_stmt_prepare($stmt,$sql14)){
                                       header("location: ../signup.php?error=stmtfailed");
                                       exit();
                                       }
                                       mysqli_stmt_bind_param($stmt,"ss",$ID,$_SESSION["username"]);
                                       mysqli_stmt_execute($stmt);
                                       $result14=mysqli_stmt_get_result($stmt);
                                       mysqli_stmt_close($stmt);
                                       $rownum14=mysqli_num_rows($result14);
                                       if($rownum14==1){
                                        ?>
                                        <div class="psng">
                                        <i class="bi songplay2 bi-play-circle-fill" data-id="<?php echo "$ID";?>" id="<?php echo "$ID";?>"></i>
                                        <i id="<?php echo "$ID";?>" name="<?php echo "$ID";?>" data-id="<?php echo "$ID";?>" class="bi react bi-heart-fill"></i>
                                       </div>
                                        <?php
                                       }
                                       else {
                                        ?>
                                        <div class="psng">
                                        <i class="bi songplay2 bi-play-circle-fill" data-id="<?php echo "$ID";?>" id="<?php echo "$ID";?>"></i>
                                        <i id="<?php echo "$ID";?>" name="<?php echo "$ID";?>" data-id="<?php echo "$ID";?>" class="bi react bi-heart"></i>
                                       </div>
                                        <?php
                                       }
                                ?>
                            </div>
                              
                        </div>
                            
                            <?php
                            }
                        }
                    }

                    else if(isset($_GET["album"])){
                        include 'includes/contentdatabase.inc.php';
                        $search = mysqli_real_escape_string($conn,$_GET["album"]) ;
                        

                        $sql15="SELECT * FROM music WHERE albumtitle LIKE CONCAT('%',?,'%') ORDER BY id DESC ;";
                        $stmt=mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt,$sql15)){
                            header("location: ../signup.php?error=stmtfailed");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt,"s",$search);
                        mysqli_stmt_execute($stmt);
                        $result15=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum15=mysqli_num_rows($result15);
                        if($rownum15>0)
                        {
                            while ($row15=mysqli_fetch_assoc($result15)) {
                                $time=$row15["uploadedtime"];
                                $uploadedtime=uploadedtime($time);
                                $ID=$row15["song"];
                                $songtitle=$row15["songtitle"];
                                $artists=$row15["artists"];
                                $accountname=$row15['uploader'];
                                include 'includes/accountdatabase.inc.php';
                                $sql16="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                                $stmt=mysqli_stmt_init($conn);
    
                                if(!mysqli_stmt_prepare($stmt,$sql16)){
                                    header("location: ../signup.php?error=stmtfailed");
                                exit();
                                }
    
                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $result16=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row16=mysqli_fetch_assoc($result16);
                                ?>
                        <div class="video">
                            
                                <div class="play">
                                    <img src="" class="albumcover" id="songcover">
                                   
                                </div>
                            <div class="musicdetails">
                            <div class="c">
                                    <a href=""><img id="account-btn" class="account" src="profilepictures/<?php
                                    $uploaderprofile=$row16["profileimage"];
                                    echo "$uploaderprofile";
                                    
                                    ?>"></a>
                                    
                                <div class="videodetails">
                                    <p class="videodescription">
                                    </p>
                                    <p class="artistsnames lowfont videodescription">
                                    </p>
                                    <div class="videoinfo">
                                        <p class="videoviews lowfont"><?php echo $row15["streams"]; ?> Streams | <?php echo "$uploadedtime"; ?></p>
                                    </div>
                                </div>
                                </div>
                                <?php 
                                       include 'includes/contentdatabase.inc.php';
                                       $sql17="SELECT * FROM likedmusic  WHERE  songid=? and username=?;";
                                       $stmt=mysqli_stmt_init($conn);
                                   
                                       if(!mysqli_stmt_prepare($stmt,$sql17)){
                                       header("location: ../signup.php?error=stmtfailed");
                                       exit();
                                       }
                                       mysqli_stmt_bind_param($stmt,"ss",$ID,$_SESSION["username"]);
                                       mysqli_stmt_execute($stmt);
                                       $result17=mysqli_stmt_get_result($stmt);
                                       mysqli_stmt_close($stmt);
                                       $rownum17=mysqli_num_rows($result17);
                                       if($rownum17==1){
                                        ?>
                                        <div class="psng">
                                        <i class="bi songplay2 bi-play-circle-fill" data-id="<?php echo "$ID";?>" id="<?php echo "$ID";?>"></i>
                                        <i id="<?php echo "$ID";?>" name="<?php echo "$ID";?>" data-id="<?php echo "$ID";?>" class="bi react bi-heart-fill"></i>
                                       </div>
                                        <?php
                                       }
                                       else {
                                        ?>
                                        <div class="psng">
                                        <i class="bi songplay2 bi-play-circle-fill" data-id="<?php echo "$ID";?>" id="<?php echo "$ID";?>"></i>
                                        <i id="<?php echo "$ID";?>" name="<?php echo "$ID";?>" data-id="<?php echo "$ID";?>" class="bi react bi-heart"></i>
                                       </div>
                                        <?php
                                       }
                                ?>
                            </div>
                              
                        </div>
                            
                            <?php
                            }
                        }
                    }

                    else {
                        if($rownum6>0)
                        {
                            while ($row6=mysqli_fetch_assoc($result6)) {
                                $time=$row6["uploadedtime"];
                                $uploadedtime=uploadedtime($time);
                                $ID=$row6["podcast"];
                                $songtitle=$row6["songtitle"];
                                $artists=$row6["artists"];
                                $accountname=$row6['uploader'];
                                include 'includes/accountdatabase.inc.php';
                                $sql8="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                                $stmt=mysqli_stmt_init($conn);
    
                                if(!mysqli_stmt_prepare($stmt,$sql8)){
                                    header("location: ../signup.php?error=stmtfailed");
                                exit();
                                }
    
                                mysqli_stmt_bind_param($stmt,"s",$accountname);
                                mysqli_stmt_execute($stmt);
                                $result8=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row8=mysqli_fetch_assoc($result8);
                                ?>
                        <div class="video">
                            
                                <div class="play">
                                    <img src="" class="albumcover" id="songcover">
                                    
                                </div>
                            <div class="musicdetails">
                            <div class="c">
                                    <a href="account.php?ID=<?php echo $row8["id"];?>"><img id="account-btn" class="account" src="profilepictures/<?php
                                    $uploaderprofile=$row8["profileimage"];
                                    echo "$uploaderprofile";
                                    
                                    ?>"></a>
                                    
                                <div class="videodetails">
                                <p class="videodescription">
                                    </p>
                                    <p class="artistsnames lowfont videodescription">
                                    </p>
                                    <div class="videoinfo">
                                        <p class="videoviews lowfont"><?php echo $row6["streams"]; ?> Streams | <?php echo "$uploadedtime"; ?></p>
                                    </div>
                                </div>
                                </div>
                                <?php 
                                       include 'includes/contentdatabase.inc.php';
                                       $sql10="SELECT * FROM likedpodcasts  WHERE  podcastid=? and username=?;";
                                       $stmt=mysqli_stmt_init($conn);
                                   
                                       if(!mysqli_stmt_prepare($stmt,$sql10)){
                                       header("location: ../signup.php?error=stmtfailed");
                                       exit();
                                       }
                                       mysqli_stmt_bind_param($stmt,"ss",$ID,$_SESSION["username"]);
                                       mysqli_stmt_execute($stmt);
                                       $result10=mysqli_stmt_get_result($stmt);
                                       mysqli_stmt_close($stmt);
                                       $rownum10=mysqli_num_rows($result10);
                                       if($rownum10==1){
                                        ?>
                                        <div class="psng">
                                        <i class="bi songplay2 bi-play-circle-fill" data-id="<?php echo "$ID";?>" id="<?php echo "$ID";?>"></i>
                                        <i id="<?php echo "$ID";?>" name="<?php echo "$ID";?>" data-id="<?php echo "$ID";?>" class="bi react bi-heart-fill"></i>
                                       </div>
                                        <?php
                                       }
                                       else {
                                        ?>
                                        <div class="psng">
                                        <i class="bi songplay2 bi-play-circle-fill" data-id="<?php echo "$ID";?>" id="<?php echo "$ID";?>"></i>
                                        <i id="<?php echo "$ID";?>" name="<?php echo "$ID";?>" data-id="<?php echo "$ID";?>" class="bi react bi-heart"></i>
                                       </div>
                                        <?php
                                       }
                                ?>
                            </div>
                              
                        </div>
                            
                            <?php
                            }
                        }
                    }
                   
                    ?>
                </div>
                
            </div>

        </div>

            <div class="ps">
            <div class="zn">
            <div class="bar">
                <input type="range" name="" id="seek" min="0" value="0" max="100">
                <div class="bar2" id="bar2">
                </div>
                <div class="dot" id="dot"></div>
            </div>
            <div class="playsection">
                
                <div class="songdetails">
                    <img src="" id="poster_master_play">
                    <div class="musician">
                        <p id="title"></p>
                        <a href="" id="artistlink"><p id="artist" class="artist"></p></a>
                    </div>
                </div>
                <div class="controls">
                  <div class="audiocontrols">
                    <i class="fas fa-backward-step" id="back"></i>
                    <i id="masterPlay" class="fas fa-play"></i>
                    <i class="fas fa-forward-step" id="next"></i>
                    
                  </div>
                 <div class="seeker">
                    <p id="currentstart">/</p>
                    <p id="currentend"></p>
                 </div>
                 
              </div>
    
                <div class="othercontrols">
                    <div class="volume">
                        <i id="volumeicon" class="fas fa-volume-high"></i>
                        <div class="volumebar">
                            <input type="range" name="" id="volumebar" min="0" value="0" max="100">
                            <div class="volumebar2" id="volumebar2">
                            </div>
                            <div class="volumedot" id="volumedot"></div>
                        </div>
                     </div>
                     <i id="repeat" class="bi bi-repeat"></i>
                     
                    
                   
                </div>
            </div>

            </div>
              
            <br>
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
                <a href="music.php"><i  class="fas fa-music"></i></a>
                <p >Music</p>
            </div>
                    
                
        </li>

        <li>
            <div class="di">
                <a href="#"><i id="chosen" class="fa-solid fa-podcast"></i></a>
                <p id="chosen">Podcasts</p>
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
         <br>
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
           
        </header>
        <script>
        //create array of songs
const music = new Audio('none');

const songs=[
    <?php
        if (isset($_GET["song"])){
            include 'includes/contentdatabase.inc.php';
            $search = mysqli_real_escape_string($conn,$_GET["song"]) ;
            

            $sql11="SELECT * FROM podcasts WHERE  uploader LIKE CONCAT('%',?,'%') OR songtitle LIKE CONCAT('%',?,'%') ORDER BY id DESC ;";
            $stmt=mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql11)){
                header("location: ../signup.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt,"ss",$search,$search);
            mysqli_stmt_execute($stmt);
            $result11=mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            $rownum11=mysqli_num_rows($result11);

            if ($rownum11>0) {
                while ($row11=mysqli_fetch_assoc($result11)){
                    $ID=$row11["podcast"];
                    $songtitle=$row11["songtitle"];
                    $artists=$row11["artists"];
    
                    echo "
                    {
                        id:'$ID',
                        songName:'$songtitle',
                        artistName:'$artists',
                        poster:'podcasts/covers/$ID.jpg'
                        
                    },
                    ";
                } 
            }
        }

        else if (isset($_GET["album"])){
            include 'includes/contentdatabase.inc.php';
            $search = mysqli_real_escape_string($conn,$_GET["album"]) ;
            

            $sql18="SELECT * FROM music WHERE  albumtitle LIKE CONCAT('%',?,'%')  ORDER BY id DESC ;";
            $stmt=mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql18)){
                header("location: ../signup.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt,"s",$search);
            mysqli_stmt_execute($stmt);
            $result18=mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            $rownum18=mysqli_num_rows($result18);

            if ($rownum18>0) {
                while ($row18=mysqli_fetch_assoc($result18)){
                    $ID=$row18["song"];
                    $songtitle=$row18["songtitle"];
                    $artists=$row18["artists"];
    
                    echo "
                    {
                        id:'$ID',
                        songName:'$songtitle',
                        artistName:'$artists',
                        poster:'music/covers/$ID.jpg'
                        
                    },
                    ";
                } 
            }
        }

        else{
            include 'includes/contentdatabase.inc.php';
            
            $sql7="SELECT * FROM podcasts WHERE uploader=? ORDER BY id DESC;";
            $stmt=mysqli_stmt_init($conn);
            
            if(!mysqli_stmt_prepare($stmt,$sql7)){
                header("location: ../signup.php?error=stmtfailed");
                exit();
            }
            
            mysqli_stmt_bind_param($stmt,"s",$uploader);
            mysqli_stmt_execute($stmt);
            $result7=mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            $rownum7=mysqli_num_rows($result7);
            if ($rownum7>0) {
                while ($row7=mysqli_fetch_assoc($result7)){
                    $ID=$row7["podcast"];
                    $songtitle=$row7["songtitle"];
                    $artists=$row7["artists"];
    
                    echo "
                    {
                        id:'$ID',
                        songName:'$songtitle',
                        artistName:'$artists',
                        poster:'podcasts/covers/$ID.jpg'
                        
                    },
                    ";
                } 
            }
        }
    ?>
    
]

Array.from(document.getElementsByClassName('video')).forEach((element, i)=>{
    element.getElementsByTagName('img')[0].src=songs[i].poster;
    element.getElementsByTagName('p')[0].innerHTML=songs[i].songName;
    element.getElementsByClassName('artistsnames')[0].innerHTML=songs[i].artistName;
})
let poster_master_player = document.getElementById('poster_master_play');
let masterPlay = document.getElementById('masterPlay');
masterPlay.addEventListener('click',()=>{
    if(music.paused || music.currentTime <= 0)
    {
        music.play();
        masterPlay.classList.remove('fa-play');
        masterPlay.classList.add('fa-pause');
        poster_master_player.style.animation='spin 1s linear infinite';
    }
    else{
        music.pause();
        masterPlay.classList.remove('fa-pause');
        masterPlay.classList.add('fa-play');
        poster_master_player.style.animation='none';
        
    }
})

let index=0;

let title = document.getElementById('title');
let artist = document.getElementById('artist');

const makeallplays = () =>{
    Array.from(document.getElementsByClassName('songplay2')).forEach((element)=>{
        element.classList.add('bi-play-circle-fill');
        element.classList.remove('fa-pause'); 
        
      
    })
}

Array.from(document.getElementsByClassName('songplay2')).forEach((element)=>{
    element.addEventListener('click', (e)=>{
        index=e.target.id;
        makeallplays();
        e.target.classList.remove('bi-play-circle-fill');
        e.target.classList.add('bi-pause-circle-fill');
        music.src = `podcasts/${index}.mp3`;
        poster_master_player.style.display='block';
        poster_master_player.src = `podcasts/covers/${index}.jpg`;
        masterPlay.classList.remove('fa-play');
        masterPlay.classList.add('fa-pause');
        poster_master_player.style.animation='spin 1s linear infinite';
        music.play();
        
        let song_title = songs.filter((ele)=>{
            return ele.id == index;
        })

        song_title.forEach(ele =>{
            let {songName} = ele;
            title.innerHTML = songName;
        })

        let artist_title = songs.filter((ele1)=>{
            return ele1.id == index;
        })
    
        artist_title.forEach(ele1 =>{
            let {artistName} = ele1;
            artist.innerHTML = artistName;
        })
       
    })
})


const leadingzeroformatter=new Intl.NumberFormat(undefined,{
    minimumIntegerDigits:2,
})
function formatDuration(time){
    const seconds = Math.floor(time%60)
    const minutes = Math.floor(time/60)%60
    const hours = Math.floor(time/3600)

    if(hours===0){
        return `${minutes}:${leadingzeroformatter.format(seconds)}`
    }
    else{
        return `${hours}:${leadingzeroformatter.format(minutes)}:${leadingzeroformatter.format(seconds)}`
    }

}

function formatDurationMusic(time){
    const seconds = Math.floor(time%60)
    const minutes = Math.floor(time/60)%60
    const hours = Math.floor(time/3600)

    if(hours===0){
        return `${minutes}:${leadingzeroformatter.format(seconds)}/`
    }
    else{
        return `${hours}:${leadingzeroformatter.format(minutes)}:${leadingzeroformatter.format(seconds)}/`
    }

}

let currentStart = document.getElementById('currentstart');
let currentEnd = document.getElementById('currentend');
let seek = document.getElementById('seek');
let bar2 = document.getElementById('bar2');
let dot = document.getElementById('dot');
music.addEventListener('timeupdate',()=>{
    let music_curr = music.currentTime;
    let music_dur = music.duration;
    let min = Math.floor(music_dur/60);
    let sec = Math.floor(music_dur%60);
    if (sec<10) {
        sec = `0${sec}`;
    }

    let min1 = Math.floor(music_curr/60);
    let sec1 = Math.floor(music_curr%60);
    if (sec1<10) {
        sec1 = `0${sec1}`;
    }
   
    currentEnd.innerHTML = formatDuration(music.duration);
    currentStart.innerHTML = formatDurationMusic(music.currentTime);

    if (currentStart==currentEnd) {
        poster_master_player.style.animation='spin 1s linear infinite';
        music.play();
    }
    
    let progressbar = parseInt((music.currentTime/music.duration)*100);
    seek.value = progressbar;
    let seekbar = seek.value;
    bar2.style.width = `${seekbar}%`;
    dot.style.left = `${seekbar}%`;
})

seek.addEventListener('change',()=>{
    music.currentTime = seek.value * music.duration/100;
})

let repeat = document.getElementById("repeat");

repeat.addEventListener('click',()=>{
    if (repeat.classList=='bi bi-repeat') {
        repeat.classList.remove('bi-repeat');
        repeat.classList.add('bi-repeat-1');
    }
    else{
        repeat.classList.remove('bi-repeat-1');
        repeat.classList.add('bi-repeat');
       
    }
   
})

music.addEventListener('ended',()=>{
    
    if (repeat.classList=='bi bi-repeat-1') {
        music.src = `podcasts/${index}.mp3`;
        poster_master_player.style.display='block';
        poster_master_player.src = `podcasts/covers/${index}.jpg`;
        poster_master_player.style.animation='spin 1s linear infinite';
        music.play();
        let song_title = songs.filter((ele)=>{
            return ele.id == index;
        })
    
        song_title.forEach(ele =>{
            let {songName} = ele;
            title.innerHTML = songName;
        })
    
        let artist_title = songs.filter((ele1)=>{
            return ele1.id == index;
        })
    
        artist_title.forEach(ele1 =>{
            let {artistName} = ele1;
            artist.innerHTML = artistName;
        })
        makeallplays();
        document.getElementById(`${index}`).classList.remove('bi-play-circle-fill');
        document.getElementById(`${index}`).classList.add('bi-pause-circle-fill');
        
    }

    else{
        index-=1;
    if (index < 1) {
        index = Array.from(document.getElementsByClassName('songplay2')).length;
    }
        music.src = `podcasts/${index}.mp3`;
        poster_master_player.style.display='block';
        poster_master_player.src = `podcasts/covers/${index}.jpg`;
        poster_master_player.style.animation='spin 1s linear infinite';
        $(document).ready(function(){

        //when user clicks video play button


        var post_id = index;
        //ajax code

        $.ajax({
            url: 'podcasts.php',
            type: 'post',
            data: {
                'action': 'view',
                'post_id': post_id,
            }
    })


})
        music.play();
        let song_title = songs.filter((ele)=>{
            return ele.id == index;
        })
    
        song_title.forEach(ele =>{
            let {songName} = ele;
            title.innerHTML = songName;
        })
    
        let artist_title = songs.filter((ele1)=>{
            return ele1.id == index;
        })
    
        artist_title.forEach(ele1 =>{
            let {artistName} = ele1;
            artist.innerHTML = artistName;
        })
        makeallplays();
        document.getElementById(`${index}`).classList.remove('bi-play-circle-fill');
        document.getElementById(`${index}`).classList.add('bi-pause-circle-fill');
        
    }
 
})

let volumeicon=document.getElementById('volumeicon');
let volumebar=document.getElementById('volumebar');
let volumebar2=document.getElementById('volumebar2');
let volumedot=document.getElementById('volumedot');

volumebar.addEventListener('change',()=>{
   if (volumebar.value==0) {
        volumeicon.classList.remove('fa-volume-low');
        volumeicon.classList.remove('fa-volume-high');
        volumeicon.classList.add('fa-volume-xmark');
   }

   if (volumebar.value>0) {
    volumeicon.classList.add('fa-volume-low');
    volumeicon.classList.remove('fa-volume-high');
    volumeicon.classList.remove('fa-volume-xmark');
}

if (volumebar.value>70) {
    volumeicon.classList.remove('fa-volume-low');
    volumeicon.classList.add('fa-volume-high');
    volumeicon.classList.remove('fa-volume-xmark');
}

let vol_a = volumebar.value;
volumebar2.style.width = `${vol_a}%`;
volumedot.style.left = `${vol_a}%`;
music.volume=vol_a/100;
})

let back = document.getElementById('back');
let next = document.getElementById('next');

next.addEventListener('click',()=>{
    index-=1;
    if (index < 1) {
        index = Array.from(document.getElementsByClassName('songplay2')).length;
    }
    music.src = `podcasts/${index}.mp3`;
    poster_master_player.style.display='block';
    poster_master_player.src = `podcasts/covers/${index}.jpg`;
    poster_master_player.style.animation='spin 1s linear infinite';
    $(document).ready(function(){

        //when user clicks video play button

        
            var post_id = index;
            
            //ajax code

            $.ajax({
            url: 'podcasts.php',
            type: 'post',
            data: {
                'action': 'view',
                'post_id': post_id,
                }
            })

        
    })
    music.play();
    let song_title = songs.filter((ele)=>{
        return ele.id == index;
    })

    song_title.forEach(ele =>{
        let {songName} = ele;
        title.innerHTML = songName;
    })

    let artist_title = songs.filter((ele1)=>{
        return ele1.id == index;
    })

    artist_title.forEach(ele1 =>{
        let {artistName} = ele1;
        artist.innerHTML = artistName;
    })
    makeallplays();
    document.getElementById(`${index}`).classList.remove('bi-play-circle-fill');
        document.getElementById(`${index}`).classList.add('bi-pause-circle-fill');
    
})

back.addEventListener('click',()=>{
    index-=0;
    index+=1;
    if (index > Array.from(document.getElementsByClassName('songplay2')).length) {
        index = 1;
    }
    poster_master_player.style.display='block';
    music.src = `podcasts/${index}.mp3`;
    poster_master_player.src = `podcasts/covers/${index}.jpg`;
    poster_master_player.style.animation='spin 1s linear infinite';
    $(document).ready(function(){

    //when user clicks video play button


    var post_id = index;
    //ajax code

    $.ajax({
    url: 'podcasts.php',
    type: 'post',
    data: {
        'action': 'view',
        'post_id': post_id,
        }
    })


    })
    music.play();
    let song_title = songs.filter((ele)=>{
        return ele.id == index;
    })

    song_title.forEach(ele =>{
        let {songName} = ele;
        title.innerHTML = songName;
    })

    let artist_title = songs.filter((ele1)=>{
        return ele1.id == index;
    })

    artist_title.forEach(ele1 =>{
        let {artistName} = ele1;
        artist.innerHTML = artistName;
    })
    makeallplays();
    document.getElementById(`${index}`).classList.remove('bi-play-circle-fill');
        document.getElementById(`${index}`).classList.add('bi-pause-circle-fill');
    
})

Array.from(document.getElementsByClassName('react')).forEach((element)=>{
    element.addEventListener('click', (e)=>{
        index=e.target.id;
       
        $(document).ready(function(){
       
    var action;
    var song_id = index;
 
    $song_btn = $(`[name=${index}]`);
    
    //check whether user is liking or unliking
    if ($song_btn.hasClass('bi react bi-heart')) {
        action = 'like';
    }
    else if ($song_btn.hasClass('bi react bi-heart-fill')) {
        action = 'unlike';
    } 

    //ajax code

    $.ajax({
        url: 'likepodcast.php',
        type: 'post',
        data: {
            'songliked': 'view',
            'action': action,
            'songid': song_id
        },

        success: function(data) {
            
            if (action == 'like') {
                $song_btn.removeClass('bi react bi-heart');
                $song_btn.addClass('bi react bi-heart-fill');
            }
            else if (action == 'unlike') {
                $song_btn.removeClass('bi react bi-heart-fill');
                $song_btn.addClass('bi react bi-heart');
            } 
            
        }
        
    })
    

})


        
    })
})

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
                        url: 'livesearchpodcasts.php',
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

//when user clicks video play button

$('.songplay2').on('click',function(){
    var post_id = $(this).data('id');
    $clicked_btn = $(this);
    //ajax code

    $.ajax({
        url: 'podcasts.php',
        type: 'post',
        data: {
            'action': 'view',
            'post_id': post_id,
        }
    })

})
$("#search_query").keyup(function(){
    var search = $(this).val();
    
    if (search != " ") {
         $.ajax({
        url: 'livesearchpodcasts.php',
        type:'post',
        data: {query: search},
        success:function(data){
            $(".contentcontainer").html(data);
        }
    })
    }
   
})

$("#search_query1").keyup(function(){
    var search = $(this).val();
    
    if (search != " ") {
         $.ajax({
        url: 'livesearchpodcasts.php',
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