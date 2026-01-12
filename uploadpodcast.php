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
$fullname=$_SESSION["fullname"];
$sql="SELECT * FROM intellipreneurs WHERE  accountholder=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row=mysqli_fetch_assoc($result);
$rownum=mysqli_num_rows($result);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Mirth</title>
    <meta lang="en" charset="UTF-8">
    <link href="css/uploadmusic/upload.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
    </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
<body>
    <header>
        <nav>
        <a href="home.php"><img src="images/Logopit_1648978873138.png"></a>
       
        </nav>
    </header>
   
    <div class="sign-up-box">
    <div class="card">
    <div class="inner-box" id="card">
    <div class="card-front">
        <h2><big>UPLOAD PODCAST</big></h2>
        <form action="includes/uploadpodcast.inc.php" method="POST" enctype="multipart/form-data">
            <div class="video">
                <audio id="image2" class="filename"  src="" controls preload="auto"></audio>
            </div>
             <br><br><br><br>
             <input type="file" class="userimage" required id="file" name="song" >
             <div class="video">
              <label for="file">
         
                  Choose Podcast
                 </label>
                
             </div>
            <br><br><br><br>
            <h6> COVER</h6>
            <br><br>
            <div class="video">
                <img id="image" class="filename2" >
            </div>
             <br><br>
             <input type="file" class="userimage" required id="file2" name="cover" >
             <div class="video">
              <label for="file2">
         
                  Choose Picture
                 </label>
                
             </div>
             <br><br><br><br><br>
            <h6> PODCAST TITLE</h6>
            <br><br>
            <input type="text" id="songtitle" class="input-box" placeholder="Enter The Name Of Your Song" required name="songtitle">
            <br><br><br><br>
            <h6>HOSTS & GUESTS</h6>
            <br><br>
            <textarea name="artists" id="artists" cols="30" rows="10" placeholder="Enter The Names Of All
            Guests & Hosts In The Song Separated By | e.g nobody | somebody"></textarea>
            <br><br><br><br>
        
           
          <h6>DONE?</h6>
          <br><br>
          <input type="hidden" name="uploadedtime" value="<?php $time=time();
            echo "$time";
          ?>">
          <input type="hidden" name="genre" value=" <?php echo $row["genre"]; ?>">
          <input type="hidden" name="uploaderprofile" value="<?php echo $row["profileimage"]; ?>">
          <button name="upload" class="submit-btn">UPLOAD</button>
          <br><br>
        </form>
        <a href="home.php"><button class="submit-btn">CANCEL</button></a>
        

    </div>
    </div>
    </div>
    </div>
    <footer>
    <section class="second_text">
        <p>&copy;Mirth.com<sup>2022</sup></p>
    </section>
    </footer>
    <script src="js/filechoice.js"></script>
    <script>
   $(document).ready(function(){
   $('#songtitle').on("cut copy paste",function(e) {
      e.preventDefault();
   });
   $('#artists').on("cut copy paste",function(e) {
      e.preventDefault();
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