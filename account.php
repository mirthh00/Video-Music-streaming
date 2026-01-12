<?php
session_start();
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

if(isset($_GET["ID"]))
{
    include 'includes/accountdatabase.inc.php';
    $useremail=$_SESSION["useremail"];
$username=$_SESSION["username"];
$theme=$_SESSION["theme"];
if($theme == 'light'){
    $color="white-theme";
}
else{
    $color="dark-theme";
}
   
    $ID=mysqli_real_escape_string($conn,$_GET["ID"]);
    $sql="SELECT * FROM intellipreneurs WHERE id=$ID;";
    $data=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($data);
    $sql2="SELECT * FROM unlockedaccounts WHERE accountid=$ID;";
    $data2=mysqli_query($conn,$sql2);
    $row2=mysqli_num_rows($data2);
    $row2 = currencyFormat($row2);
    include 'includes/contentdatabase.inc.php';
    $sql3="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql3)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result3=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum2=mysqli_num_rows($result3);
    $rownum2 = currencyFormat($rownum2);
    $sql13="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql13)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result13=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum13=mysqli_num_rows($result13);

    $sql21="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql21)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result21=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum21=mysqli_num_rows($result21);

    $sql14="SELECT * FROM albums WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql14)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result14=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum14=mysqli_num_rows($result14);
    $rownum14 = currencyFormat($rownum14);

    $sql15="SELECT * FROM music WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql15)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result15=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum15=mysqli_num_rows($result15);
    $rownum15 = currencyFormat($rownum15);
    $sql22="SELECT * FROM podcasts WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql22)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result22=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum22=mysqli_num_rows($result22);
    $rownum22 = currencyFormat($rownum22);
    include 'includes/accountdatabase.inc.php';
    $sql4="SELECT * FROM rooms WHERE  roomname=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql4)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result4=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row4=mysqli_fetch_assoc($result4);
    $rownum3=mysqli_num_rows($result4);

    include 'includes/contentdatabase.inc.php';
    $sql6="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql6)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result6=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum6=mysqli_num_rows($result6);

    include 'includes/contentdatabase.inc.php';
    $sql7="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql7)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result7=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum7=mysqli_num_rows($result7);

    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $row["accountname"]; ?></title>
        <link href="css/account/account.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="profilepictures/<?php echo $row["profileimage"];?>">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <meta lang="en" charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body class="<?php echo "$color";?>">
    
        <div class="coverbanner">
            <img class="cover" src="intelliprenuercoverpictures/<?php echo $row["coverimage"];?>" alt="">
            <div class="pd">

            <div class="pdn">
            <img class="profile" src="profilepictures/<?php echo $row["profileimage"];?>">
            <div class="details">
                <div class="d">
                <div class="tv">
                    <h1><?php echo $row["accountname"];?><img src="images/check.png" alt=""></h1>
                    
                </div>
                
                <?php 
                    if($row["catagory"]=="Music"){
                        
                        echo '<p>'.$row2.' Unlockers | '.$rownum2.' Music Videos | '.$rownum14.' Albums | '.$rownum15.' Songs ';
                    }
                    else if($row["catagory"]=="Podcasts"){
                        echo '<p>'.$row2.' Unlockers | '.$rownum2.' Podcasts Videos | '.$rownum22.' Podcasts ';
                    }
                    else{
                        echo '<p>'.$row2.' Unlockers | '.$rownum2.' Videos';
                    }
                ?>
                </div>
            </div>
            </div>
            </div>
        </div>
        <div class="navigation">
            <ul>
            <li><a href="home.php">Home</a></li>
                <li id="home"><a href="#" >content</a></li>
                <?php
                if($rownum3>0){
                   echo  '<li><a href="fansroom.php?r='.$row4["roomid"].'">Room</a></li>';
                    if($row["accountholder"]==$_SESSION["fullname"]){

                    echo'
                            <li><a href="advertise.php?a='.$ID.'&r='.$row4["roomid"].'">Advertise</a></li>

                            <li><a href="bio.php?a='.$ID.'&r='.$row4["roomid"].'">About</a></li>
                            
                   ';
                    }
                    else{
                        echo'
                        <li><a href="rate.php?a='.$ID.'">Rate</a></li>

                        <li><a href="bio.php?a='.$ID.'&r='.$row4["roomid"].'">About</a></li>
                        
               ';
                    }
                }
                else{
                    if($row["accountholder"]==$_SESSION["fullname"]){
                    echo  '<li><a href="#">Room</a></li>
                            <li><a href="advertise.php?a='.$ID.'">Advertise</a></li>
                            <li><a href="bio.php?a='.$ID.'">About</a></li>
                            
                    ';
                    }
                    else{
                        echo  '<li><a href="#">Room</a></li>
                        <li><a href="rate.php?a='.$ID.'">Rate</a></li>
                        <li><a href="bio.php?a='.$ID.'">About</a></li>
                        
                ';
                    }
                }
                ?>
                
            </ul>
        </div>
        <br><br>
        <div class="contentcatagory">
            <h1><?php echo $row["genre"]; ?> <?php echo $row["catagory"]; ?></h1>
        </div>
        <br><br>


<?php
if($row["catagory"]=="Music"){
    ?>
        <div class="contentcatagory">
            <h1>Music Videos</h1>
        </div>
        <br><br>
        <div class="contentcontainer">
        <?php
            while($row13=mysqli_fetch_assoc($result13)){
                $time=$row13["uploadedtime"];
                $musicviews = $row13["views"];
                $musicviews = currencyFormat($musicviews);
                $uploadedtime=uploadedtime($time);
                $uploader=$row["accountholder"];
                $fullname=$_SESSION["fullname"];
                include "includes/accountdatabase.inc.php";
                            $sql19="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql19)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_bind_param($stmt,"s",$row13["uploader"]);
                            mysqli_stmt_execute($stmt);
                            $result19=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row19=mysqli_fetch_assoc($result19);
                            
                            include "includes/contentdatabase.inc.php";
                if($uploader==$fullname)
                    {
                        echo' <div class="video">
                    <form action="watchcontent.php?watch='.$row13["uniqueid"].'" method="POST">
                    <input type="hidden" value="'.$row13["uniqueid"].'" name="uniqueid">
                    <input type="image" src="content/videos/thumbnails/'.$row19["directoryname"].'/'.$row13["thumbnail"].'" class="thumbnail" name="thumbnail">
                    </form>
                    <p class="videodescription">
                    '.$row13["videotitle"].'
                    </p>
                    <div class="boostbtn">
                    <a href="boost.php?a='.$ID.'&r='.$row4["roomid"].'&v='.$row13["uniqueid"].'"><button>Boost Video</button></a>
                    </div>
                    <div class="videodetails">
                        <div class="videoinfo">
                            <p class="videoviews" id="time">'.$musicviews.' Views &bullet; '.$uploadedtime.'</p>
                        </div>
                        <form action="includes/deletevideo.inc.php" method="post">
                        <input type="hidden" value="'.$row13["uniqueid"].'" name="uniqueid">
                        <input type="hidden" value="'.$row13["video"].'" name="video">
                        <input type="hidden" value="'.$row13["thumbnail"].'" name="thumbnail">
                        <input type="hidden" value="'.$ID.'" name="accountid">
                        <input type="hidden" value="'.$row19["directoryname"].'" name="directoryname">
                        <button id="trashbtn" type="submit" name="submit"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                    </div>
                    '; 
                    }
                    else{
                        echo' <div class="video">
                        <form action="includes/views.inc.php" method="POST">
                        <input type="hidden" value="'.$row13["uniqueid"].'" name="uniqueid">
                        <input type="image" src="content/videos/thumbnails/'.$row19["directoryname"].'/'.$row13["thumbnail"].'" class="thumbnail" name="thumbnail">
                        </form>
                        <p class="videodescription">
                        '.$row13["videotitle"].'
                        </p>
                        <div class="videodetails flex-div">
                           
                            <div class="videoinfo">
                                <p class="videoviews">'.$musicviews.' Views &bullet; '.$uploadedtime.'</p>
                            </div>
                        </div>
                        </div>
                        ';
                    }
                }
        ?>
            
        </div>
        <br><br><br><br>
        <div class="contentcatagory">
            <h1>Albums</h1>
        </div>
        <div class="contentcontainer">
            <?php
            while($row14=mysqli_fetch_assoc($result14)){
                    $albumtitle=$row14["albumtitle"];
                    $albumcover=$row14["albumcover"];
                    $sql17="SELECT * FROM music WHERE  albumtitle=? ORDER BY id DESC;";
                    $stmt=mysqli_stmt_init($conn);
                
                    if(!mysqli_stmt_prepare($stmt,$sql17)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$albumtitle);
                    mysqli_stmt_execute($stmt);
                    $result17=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row17=mysqli_fetch_assoc($result17);
                    $rownum17=mysqli_num_rows($result17);
                    $albumtime=$row17["uploadedtime"];
                    $albumuploadedtime=uploadedtime($albumtime);
                    $albumstreams=$row17["streams"];
                    $totalalbumstreams = 0;
                    $totalalbumstreams = $totalalbumstreams+$albumstreams;
                    $totalalbumstreams = currencyFormat($totalalbumstreams);
                ?>
            <div class="video">
                <form action="redirectartist.php" method="post">
                    <input type="hidden" value="<?php echo "$albumtitle";?>" name="albumtitle">
                    <input type="image" src="music/covers/<?php echo "$albumcover"; ?>" class="albumcover">
                </form>
                
                <p class="videodescription"><?php echo "$albumtitle"; ?> | <?php echo "$rownum17"; ?> Songs
                </p>
                <div class="videodetails flex-div">
                    <div class="videoinfo">
                        <p class="videoviews opacity"><?php echo "$totalalbumstreams"; ?> Streams &bullet; <?php echo "$albumuploadedtime"; ?></p>
                    </div>
                  
                </div>
            </div>
            <?php
            }
            ?>
            
    </div>

        <br><br><br><br>
        <div class="contentcatagory">
            <h1>Songs</h1>
        </div>
        <br><br>
        <div class="contentcontainer">
        <?php
            while($row15=mysqli_fetch_assoc($result15)){
                    $songid=$row15["song"];
                    $songtitle=$row15["songtitle"];
                    $artists=$row15["artists"];
                    $streams=$row15["streams"];
                    $streams = currencyFormat($streams);
                    $uploadedtime2=$row15["uploadedtime"];
                    $time2=uploadedtime($uploadedtime2);
                    $artist=$row15["uploader"];
                    include 'includes/contentdatabase.inc.php';
                    $sql16="SELECT * FROM likedmusic WHERE  songid=?;";
                    $stmt=mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt,$sql16)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$songid);
                    mysqli_stmt_execute($stmt);
                    $result16=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $rownum16=mysqli_num_rows($result16);

                    include 'includes/accountdatabase.inc.php';
                    $sql20="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                    $stmt=mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt,$sql20)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$artist);
                    mysqli_stmt_execute($stmt);
                    $result20=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $rownum20=mysqli_num_rows($result20);
                    $row20=mysqli_fetch_assoc($result20);
                    $accountholder=$row20["accountholder"];
                    $userfullname=$_SESSION["fullname"];
                    if($accountholder==$userfullname){   
                ?>
            <div class="video">
                <form action="redirect.php" method="post">
                    <input type="hidden" value="<?php echo "$songtitle";?>" name="songid">
                    <input type="hidden" value="<?php echo "$songid";?>" name="id">
                    <input type="image" src="music/covers/<?php echo "$songid"; ?>.jpg" class="albumcover">  
                </form>
                <p class="videodescription"><?php echo "$songtitle"; ?>
                </p>
                <div class="videodetails flex-div">
                  
                    <div class="videoinfo">
                        <p class="videoviews opacity"><?php echo "$artists"; ?></p>
                        <p class="videoviews opacity" ><?php echo "$streams"; ?> Streams &bullet; <?php echo "$rownum16"; ?> Hearts &bullet; <?php echo "$time2"; ?></p>
                    </div>
                    <form action="includes/deletesong.inc.php" method="post">
                        <input type="hidden" name="songid" value="<?php echo "$songid"; ?>">
                        <input type="hidden" name="accountid" value="<?php echo "$ID"; ?>">
                        <button id="trashbtn" type="submit" name="delete"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
            <?php
                    }
                    else{
                        ?>
                            <div class="video">
                <form action="redirect.php" method="post">
                    <input type="hidden" value="<?php echo "$songtitle";?>" name="songid">
                    <input type="hidden" value="<?php echo "$songid";?>" name="id">
                    <input type="image" src="music/covers/<?php echo "$songid"; ?>.jpg" class="albumcover">  
                </form>
                <p class="videodescription"><?php echo "$songtitle"; ?>
                </p>
                <div class="videodetails flex-div">
                  
                    <div class="videoinfo">
                        <p class="videoviews"><?php echo "$artists"; ?></p>
                        <p class="videoviews opacity"><?php echo "$streams"; ?> Streams &bullet; <?php echo "$rownum16"; ?> Hearts &bullet; <?php echo "$time2"; ?></p>
                    </div>
                   
                </div>
            </div>
                        <?php
                    }
            }
            ?>
          

        </div>
        <br><br>
