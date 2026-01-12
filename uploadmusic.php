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
        <h2><big>UPLOAD SONG</big></h2>
        <?php
            if($e == "ssb"){
                echo '<p id="e">Song size too big</p>';
            }
            elseif($e == "csb"){
                echo '<p id="e">Cover size too big</p>';
            }
            elseif($e == "psb"){
                echo '<p id="e">Podcast size too big</p>';
            }
            elseif($e == "sew"){
                echo '<p id="e">Wrong song file submitted</p>';
            }
            elseif($e == "scew"){
                echo '<p id="e">Wrong song cover file submitted</p>';
            }
            elseif($e == "acew"){
                echo '<p id="e">Wrong album cover file submitted</p>';
            }
        ?>
        <form action="includes/uploadmusic.inc.php" method="POST" enctype="multipart/form-data">
            <div class="video">
                <audio id="image2" class="filename"  src="" controls preload="auto"></audio>
            </div>
             <br><br>
             <input type="file" class="userimage" required id="file" name="song" >
             <div class="fileupload">
                <div class="video">
                <label for="file">
         
         Choose Song
        </label>  
                </div>
             
                
             </div>
            <br><br>
            <h6> COVER</h6>
           
            <div class="video">
                <img id="image" class="filename2" >
            </div>
             <br><br>
             <input type="file" class="userimage" required id="file2" name="cover" >
             <div class="fileupload">
                <div class="video">

                
              <label for="file2">
         
                  Choose Picture
                 </label>
                 </div>
             </div>
           <br><br>
            <h6> SONG TITLE</h6>
          
            <input type="text" class="input-box" placeholder="Enter The Name Of Your Song" required name="songtitle">
            
            <h6> ARTISTS</h6>
            
            <textarea name="artists" id="videodescription" cols="30" rows="10" placeholder="Enter The Names Of All
            Artists In The Song Separated By | e.g <?php echo $row["accountname"]; ?> | somebody"></textarea>
           
            <h6>Fill the form below only if you want to add the song to an album else skip!</h6>
            
            <h6>ALBUM COVER</h6>
            
            <div class="video">
                <img id="image3" class="filename2" >
            </div>
            <br><br>
            <input type="file" class="userimage"  id="file3" name="albumcover" >
            <div class="fileupload">
                <div class="video">

                
             <label for="file3">
        
                 Choose Picture
                </label>
                </div> 
            </div>
           <br><br>
            <h6> ALBUM TITLE</h6>
            
            <input type="text" class="input-box" placeholder="Enter The Title Of The Album You Want To Add The Song To" name="albumtitle">
            
          <h6>DONE?</h6>
          
          <input type="hidden" name="uploadedtime" value="<?php $time=time();
            echo "$time";
          ?>">
          <input type="hidden" name="genre" value="<?php echo $row["genre"]; ?>">
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


          