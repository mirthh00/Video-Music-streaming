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
$catagory="Movies";

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


include 'includes/contentdatabase.inc.php';
$count=$_SESSION["country"];


$sql4="SELECT * FROM stats WHERE country=? AND catagory=? ORDER BY totalviews DESC LIMIT 30;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql4)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"ss",$count,$catagory);
mysqli_stmt_execute($stmt);
$result5=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum4=mysqli_num_rows($result5);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Trending Movies</title>
    <meta lang="en" charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/chart/chart.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        .responses h6 {
            color: red;
            font-style: italic;
        }
    </style>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <header>
        <nav>
        <a href="home.php"><img src="images/Logopit_1648978873138.png"></a>
        </nav>
       
    </header>

    <div class="chartspace">

        <div class="navigation">
            <ul>
                <li id="home"><a href="#" >Movies</a></li>
                <li><a href="trendingseries.php">Series</a></li>
                <li><a href="trendingvideos.php">Videos</a></li>
                <li><a href="trendingmusic.php">Music</a></li>
                <li><a href="trendingpodcasts.php">Podcasts</a></li>
                
            </ul>
        </div>
        <div class="c">

      
        <div class="board">
        
            <h1 id="boardtitle">Movies</h1>
            <div class="contentcontainer">
                <?php
                    if($rownum4>0) {
                    while ($row4=mysqli_fetch_assoc($result5)) {
                        $accountname=$row4["uploader"];
                        $thumbnail=$row4["thumbnail"];
                        $views=$row4["views"];
                        $uniqueid=$row4["videoid"];
                        $title=$row4["videotitle"];
                        $time=$row4["uploadedtime"];
                        $uploadedtime=uploadedtime($time);
                        include 'includes/accountdatabase.inc.php';
                      
                        $sql5="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                        $stmt=mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt,$sql5)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                        mysqli_stmt_bind_param($stmt,"s",$accountname);
                        mysqli_stmt_execute($stmt);
                        $result6=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $row5=mysqli_fetch_assoc($result6);
                        $profile = $row5["profileimage"];
                        $directoryname=$row5["directoryname"];
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
                                <p class="videoviews" id="time"> <a href="account.php?ID=<?php echo $row5["id"]; ?>"><?php echo $row4["uploader"]; ?><img src="images/check.png" alt=""></p></a>
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
                <p>Podcast</p>
            </div>
        </li>

        <li>
            <div class="di">
                <a href="rooms.php"><i class="fas fa-comments"></i></a>
                <p>Hangout</p>
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