<?php
}
else if($row["catagory"]=="Podcasts"){

?>
  <div class="contentcatagory">
            <h1>Podcast Videos</h1>
    </div>
    <div class="contentcontainer">
        <?php
            while($row21=mysqli_fetch_assoc($result21)){
                $time=$row21["uploadedtime"];
                $podcastviews = $row21["views"];
                $podcastviews = currencyFormat($podcastviews);
                $uploadedtime=uploadedtime($time);
                $uploader=$row["accountholder"];
                $fullname=$_SESSION["fullname"];
                include "includes/accountdatabase.inc.php";
                            $sql19="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql19)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_bind_param($stmt,"s",$row21["uploader"]);
                            mysqli_stmt_execute($stmt);
                            $result19=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row19=mysqli_fetch_assoc($result19);
                            
                            include "includes/contentdatabase.inc.php";
                if($uploader==$fullname)
                    {
                        echo' <div class="video">
                    <form action="watchcontent.php?watch='.$row21["uniqueid"].'" method="POST">
                    <input type="hidden" value="'.$row21["uniqueid"].'" name="uniqueid">
                    <input type="image" src="content/videos/thumbnails/'.$row19["directoryname"].'/'.$row21["thumbnail"].'" class="thumbnail" name="thumbnail">
                    </form>
                    <p class="videodescription">
                    '.$row21["videotitle"].'
                    </p>
                    <div class="boostbtn">
                    <a href="boost.php?a='.$ID.'&r='.$row4["roomid"].'&v='.$row21["uniqueid"].'"><button>Boost Video</button></a>
                    </div>
                    <div class="videodetails">
                        <div class="videoinfo">
                            <p class="videoviews">'.$row21["views"].' Views | '.$uploadedtime.'</p>
                        </div>
                        <form action="includes/deletevideo.inc.php" method="post">
                        <input type="hidden" value="'.$row21["uniqueid"].'" name="uniqueid">
                        <input type="hidden" value="'.$row21["video"].'" name="video">
                        <input type="hidden" value="'.$row21["thumbnail"].'" name="thumbnail">
                        <input type="hidden" value="'.$ID.'" name="accountid">
                        <input type="hidden" value="'.$row19["directoryname"].'" name="directoryname">
                        <button id="trashbtn" type="submit" name="submit"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                    </div>
                    '; 
                    }
                    else{
                        echo' <div class="video">
                        <form action="includes/views.inc.php" method="POST">
                        <input type="hidden" value="'.$row21["uniqueid"].'" name="uniqueid">
                        <input type="image" src="content/videos/thumbnails/'.$row19["directoryname"].'/'.$row21["thumbnail"].'" class="thumbnail" name="thumbnail">
                        </form>
                        <p class="videodescription">
                        '.$row21["videotitle"].'
                        </p>
                        <div class="videodetails flex-div">
                           
                            <div class="videoinfo">
                                <p class="videoviews" id="time">'.$podcastviews.' Views &bullet; '.$uploadedtime.'</p>
                            </div>
                        </div>
                        </div>
                        ';
                    }
                }
        ?>
            
        </div>

        <br><br><br><br>
        <div class="contentcatagory">
            <h1>Podcast Audio</h1>
        </div>

        <div class="contentcontainer">
        <?php
            while($row22=mysqli_fetch_assoc($result22)){
                    $songid=$row22["podcast"];
                    $songtitle=$row22["songtitle"];
                    $artists=$row22["artists"];
                    $streams=$row22["streams"];
                    $streams = currencyFormat($streams);
                    $uploadedtime2=$row22["uploadedtime"];
                    $time2=uploadedtime($uploadedtime2);
                    $artist=$row22["uploader"];
                    include 'includes/contentdatabase.inc.php';
                    $sql16="SELECT * FROM likedpodcasts WHERE  podcastid=?;";
                    $stmt=mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt,$sql16)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$songid);
                    mysqli_stmt_execute($stmt);
                    $result16=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $rownum16=mysqli_num_rows($result16);
                    $rownum16 = currencyFormat($rownum16);
                    include 'includes/accountdatabase.inc.php';
                    $sql20="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                    $stmt=mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt,$sql20)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$artist);
                    mysqli_stmt_execute($stmt);
                    $result20=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $rownum20=mysqli_num_rows($result20);
                    $row20=mysqli_fetch_assoc($result20);
                    $accountholder=$row20["accountholder"];
                    $userfullname=$_SESSION["fullname"];
                    if($accountholder==$userfullname){   
                ?>
            <div class="video">
                <form action="redirectpodcasts.php" method="post">
                    <input type="hidden" value="<?php echo "$songtitle";?>" name="songid">
                    <input type="hidden" value="<?php echo "$songid";?>" name="id">
                    <input type="image" src="podcasts/covers/<?php echo "$songid"; ?>.jpg" class="albumcover">  
                </form>
                <p class="videodescription">
                    <?php echo "$songtitle"; ?>
                </p>
                <div class="videodetails flex-div">
                  
                    <div class="videoinfo">
                        <p class="videoviews"><?php echo "$artists"; ?></p>
                        <p class="videoviews"><?php echo "$streams"; ?> Streams &bullet; <?php echo "$rownum16"; ?> Hearts &bullet; <?php echo "$time2"; ?></p>
                    </div>
                    <form action="includes/deletepodcast.inc.php" method="post">
                        <input type="hidden" name="songid" value="<?php echo "$songid"; ?>">
                        <input type="hidden" name="accountid" value="<?php echo "$ID"; ?>">
                        <button id="trashbtn" type="submit" name="delete"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
            <?php
                    }
                    else{
                        ?>
            <div class="video">
                <form action="redirectpodcasts.php" method="post">
                    <input type="hidden" value="<?php echo "$songtitle";?>" name="songid">
                    <input type="hidden" value="<?php echo "$songid";?>" name="id">
                    <input type="image" src="podcasts/covers/<?php echo "$songid"; ?>.jpg" class="albumcover">  
                </form>
                <p class="videodescription"><?php echo "$songtitle";?>
                </p>
                <div class="videodetails flex-div">
                    <div class="videoinfo">
                        <p class="videoviews"><?php echo "$artists"; ?></p>
                        <p class="videoviews" id="time"><?php echo "$streams"; ?> Streams &bullet; <?php echo "$rownum16"; ?> Hearts &bullet; <?php echo "$time2"; ?></p>
                    </div>
                   
                </div>
            </div>
                        <?php
                    }
            }
            ?>
          

        </div>
        <br><br>
