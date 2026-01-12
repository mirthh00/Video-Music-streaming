<?php
session_start();
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}
?>

<?php

include 'includes/functions.inc.php';
include 'includes/contentdatabase.inc.php';
if (isset($_POST["query"])){
$search = mysqli_real_escape_string($conn,$_POST["query"]);


$sql6="SELECT * FROM podcasts WHERE uploader LIKE CONCAT('%',?,'%') OR songtitle LIKE CONCAT('%',?,'%') ORDER BY id DESC ;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql6)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"ss",$search,$search);
mysqli_stmt_execute($stmt);
$result6=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum6=mysqli_num_rows($result6);
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
            <form action="redirectpodcastslive.php" method="post">
                <input type="hidden" value="<?php echo "$songtitle";?>" name="songid">
                <input type="hidden" value="<?php echo "$songid";?>" name="id">
                <input name="submit" type="image" src="podcasts/covers/<?php echo "$ID";?>.jpg" class="albumcover" id="songcover">
            </form>
            
        </div>
    <div class="musicdetails">
            <a href=""><img id="account-btn" class="account" src="profilepictures/<?php
            $uploaderprofile=$row8["profileimage"];
            echo "$uploaderprofile";
            
            ?>"></a>
            
        <div class="videodetails">
            <p class="videodescription"><?php echo "$songtitle";?>
            </p>
            <p class="artistsnames lowfont videodescription"><?php echo "$artists";?>
            </p>
            <div class="videoinfo">
                <p class="videoviews lowfont"><?php echo $row6["streams"]; ?> Streams | <?php echo "$uploadedtime"; ?></p>
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
                <i id="<?php echo "$ID";?>" name="<?php echo "$ID";?>" data-id="<?php echo "$ID";?>" class="bi react bi-heart-fill"></i>
                <?php
               }
               else {
                ?>
                <i id="<?php echo "$ID";?>" name="<?php echo "$ID";?>" data-id="<?php echo "$ID";?>" class="bi react bi-heart"></i>
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