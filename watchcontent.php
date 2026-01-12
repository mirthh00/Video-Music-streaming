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
<?php
if(isset($_GET["watch"]))
{
    $theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
        $icon = "fa-moon";
    }
    else{
        $color="dark-theme";
        $icon = "fa-sun";
    }
    $useremail = $_SESSION["useremail"];
    include 'includes/contentdatabase.inc.php';
    $ID=mysqli_real_escape_string($conn,$_GET["watch"]);
    $sql="SELECT * FROM videos WHERE uniqueid=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$ID);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row=mysqli_fetch_assoc($result);

    $sql26="SELECT * FROM suggestedvideos WHERE genre=? ORDER BY RAND() LIMIT 4;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql26)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["genre"]);
    mysqli_stmt_execute($stmt);
    $result26=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum26 = mysqli_num_rows($result26);

    $sql24="SELECT * FROM podcasts WHERE songtitle=? AND uploader=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql24)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$row["link"],$row["uploader"]);
    mysqli_stmt_execute($stmt);
    $result24=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row24=mysqli_fetch_assoc($result24);
    $rownum24=mysqli_num_rows($result24);
    if($rownum24>0){
        $podcastname=$row24["songtitle"];
        $podcast=$row24["podcast"];
    }
    else{
        $podcastname="None";
        $podcast=0;
    }
   

    $sql25="SELECT * FROM music WHERE songtitle=? AND uploader=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql25)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$row["link"],$row["uploader"]);
    mysqli_stmt_execute($stmt);
    $result25=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row25=mysqli_fetch_assoc($result25);
    $rownum25=mysqli_num_rows($result25);
    if($rownum25>0){
        $songname=$row25["songtitle"];
        $song=$row25["song"];
    }
    else{
        $songname="None";
        $song=0;
    }
    include 'includes/accountdatabase.inc.php';

    
    $sql2="SELECT * FROM unlockedaccounts WHERE  accountname=? AND  useremail=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$row["uploader"],$_SESSION["useremail"]);
    mysqli_stmt_execute($stmt);
    $result2=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row2=mysqli_fetch_assoc($result2);
    $rownum=mysqli_num_rows($result2);

    $sql18="SELECT * FROM unlockedaccounts WHERE  accountname=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql18)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["uploader"]);
    mysqli_stmt_execute($stmt);
    $result18=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum18=mysqli_num_rows($result18);
    $rownum18=currencyFormat($rownum18);

    $sql4="SELECT * FROM intellipreneurs WHERE  accountname=? ;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql4)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["uploader"]);
    mysqli_stmt_execute($stmt);
    $result4=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row4=mysqli_fetch_assoc($result4);
    $id1=$row4["id"];
    if($rownum==0){
        if(!isset($_GET["y"])){
        header("location: subscribe.php?ID=$id1");
        exit();
        }
        
    }

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
    include 'includes/contentdatabase.inc.php';
    $sql5="SELECT * FROM comments  WHERE  videoid=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql5)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["uniqueid"]);
    mysqli_stmt_execute($stmt);
    $result5=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $totalcomments=mysqli_num_rows($result5);

if(isset($_POST["liked"])){
    $univideoid=mysqli_real_escape_string($conn,$_POST["univideoid"]);
    $action=mysqli_real_escape_string($conn,$_POST["action"]);
include 'includes/contentdatabase.inc.php';
switch ($action) {
    case 'like':
        $sql13="INSERT INTO likedvideos(videoid,username) VALUES(?,?);";
        break;
    
    case 'unlike':
        $sql13="DELETE FROM likedvideos WHERE videoid=? and username=?;";
        break;
    default:
        # code...
        break;
}
$stmt=mysqli_stmt_init($conn);
                           
if(!mysqli_stmt_prepare($stmt,$sql13)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt,"ss",$univideoid,$_SESSION["username"]);
mysqli_stmt_execute($stmt);
$result13=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

}


}
?>

