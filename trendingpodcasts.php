<?php
session_start();
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}

include 'includes/accountdatabase.inc.php';
$catagory="Podcasts";

$fullname=$_SESSION["fullname"];
$theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
    }
    else{
        $color="dark-theme";
    }
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


include 'includes/contentdatabase.inc.php';
$count=$_SESSION["country"];


$sql4="SELECT * FROM podcaststats WHERE country=? ORDER BY streams DESC LIMIT 30;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql4)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$count);
mysqli_stmt_execute($stmt);
$result5=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum4=mysqli_num_rows($result5);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Trending Podcasts</title>
    <meta lang="en" charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/chart/chart.css" rel="stylesheet">
    <script  src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
    </style>
</head>
<body class="<?php echo "$color";?>">

    <div class="chartspace">
    <div class="contain">
    <nav>
        <a href="home.php"><img src="images/Logopit_1648978873138.png"></a>
        </nav>

        <div class="navigation">
            <ul>
                
                <li><a href="trendingseries.php">Series</a></li>
                <li><a href="trendingvideos.php">Videos</a></li>
                <li ><a href="trendingmusic.php">Music</a></li>
                <li id="home"><a href="#">Podcasts</a></li>
                
            </ul>
        </div>
    </div>
    <div class="containbanner">   
        
        <div class="thirdbanner">
            <h1>Trending In Podcasts</h1>
        </div>
        <h1 id="boardtitle">Podcasts</h1>
    </div>
        <div class="cd">
        <div class="board">
            
            <div class="contentcontainer">
                <?php
                    if($rownum4>0) {
                    while($row4=mysqli_fetch_assoc($result5)){
                        
                        $thumbnail=$row4["songcover"];
                        $streams=$row4["totalstreams"];
                        $songid=$row4["podcast"];
                        $songtitle=$row4["songtitle"];
                        $time=$row4["uploadedtime"];
                        $profile=$row4["uploaderprofile"];
                        $uploadedtime=uploadedtime($time);

                        $sql5="SELECT * FROM podcasts WHERE podcast=?;";
                        $stmt=mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt,$sql5)){
                            header("location: ../signup.php?error=stmtfailed");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt,"s",$songid);
                        mysqli_stmt_execute($stmt);
                        $result6=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row5=mysqli_fetch_assoc($result6);
                        $uploader=$row5["uploader"];
                        include 'includes/accountdatabase.inc.php';
                          
                        $sql8="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                        $stmt=mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt,$sql8)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                        mysqli_stmt_bind_param($stmt,"s",$uploader);
                        mysqli_stmt_execute($stmt);
                        $result8=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row8=mysqli_fetch_assoc($result8);

                        include 'includes/contentdatabase.inc.php';
                    ?>
                    <div class="video">
                    <form action="redirectpodcasts.php" method="post">
                    <input type="hidden" value="<?php echo "$songtitle";?>" name="songid">
                    <input type="hidden" value="<?php echo "$songid";?>" name="id">
                    <input type="image" src="podcasts/covers/<?php echo "$songid"; ?>.jpg" class="thumbnail">  
                </form>
                    
                    <p class="videodescription"><?php echo "$songtitle"; ?> | <?php echo "$uploader"; ?>
                    </p>
                    <div class="videodetails flex-div">
                        <img src="profilepictures/<?php echo "$profile";?>" class="accounticon">
                        <div class="videoinfo">
                        <div class="verify">
                                <p class="videoviews" id="time"> <a href="account.php?ID=<?php echo $row8["id"]; ?>"><?php echo $row5["uploader"]; ?><img src="images/check.png" alt=""></p></a>
                            </div>
                            <p class="videoviews"><?php echo "$streams"; ?> views | <?php echo "$uploadedtime"; ?></p>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                }
               
                ?>
            
            </div>
            <?php
                $sql6="SELECT * FROM stats WHERE country=? AND catagory=? ORDER BY totalviews DESC LIMIT 30;";
                $stmt=mysqli_stmt_init($conn);
                
                if(!mysqli_stmt_prepare($stmt,$sql6)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                }
                
                mysqli_stmt_bind_param($stmt,"ss",$count,$catagory);
                mysqli_stmt_execute($stmt);
                $result6=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                $rownum6=mysqli_num_rows($result6);
                ?>
                <h1 id="boardtitle">Podcasts Videos</h1>
                <div class="contentcontainer">
                    <?php
                        if($rownum6>0) {
                        while ($row6=mysqli_fetch_assoc($result6)) {
                            $accountname=$row6["uploader"];
                            $thumbnail=$row6["thumbnail"];
                            $views=$row6["views"];
                            $uniqueid=$row6["videoid"];
                            $title=$row6["videotitle"];
                            $time=$row6["uploadedtime"];
                            $uploadedtime=uploadedtime($time);
                            include 'includes/accountdatabase.inc.php';
                          
                            $sql7="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);
    
                            if(!mysqli_stmt_prepare($stmt,$sql7)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }
    
                            mysqli_stmt_bind_param($stmt,"s",$accountname);
                            mysqli_stmt_execute($stmt);
                            $result7=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row7=mysqli_fetch_assoc($result7);
                            $profile = $row7["profileimage"];
                            $directoryname=$row7["directoryname"];
                        ?>
                          <form action="includes/views.inc.php" method="POST">
                                <input type="hidden" value="<?php echo "$uniqueid"; ?>" name="uniqueid">
                                <input type="hidden" value="<?php echo "$accountname"; ?>" name="accountname">
                        <div class="video">
                        <input type="image" src="content/videos/thumbnails/<?php echo "$directoryname"; ?>/<?php echo "$thumbnail"; ?>" class="thumbnail" name="thumbnail">
                        </form>
                        <p class="videodescription"><?php echo "$title"; ?>
                        </p>
                        <div class="videodetails flex-div">
                            <img src="profilepictures/<?php echo "$profile"; ?>" class="accounticon">
                            <div class="videoinfo">
                            <div class="verify">
                                <p class="videoviews" id="time"> <a href="account.php?ID=<?php echo $row7["id"]; ?>"><?php echo $row6["uploader"]; ?><img src="images/check.png" alt=""></p></a>
                            </div>
                                <p class="videoviews" id="time"><?php echo "$views"; ?> views | <?php echo "$uploadedtime"; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    }
                   
                    ?>
                
                </div>

        </div>

    </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <div class="second-nav">
         <ul>
         <li id="start">  
            <div class="di">
                 <a href="home.php" ><i  class="fas fa-film"></i></a>
                 <p>Series</p>
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
                <a href="#"><i id="chosen" class="fas fa-chart-simple"></i></a>
                <p id="chosen">Trending</p>
            </div>
        </li>       
        </ul>
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