<?php
}
else{
    ?>

<div class="contentcontainer">
            <?php
            while($row3=mysqli_fetch_assoc($result3)){
                $time=$row3["uploadedtime"];
                $uploadedtime=uploadedtime($time);
                $uploader=$row["accountholder"];
                $fullname=$_SESSION["fullname"];
                $views = $row3["views"];
                $views = currencyFormat($views);
                include "includes/accountdatabase.inc.php";
                            $sql18="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql18)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_bind_param($stmt,"s",$row3["uploader"]);
                            mysqli_stmt_execute($stmt);
                            $result18=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row18=mysqli_fetch_assoc($result18);
                            
                            include "includes/contentdatabase.inc.php";

                    if($uploader==$fullname)
                    {
                        echo' <div class="video">
                    <form action="watchcontent.php?watch='.$row3["uniqueid"].'" method="POST">
                    <input type="hidden" value="'.$row3["uniqueid"].'" name="uniqueid">
                    <input type="image" src="content/videos/thumbnails/'.$row18["directoryname"].'/'.$row3["thumbnail"].'" class="thumbnail" name="thumbnail">
                    </form>
                    <p class="videodescription">
                    '.$row3["videotitle"].'
                    </p>
                    <div class="boostbtn">
                    <a href="boost.php?a='.$ID.'&r='.$row4["roomid"].'&v='.$row3["uniqueid"].'"><button>Boost Video</button></a>
                    </div>
                    
                    <div class="videodetails">
                        
                        <div class="videoinfo flex-div">
                            <p class="videoviews">'.$views.' Views &bullet; '.$uploadedtime.'</p>
                        </div>
                        <form action="includes/deletevideo.inc.php" method="post">
                        <input type="hidden" value="'.$row3["uniqueid"].'" name="uniqueid">
                        <input type="hidden" value="'.$row3["video"].'" name="video">
                        <input type="hidden" value="'.$row3["thumbnail"].'" name="thumbnail">
                        <input type="hidden" value="'.$ID.'" name="accountid">
                        <input type="hidden" value="'.$row18["directoryname"].'" name="directoryname">
                        <button id="trashbtn" type="submit" name="submit"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                   
                    </div>
                    '; 
                    }
                    else{
                        echo' <div class="video">
                        <form action="includes/views.inc.php" method="POST">
                        <input type="hidden" value="'.$row3["uniqueid"].'" name="uniqueid">
                        <input type="image" src="content/videos/thumbnails/'.$row18["directoryname"].'/'.$row3["thumbnail"].'" class="thumbnail" name="thumbnail">
                        </form>
                        <p class="videodescription">
                        '.$row3["videotitle"].'
                        </p>
                        <div class="flex-div">
                            <div class="videoinfo">
                                <p class="videoviews" id="time">'.$views.' Views &bullet; '.$uploadedtime.'</p>
                            </div>
                        </div>
                        </div>
                        ';
                    }
                
               
            };?>
</div>

    <?php
}
?>
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