<!DOCTYPE html>
<html>
    <head>
    <title><?php echo $row["videotitle"];?></title>
        <link href="css/watchcontent/watch.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <script src="js/p.js" defer></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
        <nav class="flex-div nav">
            <div class="nav-left">
                <label for="check">
                    <i class="fas fa-bars" id="btn" title="Open sidebar"></i>
                  </label>
                <a href="home.php"><img src="images/Logopit_1648978873138.png" id="img"></a>
            </div>
            <div class="nav-middle flex-div" >
                
                <input type="text" class="search" placeholder="Search Recommended Videos" id="search_query" title="Type to live search">
                
                <i class="fas fa-microphone-lines" id="voice-icon" title="Record voice live search"></i>
            </div>
            <div class="nav-right flex-div">
               

                <?php
                        if(isset($_SESSION['username']))
                        {
                            if($rownum11>0)
                            {
                                $imagename=$_SESSION['userimage'];
                                $userName=$row11["accountname"];
                                $profileimage=$row11["profileimage"];
                                $id=$row11["id"];
                                $accountName=$userName;

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
                                <li class='nav-right-icn' > <i class='fa-solid fa-magnifying-glass' id='search'></i></li>
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
                             <li><a  href='includes/logout.inc.php'><i class='fas fa-arrow-right-from-bracket'></i>Log Out</a></li>
                             <br>
                            </ul>
                            </div>
                            ";
                            }
                            else{
                                $imagename=$_SESSION['userimage'];
                                $userName=$_SESSION["username"];
                                $profileimage=$imagename;
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
                <li><a href="home.php"><i class="fas fa-clapperboard"></i>Series</a></li>
                <li><a href="videos.php"><i class="fas fa-video"></i>Videos</a></li>
                <li><a href="music.php"><i class="fas fa-music"></i>Music</a></li>
                <li><a href="podcasts.php"><i class="fa-solid fa-podcast"></i>Podcasts</a></li>
                <li><a href="rooms.php"><i class="fas fa-comments"></i>Cribs</a></li>
                <li><a href="allaccounts.php"><i class="fas fa-user-check"></i>All Channels</a></li>
                <li><a href="unlockedaccounts.php"><i class="fas fa-lock-open"></i>Unlocked Channels</a></li>
                <li><a href="affiliatelinks.php"><i class="bi bi-share-fill"></i>Affiliate Links</a></li>
                <li><a href="trending.php"><i class="fas fa-chart-simple"></i>Trending</a></li>
                <li><a href="schedule.php"><i class="fa-regular fa-calendar-days"></i>My Schedule</a></li>
                <li><a href="reportbugs.php"><i class="fas fa-bug"></i>Report Bugs</a></li>
                <br><br>
            </ul>
        </div>
<div class="ci">
<div class="container-box play-container">
    <div class="row">
        <div class="play-video">  
            <div class="video-container paused"data-volume-level="muted">
                <div class="suggest">
                    <?php
                    if($rownum26 > 0){
                        while($row26=mysqli_fetch_assoc($result26)){
                            $acname=$row26["uploader"];
                            include 'includes/accountdatabase.inc.php';
                            $sql28="SELECT * FROM unlockedaccounts WHERE useremail=? AND accountname=?;";
                            $stmt=mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql28)){
                            header("location: ../signup.php?error=stmtfailed");
                            exit();
                            }

                            mysqli_stmt_bind_param($stmt,"ss",$useremail,$acname);
                            mysqli_stmt_execute($stmt);
                            $result28=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row28=mysqli_fetch_assoc($result28);
                            $rownum28=mysqli_num_rows($result28);
                            if($rownum28 == 0){
                            echo '
                            <form action="includes/views.inc.php" method="POST">
                            <input type="hidden" value="'.$row26["uniqueid"].'" name="uniqueid">
                            <input type="hidden" value="'.$row26["uploader"].'" name="sn">
                            <input type="hidden" value="keyin" name="ky">
                            <input type="image" src="content/videos/thumbnails/'.$row26["directoryname"].'/'.$row26["thumbnail"].'"  class="suggestedthumbnail" name="thumbnail" title="Watch '.$row26["videotitle"].'"">
                            </form>
                            ';
                                
                            }
                        }
                    }
                    include 'includes/contentdatabase.inc.php';
                    ?>
                </div>
                
                <div class="video-controls-container">
                    <div class="timeline-container" title="Seeker">
                        <div class="timeline">
                       
                            <div class="thumb-indicator"></div>
                        </div>
                    </div>
                    <div class="controls">
                        <button class="backward-btn">
                        <i class="bi bi-rewind-circle-fill" title="Rewind 10s"></i>
                        </button>
                        <button class="play-pause-btn">
                            <i id="play" class="fa-solid fa-circle-play" title="Play video"></i>
                            <i id="pause" class="fa-solid fa-circle-pause" title="Pause video"></i>
                        </button>
                        <button class="forward-btn">
                        <i class="bi bi-fast-forward-circle-fill" title="Forward 10s"></i>
                        </button>
                        <div class="duration-container">
                            <div class="current-time">0:00</div>
                            /
                            <div class="total-time"></div>
                        </div>
                        <div class="volume-container">
                            <button><i id="volumeicon" class="fas fa-volume-high"></i></button> 
                            <div class="volumebar">
                                <input type="range" name="" id="volumebar" min="0" value="100" max="100" title="Volume Control">
                                <div class="volumebar2" id="volumebar2">
                                </div>
                                <div class="volumedot" id="volumedot"></div>
                            </div>
                        </div>
                   
                        <button class="link-btn">
                            <?php if($row4["catagory"]=="Podcasts"){
                                    if($rownum24>0 || $podcastname!="None"){
                                ?>
                                <a href="podcasts.php?song=<?php echo "$podcastname"; ?>&c=<?php echo "$podcast"; ?>"><i class="fa-solid fa-podcast"></i></a>
                            <?php
                                    }
                            }
                            elseif($row4["catagory"]=="Music"){
                                if($rownum25>0 || $songname!="None"){
                                ?>
                                <a href="music.php?song=<?php echo "$songname"; ?>&c=<?php echo "$song"; ?>"><i class="fa-solid fa-music"></i></a>
                                <?php
                                }
                            }
                            ?>

                            
                        </button>
                        <?php
                            if(!empty($row["subtitles"]))
                            {

                            
                        ?>
                        <button class="caption-btn">
                             <i class="fa-solid fa-closed-captioning" title="Open Subtitles"></i>
                        </button>

                        <?php
                            }
                        ?>
                        
                        <button class="miniplayer-btn">
                            <i class="bi bi-pip-fill" title="Switch to miniplayer mode"></i>
                        </button>
                        <button class="fullscreen-btn">
                            <i id="fullScreenEnter" class="fa-solid fa-expand" title="Switch to fullscreen mode"></i>
                            <i id="fullScreenExit" class="bi bi-fullscreen-exit" title="Exit fullscreen mode"></i>
                        </button>
                    </div>
                </div>
                
                <?php 
                $dir=$row4["directoryname"];
                $vid = $row["video"];
                $source = "content/videos/$dir/$vid";
                $url=base64_encode(file_get_contents($source));
                ?>
                
                <?php
                $useragent=$_SERVER['HTTP_USER_AGENT'];
                if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
                echo'<video src="'.$source.'" controlslist="nodownload" autoplay>';
                }
                
                else{

                echo'
               <video id="video" oncontextmenu="return false;" controlslist="nodownload" autoplay  type="video/mp4">
               ';
                }
               
                            if(!empty($row["subtitles"]))
                            {

                            
                        ?>
               <track kind="captions" srclang="en" src="content/videos/thumbnails/<?php echo $row4["directoryname"];?>/<?php echo $row["subtitles"];?>" >
               <?php
                            }
                        ?>
                </video>   
             
                 

            </div>
            <script>
                const v = document.getElementById("video");
                    const data = "<?php echo"$source"; ?>";
                    fetch(data)
                    .then(res => res.blob())
                    .then(blob => handler(blob))

                    function handler(blob){
                        const url = URL.createObjectURL(blob);
                        v.setAttribute("src",url);
                        console.log(url);

                    }
                    
                    
                    
            </script>

            <h4 id="videotitle"><?php
             echo $row["videotitle"];?></h4>
            <div class="play-video-info">
                <div class="videoinfo flex-div">
                    <?php 
                        include 'includes/contentdatabase.inc.php';
                        $sql7="SELECT * FROM likedvideos  WHERE  videoid=? and username=?;";
                        $stmt=mysqli_stmt_init($conn);
                   
                        if(!mysqli_stmt_prepare($stmt,$sql7)){
                            header("location: ../signup.php?error=stmtfailed");
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt,"ss",$row["uniqueid"],$_SESSION["username"]);
                        mysqli_stmt_execute($stmt);
                        $result7=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $rownum2=mysqli_num_rows($result7);
                      
                        $sql14="SELECT * FROM likedvideos  WHERE  videoid=?;";
                        $stmt=mysqli_stmt_init($conn);
                   
                        if(!mysqli_stmt_prepare($stmt,$sql14)){
                            header("location: ../signup.php?error=stmtfailed");
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt,"s",$row["uniqueid"]);
                        mysqli_stmt_execute($stmt);
                        $result14=mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $likes=mysqli_num_rows($result14);
                        $totalikes=$likes;
                        $likes=currencyFormat($likes);
                        $videoviews=$row["views"];
                        $videoviews=currencyFormat($videoviews);
                        if($rownum2==1){
                            ?>
                            <i data-id="<?php echo $row["uniqueid"];?>" id="like" class="bi react bi-heart-fill"></i>
                            <?php
                        }
                        
                        else{
                            ?>
                            <i data-id="<?php echo $row["uniqueid"];?>" id="like" class="bi react bi-heart"></i>
                            <?php
                        }
                    ?>
                    <p id="likescount" class="unlockers"><?php echo "$likes";?> Hearts</p>
               
                    <i class="fa-solid reply fa-eye"></i>
                    <p class="unlockers"><?php echo "$videoviews";?> Views </p>
                    <i class="fa-solid reply fa-clock"></i>
                    <p class="unlockers">
                        <?php 
                
                            $time=$row["uploadedtime"];
                            $uploadedtime=uploadedtime($time);
                            echo "$uploadedtime";
                
                        ?>
                    </p>
                    
                    <i class="fa-solid reply fa-share" title="Copy share link" id="shar"></i>
                    <input type="text" id="link" value="localhost/Mirth/login.php?v=<?php echo "$ID";?>">
                    <p id="feedback" class="copied">Link Copied!</p>
                </div>
            </div>
            <hr class="video-border">
            
            <div class="videoinfo secondmargin border">
                    <button id="descriptionbutton"></button>
                    <a href="report.php?v=<?php echo "$ID";?>"><button id="descriptionbutton">Report Issues</button></a>
            </div>
            
            <div class="videoinfo secondmargin border">
                <p id="description"class="description"><?php echo $row["views"];?> Views &bullet; <?php echo "$totalikes";?> Hearts <br> <?php echo $row["videodescription"];?> <br> This video is protected by Mirthh's copyright
            and trademark therefore it can only be posted by the user in this platform.Any repost from other accounts not approved by the 
        owner will result in legal actions being taken.</p>
            </div>

            <hr class="video-border">
            <script>
                const button2=document.getElementById("descriptionbutton");
                const description=document.getElementById("description");
                description.style.display="none";
                button2.innerText="Read Description";  
                button2.addEventListener("click",(event)=>{
                if(description.style.display=="none"){
                    button2.innerText="Close Description";
                    description.style.display="block";  
                }
                else{
                    description.style.display="none";
                    button2.innerText="Read Description";  
                }
                })
            </script>

            <div class="publisher flex-div">
            <?php
                if(isset($_GET["y"])){
                ?>
                    <a href="subscribe.php?ID=<?php echo $row4["id"];?>"><img src="profilepictures/<?php echo $row4["profileimage"];?>" id="publisher-icon" class="publisher-icon" title="Unlock Channel"></a>
                <?php
                }
                else{
                    ?>
                <a href="account.php?ID=<?php echo $row4["id"];?>"><img src="profilepictures/<?php echo $row4["profileimage"];?>" id="publisher-icon" class="publisher-icon" title="Open Channel"></a>
                <?php
                }
                ?>
                <div class="publisher-details unlockers">
                    <div class="verify flex-div">
                    <?php
                if(isset($_GET["y"])){
                ?>
                    <a href="subscribe.php?ID=<?php echo $row4["id"];?>" class="publisher-name " title="Unlock Channel"><?php echo $row["uploader"];?></a>
                    <img src="images/check.png" class="account3" alt="">
                <?php
                }
                else{
                    ?>
                        <a href="account.php?ID=<?php echo $row4["id"];?>" class="publisher-name " title="Open Channel"><?php echo $row["uploader"];?></a>
                        <img src="images/check.png" class="account3" alt="">
                    <?php
                }
                ?>
                    </div>
                    <p class="publisher-followers opacity"><?php echo "$rownum18";?> Unlockers</p>
                    
                </div>
                
            </div>
            <?php
                if(isset($_GET["y"])){
                ?>
                <a href="subscribe.php?ID=<?php echo "$id1";?>"><button id="unlockbutton">Unlock</button></a>
                <?php
                }
                ?>

            <hr class="video-border">

            <div class="commentheader center-div">
                <h2>COMMENTS</h2>
            </div>

            <p class="comment-number"><?php echo "$totalcomments";?> Comments</p>

            <div class="add-comment flex-div">
                <?php
                    if(isset($_SESSION['username']))
                    {
                        $accountholder=$row4["accountholder"];
                        $userfullname=$_SESSION["fullname"];
                        if($accountholder==$userfullname)
                        {
                            $imagename=$row4["profileimage"];
                            $username=$row4["accountname"];
                        }
                        else{
                            $imagename=$_SESSION['userimage'];
                            $username=$_SESSION["username"];
                        }
                        echo "<img class='publisher-icon' src='profilepictures/$profileimage'>
                        ";
                    } 
                ?>

                <form action="includes/comments.inc.php" method="post">
                <div class="cdiv">
                <div class="comment-input">
                    <input class="unlockers" type="text" placeholder="Type Your Comment..." name="comment">
                </div>
                <input type="hidden" name="username" value="<?php
                    
                    echo "$userName";
                ?>">
                 <input type="hidden" name="videoid" value="<?php
                    $videoid=$_GET["watch"];
                    echo "$videoid";
                ?>">
                  <input type="hidden" name="commenttime" value="<?php
                    $commenttime=time();
                    echo "$commenttime";
                ?>">
                <input type="hidden" name="thumbnail" value="<?php
                    
                    echo "$profileimage";
                ?>">
                <button class="unlockers" id="send" name="submit"><i class="fa-solid fa-paper-plane" title="Submit comment"></i></button>
                </form>
                </div>
            </div>

            <?php
                while( $row5=mysqli_fetch_assoc($result5)){
                    $ctime=$row5["commentuploadedtime"];
                    $commentime=uploadedtime($ctime);
                    include 'includes/dbh.inc.php';

                    $sql6="SELECT * FROM users WHERE  usersUid=?;";
                    $stmt=mysqli_stmt_init($conn);
            
                    if(!mysqli_stmt_prepare($stmt,$sql6)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$row5["username"]);
                    mysqli_stmt_execute($stmt);
                    $result6=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row6=mysqli_fetch_assoc($result6);
                    $accountholder=$row4["accountholder"];
                    $userfullname=$_SESSION["fullname"];
                
                    $imagename=$row5["thumbnail"];
                    $name=$row5["username"];
            ?>
            <div class="old-comment">
                <div class="old-comment-details flex-div">
                    <img src="profilepictures/<?php echo "$imagename"; ?>" class="publisher-icon">
                    <?php
                    include 'includes/accountdatabase.inc.php';
                    $sql23="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                    $stmt=mysqli_stmt_init($conn);
                
                    if(!mysqli_stmt_prepare($stmt,$sql23)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$name);
                    mysqli_stmt_execute($stmt);
                    $result23=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row23=mysqli_fetch_assoc($result23);
                    $rownum23=mysqli_num_rows($result23);
                    include 'includes/dbh.inc.php';
                    if($rownum23>0){
                        include 'includes/accountdatabase.inc.php';
                                $sql27="SELECT * FROM unlockedaccounts WHERE  accountname=? AND  useremail=?;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql27)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                                }
                                mysqli_stmt_bind_param($stmt,"ss",$name,$_SESSION["useremail"]);
                                mysqli_stmt_execute($stmt);
                                $result27=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row27=mysqli_fetch_assoc($result27);
                                $rownum27=mysqli_num_rows($result27);
                                include 'includes/dbh.inc.php';
                                ?>
                                <?php
                                if($rownum27 > 0){
                                ?>
                                
                                <div class="verify flex-div">
                                <a href="account.php?ID=<?php echo $row23["id"];?>" class="publisher-name unlockers"><?php echo"$name";?></a>
                                    <img src="images/check.png" class="account3" alt="">
                                </div>
                                <?php
                                }
                                else{
                                    ?>
                                    <div class="verify flex-div">
                                    <a href="subscribe.php?ID=<?php echo $row23["id"];?>" class="publisher-name unlockers"><?php echo"$name";?></a>
                                    <img src="images/check.png" class="account3" alt="">
                                </div>
                                
                                <?php
                                }
                    }
                    else{
                        ?>
                    <h3 class="unlockers"><?php echo "$name"; ?></h3>
                    <?php
                    }
                    ?>
                </div>
                <div class="w">
                   
                    <p class="comment words"><?php echo $row5["commentwords"]; ?>
                    </p>
                    <div class="comment-action">
                        <div class="videoinfo replyinfo flex-div">
                            <?php
                            include 'includes/contentdatabase.inc.php';
                            $sql15="SELECT * FROM likedcomments  WHERE  commentid=? and username=?;";
                            $stmt=mysqli_stmt_init($conn);
                       
                            if(!mysqli_stmt_prepare($stmt,$sql15)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"ss",$row5["id"],$_SESSION["username"]);
                            mysqli_stmt_execute($stmt);
                            $result15=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $rownum15=mysqli_num_rows($result15);
                          
                            $sql16="SELECT * FROM likedcomments  WHERE  commentid=?;";
                            $stmt=mysqli_stmt_init($conn);
                       
                            if(!mysqli_stmt_prepare($stmt,$sql16)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"s",$row5["id"]);
                            mysqli_stmt_execute($stmt);
                            $result16=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $commentlikes=mysqli_num_rows($result16);
                            $commentlikes=currencyFormat($commentlikes);

                            $sql19="SELECT * FROM replies  WHERE  commentid=? ;";
                            $stmt=mysqli_stmt_init($conn);
                       
                            if(!mysqli_stmt_prepare($stmt,$sql19)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt,"s",$row5["id"]);
                            mysqli_stmt_execute($stmt);
                            $result19=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            
                            $replies=mysqli_num_rows($result19);
                            $replies=currencyFormat($replies);
                            if($rownum15==1){
                            ?>
                                <i commentdata-id="<?php echo $row["uniqueid"];?>" name="<?php echo $row5["id"];?>" id="<?php echo $row5["id"];?>" class="bi  react bi-heart-fill"></i>
                            <?php
                            }
                            
                            else{
                            ?>
                                <i commentdata-id="<?php echo $row["uniqueid"];?>" name="<?php echo $row5["id"];?>" id="<?php echo $row5["id"];?>" class="bi comment react bi-heart"></i>
                            <?php
                                }
                            ?>
                        
                            <p class="unlockers"><?php echo "$commentlikes";?> Hearts</p>
                            <i class="fa-solid reply fa-clock"></i>
                            <p class="unlockers"><?php echo "$commentime"; ?></p>
                            <i class="fa-solid reply fa-comment" id="viewbutton<?php echo $row5["id"];?>" title="View Replies"></i>
                            <p class="unlockers"><?php echo "$replies"; ?> Replies</p>
                            <i class="fa-solid reply fa-reply" id="replybutton<?php echo $row5["id"];?>" title="Reply"></i>
                            <?php
                            if($_SESSION["username"]==$name || $_SESSION["fullname"]==$accountholder || $name==$accountName){
                            echo'<form action="includes/deletecomment.inc.php" method="post">
                
                                    <input type="hidden" value="'.$row["uniqueid"].'" name="videoid">
                                    <input type="hidden" value="'.$row5["id"].'" name="commentid">
                                    <button id="trashbtn" type="submit" name="submit"><i class="fa-solid bin fa-trash"></i></button>
                                </form>';
                            }
                            ?>
                        </div>
                    </div>
                    <hr class="video-border">
                </div>
            </div>
            <?php
                if(isset($_SESSION['username']))
                {
                    $accountholder=$row4["accountholder"];
                    $userfullname=$_SESSION["fullname"];
                    if($accountholder==$userfullname)
                    {
                        $imagename1=$row4["profileimage"];
                        $username1=$row4["accountname"];
                    }
                    else{
                        $imagename1=$_SESSION['userimage'];
                        $username1=$_SESSION["username"];
                    }
                   
                } 
            ?>
            <div id="reply<?php echo $row5["id"];?>" class="add-comment">
                <form action="includes/reply.inc.php" method="post">
                    <div class="cdiv">
                    <div class="comment-input">
                        <input class="unlockers" type="text" placeholder="Type Your Reply To This Comment..." name="reply">
                    </div>
                    <input type="hidden" name="username" value="<?php
                    
                        echo "$userName";
                    ?>">
                    <input type="hidden" name="commentid" value="<?php
                        $commentid=$row5["id"];
                        echo "$commentid";
                    ?>">
                    <input type="hidden" name="replytime" value="<?php
                        $replytime=time();
                        echo "$replytime";
                    ?>">
                    <input type="hidden" name="thumbnail" value="<?php
                    
                        echo "$profileimage";
                    ?>">
                    <input type="hidden" name="videoid" value="<?php
                        $videoid=$_GET["watch"];
                        echo "$videoid";
                    ?>">
                    <button class="unlockers" id="send" name="send"><i class="fa-solid fa-paper-plane" title="Submit Reply"></i></button>
                    </div>
                </form>
            </div>

            <div id="view<?php echo $row5["id"];?>">
                <?php
                
                    while ($row19=mysqli_fetch_assoc($result19)) {
                        $rtime=$row19["replyuploadedtime"];
                        $replyuploadedtime=uploadedtime($rtime);
                        $imagename2=$row19["thumbnail"];
                        $name2=$row19["username"];
                    ?>
                
                    <div  class="old-comment">
                        <div class="old-comment-details flex-div">
                            <img src="profilepictures/<?php echo "$imagename2"; ?>" class="publisher-icon">
                            <?php
                            include 'includes/accountdatabase.inc.php';
                            $sql23="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);
                        
                            if(!mysqli_stmt_prepare($stmt,$sql23)){
                            header("location: ../signup.php?error=stmtfailed");
                            exit();
                            }
                            mysqli_stmt_bind_param($stmt,"s",$name2);
                            mysqli_stmt_execute($stmt);
                            $result23=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row23=mysqli_fetch_assoc($result23);
                            $rownum23=mysqli_num_rows($result23);
                            include 'includes/dbh.inc.php';
                            if($rownum23>0){
                                include 'includes/accountdatabase.inc.php';
                                $sql27="SELECT * FROM unlockedaccounts WHERE  accountname=? AND  useremail=?;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql27)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                                }
                                mysqli_stmt_bind_param($stmt,"ss",$name2,$_SESSION["useremail"]);
                                mysqli_stmt_execute($stmt);
                                $result27=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $row27=mysqli_fetch_assoc($result27);
                                $rownum27=mysqli_num_rows($result27);
                                include 'includes/dbh.inc.php';
                            ?>
                            <?php
                            if($rownum27 > 0){
                            ?>
                            
                            <div class="verify flex-div">
                            <a href="account.php?ID=<?php echo $row23["id"];?>" class="publisher-name unlockers"><?php echo"$name2";?></a>
                                <img src="images/check.png" class="account3" alt="">
                            </div>
                            <?php
                            }
                            else{
                                ?>
                                <div class="verify flex-div">
                                <a href="subscribe.php?ID=<?php echo $row23["id"];?>" class="publisher-name unlockers"><?php echo"$name2";?></a>
                                <img src="images/check.png" class="account3" alt="">
                            </div>
                            
                            <?php
                            }
                            }
                            else{
                                ?>
                            <h3 class="unlockers"><?php echo "$name2"; ?></h3>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="w">
                            <p class="comment words"><?php echo $row19["replywords"]; ?>
                            </p>
                            <div class="comment-action">
                                <div class="videoinfo flex-div">
                                
                                <?php

                                    include 'includes/contentdatabase.inc.php';
                                    $sql20="SELECT * FROM likedreplies  WHERE  replyid=? and username=?;";
                                    $stmt=mysqli_stmt_init($conn);

                                    if(!mysqli_stmt_prepare($stmt,$sql20)){
                                        header("location: ../signup.php?error=stmtfailed");
                                        exit();
                                    }
                                    mysqli_stmt_bind_param($stmt,"ss",$row19["id"],$_SESSION["username"]);
                                    mysqli_stmt_execute($stmt);
                                    $result20=mysqli_stmt_get_result($stmt);
                                    mysqli_stmt_close($stmt);
                                    $rownum20=mysqli_num_rows($result20);

                                    $sql21="SELECT * FROM likedreplies  WHERE  replyid=?;";
                                    $stmt=mysqli_stmt_init($conn);

                                    if(!mysqli_stmt_prepare($stmt,$sql21)){
                                        header("location: ../signup.php?error=stmtfailed");
                                        exit();
                                    }
                                    mysqli_stmt_bind_param($stmt,"s",$row19["id"]);
                                    mysqli_stmt_execute($stmt);
                                    $result21=mysqli_stmt_get_result($stmt);
                                    mysqli_stmt_close($stmt);
                                    $replylikes=mysqli_num_rows($result21);
                                    $replylikes=currencyFormat($replylikes);

                                    if($rownum20==1){
                                    ?>
                                        <i replydata-id="<?php echo $row["uniqueid"];?>" name="d<?php echo $row19["id"];?>" id="<?php echo $row19["id"];?>" class="bi reply react bi-heart-fill"></i>
                                        <?php
                                    }
                                    
                                    else{
                                    ?>
                                        <i replydata-id="<?php echo $row["uniqueid"];?>" name="d<?php echo $row19["id"];?>" id="<?php echo $row19["id"];?>" class="bi reply react bi-heart"></i>
                                        <?php
                                   }
                                    ?>
                                    <p class="unlockers"><?php echo "$replylikes"; ?> Hearts  </p>
                                    <i class="fa-solid reply fa-clock"></i>
                                    <p class="unlockers"><?php echo "$replyuploadedtime"; ?></p></p>
                                    <?php
                                    if($_SESSION["username"]==$name2 || $_SESSION["fullname"]==$accountholder || $name2==$accountName){
                                        echo'<form action="includes/deletereply.inc.php" method="post">
                    
                                        <input type="hidden" value="'.$row["uniqueid"].'" name="videoid">
                                        <input type="hidden" value="'.$row19["id"].'" name="replyid">
                                        <button id="trashbtn" type="submit" name="submit"><i class="fa-solid fa-trash"></i></button>
                                        </form>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <hr class="video-border">
                        </div> 
                    </div>
                    <?php
                    }
                ?>
              
            </div>
     
            <script>
                const butn<?php echo $row5["id"];?>=document.getElementById("replybutton<?php echo $row5["id"];?>");
                const reply<?php echo $row5["id"];?>=document.getElementById("reply<?php echo $row5["id"];?>");
                reply<?php echo $row5["id"];?>.style.display="none";
                butn<?php echo $row5["id"];?>.addEventListener("click",(event)=>{
                    if(reply<?php echo $row5["id"];?>.style.display=="none"){
                        reply<?php echo $row5["id"];?>.style.display="block";  
                    }
                    else{
                        reply<?php echo $row5["id"];?>.style.display="none";  
                    }
                })

                const btn<?php echo $row5["id"];?>=document.getElementById("viewbutton<?php echo $row5["id"];?>");
                const view<?php echo $row5["id"];?>=document.getElementById("view<?php echo $row5["id"];?>");
                view<?php echo $row5["id"];?>.style.display="none";
                btn<?php echo $row5["id"];?>.addEventListener("click",(event)=>{
                    if(view<?php echo $row5["id"];?>.style.display=="none"){
                        view<?php echo $row5["id"];?>.style.display="block";  
                    }
                    else{
                        view<?php echo $row5["id"];?>.style.display="none";  
                    }
                })
                
            </script>
          
            <?php
                }
            ?>
        </div> 
        <div class="right-sidebar">
                <div class="recomendedvideosheader center-div">
                    <h2>RECOMMENDED VIDEOS</h2>
                </div>
            <div class="videocontainer">
                <?php

                    include 'includes/contentdatabase.inc.php';
                    $sql3="SELECT * FROM videos ORDER BY RAND();";
                    $data=mysqli_query($conn,$sql3);
                    while($row3=mysqli_fetch_assoc($data)){
                        include "includes/accountdatabase.inc.php";
                            $sql22="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql22)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_bind_param($stmt,"s",$row3["uploader"]);
                            mysqli_stmt_execute($stmt);
                            $result22=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row22=mysqli_fetch_assoc($result22);
                            
                            include "includes/contentdatabase.inc.php";
                            $videotitle=$row3["videotitle"];
                            $thumbnail=$row3["thumbnail"];
                            $uploader=$row3["uploader"];
                            $uniqueid=$row3["uniqueid"];
                            $directoryname=$row22["directoryname"];
                            $views=$row3["views"];
                            $uptime=$row3["uploadedtime"];
                            $ptime=uploadedtime($uptime);
                            $views=currencyFormat($views);
                            if($row["genre"]==$row3["genre"])
                            {
                            
                            echo "
                            <form action='includes/views.inc.php' method='POST'>
                                <div class='side-video-list'>
                                    <input type='hidden' value='$uniqueid' name='uniqueid'>
                                    <input type='image' src='content/videos/thumbnails/$directoryname/$thumbnail' class='small-thumbnail' id='small-thumbnail' title='Watch $videotitle' >
                           
                                    <div class='vid-info'>
                                        <div class='recviddesc'>
                                        <p>$videotitle</p>
                                        <br>
                                        </div>
                                      
                                        <div class='dv'>
                                        <div class='verification'>
                                        <div class='updesc'>
                                        <p class='opacity' title='$uploader'>$uploader</p>
                                        </div>
                                        <img src='images/check.png' class='account3'>
                                        </div> 
                                        <div class='updesc'>
                                        <p class='opacity'>$views Views &bullet; $ptime</p>
                                        </div> 
                                        </div>   
                                    </div>
                                </div>
                            </form>
                            ";
                        }
                    }
                ?>
            </div> 
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
                <a href="trending.php"><i  class="fas fa-chart-simple"></i></a>
                <p >Trending</p>
            </div>
        </li>       
        </ul>
        </div> 
<script>
    $(document).ready(function(){

//when user clicks video play button

$('#like').on('click',function(){
    var actio;
    var post_id = $(this).data('id');
    $clicked_btn = $(this);
    
    //check whether user is liking or unliking

    if ($clicked_btn.hasClass('bi react bi-heart')) {
        actio = 'like';
    }
    else if ($clicked_btn.hasClass('bi react bi-heart-fill')) {
        actio = 'unlike';
    } 

    //ajax code

    $.ajax({
        url: `watchcontent.php?watch=${post_id}`,
        type: 'post',
        data: {
            'liked': 'view',
            'action': actio,
            'univideoid': post_id
        },
        success: function(data) {
            
            if (actio == 'like') {
                $clicked_btn.removeClass('bi react bi-heart');
                $clicked_btn.addClass('bi react bi-heart-fill');
            }
            else if (actio == 'unlike') {
                $clicked_btn.removeClass('bi react bi-heart-fill');
                $clicked_btn.addClass('bi react bi-heart');
            } 
            
        }
    })

})



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
                        url: 'livesearchrecommended.php',
                        type:'post',
                        data: {query: search},
                        success:function(data){
                            $(".videocontainer").html(data);
                        }
                    })
                    }
   
                })
                }
            }
            else{
                voiceicon.classList.remove("fa-microphone-lines");
            }
            const texts = document.querySelector('#link');
    const shareBtn=document.querySelector('#shar');
    const feedback=document.querySelector('#feedback');
    shareBtn.addEventListener('click',function(){
        texts.select();
        document.execCommand('copy');
        feedback.classList.remove('copied');
        setTimeout(function(){
            feedback.classList.add('copied');
        }, 2500);
    })
  
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
Array.from(document.getElementsByClassName('comment')).forEach((element)=>{
    element.addEventListener('click', (e)=>{
        index=e.target.id;
       
        $(document).ready(function(){
       
    var action;
    var comment_id = index;
 
    $comment_btn = $(`[name=${index}]`);
    
    //check whether user is liking or unliking
    if ($comment_btn.hasClass('bi comment react bi-heart')) {
        action = 'like';
    }
    else if ($comment_btn.hasClass('bi comment react bi-heart-fill')) {
        action = 'unlike';
    } 

    //ajax code

    $.ajax({
        url: 'updatecomments.php',
        type: 'post',
        data: {
            'commentliked': 'view',
            'action': action,
            'commentid': comment_id
        },

        success: function(data) {
            
            if (action == 'like') {
                $comment_btn.removeClass('bi comment react bi-heart');
                $comment_btn.addClass('bi comment react bi-heart-fill');
            }
            else if (action == 'unlike') {
                $comment_btn.removeClass('bi comment react bi-heart-fill');
                $comment_btn.addClass('bi comment react bi-heart');
            } 
            
        }
        
    })
    

})


        
    })
})

