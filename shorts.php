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
include 'includes/accountdatabase.inc.php';
    $shorts="Shorts";
   $sql="SELECT * FROM unlockedaccounts WHERE catagory=?;";
   $stmt=mysqli_stmt_init($conn);

   if(!mysqli_stmt_prepare($stmt,$sql)){
   header("location: ../signup.php?error=stmtfailed");
   exit();
   }
   mysqli_stmt_bind_param($stmt,"s",$shorts);
   mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   mysqli_stmt_close($stmt);
   $row=mysqli_fetch_assoc($result);
   $rownum=mysqli_num_rows($result);

   $sql5="SELECT * FROM unlockedaccounts WHERE catagory=?;";
   $stmt=mysqli_stmt_init($conn);

   if(!mysqli_stmt_prepare($stmt,$sql5)){
   header("location: ../signup.php?error=stmtfailed");
   exit();
   }
   mysqli_stmt_bind_param($stmt,"s",$shorts);
   mysqli_stmt_execute($stmt);
   $result5=mysqli_stmt_get_result($stmt);
   mysqli_stmt_close($stmt);
   $rownum5=mysqli_num_rows($result5);

   $fullname=$_SESSION["fullname"];
$sql9="SELECT * FROM intellipreneurs WHERE  accountholder=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql9)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname);
mysqli_stmt_execute($stmt);
$result9=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row9=mysqli_fetch_assoc($result9);
$rownum9=mysqli_num_rows($result9);

   include 'includes/contentdatabase.inc.php';
   $sql2="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
   $stmt=mysqli_stmt_init($conn);

   if(!mysqli_stmt_prepare($stmt,$sql2)){
   header("location: ../signup.php?error=stmtfailed");
   exit();
   }
   mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
   mysqli_stmt_execute($stmt);
   $result2=mysqli_stmt_get_result($stmt);
   mysqli_stmt_close($stmt);
   $rownum2=mysqli_num_rows($result2);

   ?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/shorts/shorts.css" rel="stylesheet">
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
                <form method="POST" action="search.php">
                <input type="text" class="search" placeholder="Search Movies Accounts" name="search">
                <button id="button" name="submit-search"><i class="fas fa-magnifying-glass" id="search-icon" ></i></button>
                </form>
               
                <a href="#"><i class="fas fa-microphone-lines" id="voice-icon"></i></a>
            </div>
            <div class="nav-right flex-div">
               

                <?php
                        if(isset($_SESSION['username']))
                        {
                            if($rownum9>0)
                            {
                                $imagename=$_SESSION['userimage'];
                            $id=$row9["id"];
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
                <li><a href="home.php" ><i class="fas fa-film"></i>Movies</a></li>
                <li><a href="series.php"><i class="fas fa-clapperboard"></i>Series</a></li>
                <li><a href="videos.php"><i class="fas fa-video"></i>Videos</a></li>
                <li><a href="music.php"><i class="fas fa-music"></i>Music</a></li>
                <li><a href="shorts.php" id="selected"><i class="fas fa-bolt"></i>Shorts</a></li>
                <li><a href="rooms.php"><i class="fas fa-comments"></i>Rooms</a></li>
                <li><a href="#"><i class="fas fa-eye"></i>History</a></li>
                <li><a href="#"><i class="fas fa-heart-circle-check"></i>Liked Movies</a></li>
                <li><a href="unlockedaccounts.php"><i class="fas fa-lock-open"></i>Unlocked Accounts</a></li>
                <li><a href="intellipreneurship.php"><i class="fas fa-circle-dollar-to-slot"></i>Intellipreneurship</a></li>
                <li><a href="#"><i class="fas fa-chart-simple"></i>Trending</a></li>
                 <br><br><br>
            </ul>
        </div>
<?php
if($rownum>0)
{
?>
    <div class="container-box play-container">
        <div class="row">
                <div class="play-video">
                 <?php
                 while($row2=mysqli_fetch_assoc($result2)){
                    $time=$row2["uploadedtime"];
                    $uploadedtime=uploadedtime($time);
                    include 'includes/contentdatabase.inc.php';
                    $sql3="SELECT * FROM shortscomments WHERE  videoid=? ORDER BY id DESC;";
                    $stmt=mysqli_stmt_init($conn);
                
                    if(!mysqli_stmt_prepare($stmt,$sql3)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$row2["uniqueid"]);
                    mysqli_stmt_execute($stmt);
                    $result3=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $rownum3=mysqli_num_rows($result3);

                    include 'includes/accountdatabase.inc.php';
                    $sql4="SELECT * FROM intellipreneurs WHERE accountname=?;";
                    $stmt=mysqli_stmt_init($conn);
                 
                    if(!mysqli_stmt_prepare($stmt,$sql4)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$row2["uploader"]);
                    mysqli_stmt_execute($stmt);
                    $result4=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row4=mysqli_fetch_assoc($result4);
                    $rownum4=mysqli_num_rows($result4);

                    $sql8="SELECT * FROM unlockedaccounts WHERE accountname=?;";
                    $stmt=mysqli_stmt_init($conn);
                 
                    if(!mysqli_stmt_prepare($stmt,$sql8)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$row2["uploader"]);
                    mysqli_stmt_execute($stmt);
                    $result8=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $rownum8=mysqli_num_rows($result8);
                    ?>
                   <div class="shortsvideo">

                   <video src="content/videos/<?php echo $row2["uploader"]; ?>/<?php echo $row2["video"]; ?>" controls  muted type="video/mp4"></video>

<div class="tags">
    <a href="">#Number 1 Worldwide</a>
    <a href="">#Most Loved</a>
</div>
<p class="caption"><?php echo $row2["videotitle"]; ?></p>
<div class="play-video-info">
    <div class="videoinfo flex-div">
        <img src="images/heart-icon-png-transparent-7.jpg" class="account3">
        <p class="unlockers">207650   </p>
        <img src="images/pngwing.com.png" class="account3 unlockers">
        <p class="unlockers">20   </p>
        <i id="eyeicon"  class="fas fa-eye unlockers"></i>
        <p class="unlockers">20050000060 Views </p>
        <img src="images/5a21a15d70d926.0953068315121534374622.png" class="account3 unlockers">
        <p class="unlockers"><?php echo"$uploadedtime"; ?></p>
        <i id="commenticon" class="fas fa-comments unlockers"></i>
        <p class="unlockers"><?php echo"$rownum3"; ?> Comments</p>
    </div>
 
</div>
<hr class="video-border">
<div class="commentbox" id="commentbox">
    <div class="add-comment flex-div">
        <img src="profilepictures/<?php echo $_SESSION["userimage"]; ?>" class="publisher-icon" alt="">
        <form action="includes/shortscomments.inc.php" method="post">

<div class="comment-input">
    <input class="unlockers" type="text" placeholder="Type Your Comment..." name="comment">
</div>
<input type="hidden" name="username" value="<?php
    $username=$_SESSION["username"];
    echo "$username";
?>">
 <input type="hidden" name="videoid" value="<?php
    $videoid=$row2["uniqueid"];
    echo "$videoid";
?>">
  <input type="hidden" name="commenttime" value="<?php
    $commenttime=time();
    echo "$commenttime";
?>">
 <input type="hidden" name="userimage" value="<?php
    $commenttim=$_SESSION["userimage"];
    echo "$commenttim";
?>">
 <input type="hidden" name="id" value="<?php
    $commentti="ZYZ";
    echo "$commentti";
?>">
<button class="unlockers" name="submit">send</button>
</form>
    </div>
    <?php
    if($rownum3>0){
        while($row3=mysqli_fetch_assoc($result3)){
            $ctime=$row3["uploadedtime"];
            $ctime2=uploadedtime($ctime);  


    ?>
    <div class="old-comment">
        <div class="old-comment-details flex-div">
            <img src="profilepictures/<?php echo $row3["userimage"]; ?>" class="publisher-icon">
            <h3 class="unlockers"><?php echo $row3["username"]; ?></h3>
        </div>
           
            <p class="comment"><?php echo $row3["commentwords"]; ?>
            </p>
            <div class="comment-action">
                <div class="videoinfo flex-div">
                    <img src="images/heart-icon-png-transparent-7.jpg" class="account3">
                    <p class="unlockers">2545   </p>
                    <img src="images/pngwing.com.png" class="account3 unlockers">
                    <p class="unlockers">20   </p>
                    <img src="images/5a21a15d70d926.0953068315121534374622.png" class="account3 unlockers">
                    <p class="unlockers"><?php echo "$ctime2"; ?></p>
                    
                </div>
            </div>
            <hr class="video-border">
    </div> 
    <?php
    }
    }
    ?>
   
</div>

                    
                      <div class="publisher flex-div">
                        <a href="account.php?ID=<?php echo $row4["id"]; ?>"><img src="profilepictures/<?php echo $row4["profileimage"]; ?>" id="publisher-icon" class="publisher-icon"></a>
                        <div class="publisher-details unlockers">
                        <div class="verify flex-div">
                            <a href="account.php?ID=<?php echo $row4["id"]; ?>" class="publisher-name "><?php echo $row4["accountname"]; ?></a>
                            <img src="images/check.png" class="account3" alt="">
                        </div>
                        <p class="publisher-followers"><?php echo "$rownum8"; ?> Unlockers</p>
                        </div>
                    </div>
                    <hr class="video-border">
                   <br><br>
                  
</div>
<?php
}
?>


</div>
            <div class="right-sidebar">
                <div class="recomendedvideosheader center-div">
                    <h2>UNLOCKED ACCOUNTS</h2>
                </div>
                <?php
                while( $row5=mysqli_fetch_assoc($result5)){
                    include 'includes/accountdatabase.inc.php';
                    $sql6="SELECT * FROM intellipreneurs WHERE accountname=?;";
                    $stmt=mysqli_stmt_init($conn);
                 
                    if(!mysqli_stmt_prepare($stmt,$sql6)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                    }
                    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
                    mysqli_stmt_execute($stmt);
                    $result6=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row6=mysqli_fetch_assoc($result6);
                    $rownum6=mysqli_num_rows($result6);

                    $sql7="SELECT * FROM unlockedaccounts WHERE accountname=?;";
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
                    ?>
                <div class="publisher flex-div">
                    <a href="account.php?ID=<?php echo $row6["id"]; ?>"><img src="profilepictures/<?php echo $row6["profileimage"]; ?>" id="publisher-icon" class="publisher-icon"></a>
                    <div class="publisher-details unlockers">
                    <div class="verify flex-div">
                        <a href="account.php?ID=<?php echo $row6["id"]; ?>" class="publisher-name "><?php echo $row5["accountname"]; ?></a>
                        <img src="images/check.png" class="account3" alt="">
                    </div>
                    <p class="publisher-followers"><?php echo "$rownum7";?> Unlockers</p>
                    </div>
                </div>
                <hr class="video-border">
                <?php
                }
                ?>
               
                
            </div>
        </div>
</div>
<?php
}
else{
    echo'
    <div class="banner">
               <h1>No Shorts Accounts Unlocked!</h1>
            </div>
    ';
}
?>

       
       <script>
           var icon=document.getElementById("theme-icon");
           icon.onclick = function(){
               document.body.classList.toggle("white-theme");
              
           }
       </script>
    </body>
</html>  