Array.from(document.getElementsByClassName('reply')).forEach((element)=>{
    element.addEventListener('click', (e)=>{
        index=e.target.id;
       
        $(document).ready(function(){
       
    var act;
    var reply_id = index;
 
    $reply_btn = $(`[name=d${index}]`);
    
    //check whether user is liking or unliking
    if ($reply_btn.hasClass('bi reply react bi-heart')) {
        act = 'like';
    }
    else if ($reply_btn.hasClass('bi reply react bi-heart-fill')) {
        act = 'unlike';
    } 

    //ajax code

    $.ajax({
        url: 'updatereplies.php',
        type: 'post',
        data: {
            'replyliked': 'view',
            'action': act,
            'replyid': reply_id
        },

        success: function(data) {
            
            if (act == 'like') {
                $reply_btn.removeClass('bi reply react bi-heart');
                $reply_btn.addClass('bi reply react bi-heart-fill');
            }
            else if (act == 'unlike') {
                $reply_btn.removeClass('bi reply react bi-heart-fill');
                $reply_btn.addClass('bi reply react bi-heart');
            } 
            
        }
        
    })
    

})
     
    })
})
</script>

<script>
    $(document).ready(function(){

//when user searches for content


$("#search_query").keyup(function(){
    var search = $(this).val();
    
    if (search != " ") {
         $.ajax({
        url: 'livesearchrecommended.php',
        type:'post',
        data: {query: search},
        success:function(data){
            $(".videocontainer").html(data);
        }
    })
    }
   
})



})
</script>

<script>
    $(function() {
    var timer;
    var fadeInBuffer = false;
    $('.video-container').mousemove(function() {
        if (!fadeInBuffer && timer) {
            console.log("clearTimer");
            clearTimeout(timer);
            timer = 0;

            console.log("fadeIn");
            $('html').css({
                cursor: ''
            });
        } else {
            $('.video-container').css({
                cursor: 'default'
            });
            $('.video-controls-container').css({
                opacity: 1
            });
            fadeInBuffer = false;
        }


        timer = setTimeout(function() {
            console.log("fadeout");
            $('.video-container').css({
                cursor: 'none'
            });
            $('.video-controls-container').css({
                opacity: 0
            });

            fadeInBuffer = true;
        }, 2000)
    });
    $('.video-container').css({
        cursor: 'default'
    });
    $('.video-controls-container').css({
        opacity: 1
    });
});
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
