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
$accountname=$row["accountname"];

if(isset($_GET["e"])){
    $e = $_GET["e"];
}
else {
    $e = "none";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mirthh Upload</title>
    <meta lang="en" charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="css/upload/upload.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        <h2><big>UPLOAD VIDEO</big></h2>
        <?php
            if($e == "vsb"){
                echo '<p id="e">Video size too big</p>';
            }
            elseif($e == "tsb"){
                echo '<p id="e">Thumbnail size too big</p>';
            }
            elseif($e == "sb"){
                echo '<p id="e">Subtitles size too big</p>';
            }
            elseif($e == "vew"){
                echo '<p id="e">Wrong video file submitted</p>';
            }
            elseif($e == "tew"){
                echo '<p id="e">Wrong thumbnail file submitted</p>';
            }
            elseif($e == "sew"){
                echo '<p id="e">Wrong subtitles file submitted</p>';
            }
        ?>
        <?php
        if($row["catagory"]=='Music'){

        ?>
        <form id="uploadvideo" action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
            <div class="video">
                <video id="image2" class="filename"  controls muted preload="auto"></video>
            </div>
             <br><br><br><br>
             <input type="file" class="userimage" required id="file" name="video" >
             <div class="fileupload">
              <label for="file">
         
                  Choose Video
                 </label>
                
             </div>
             <br><br><br><br>
            <h6> THUMBNAIL</h6>
            <br><br>
            <div class="video">
                <img id="image" class="filename2" >
            </div>
             <br><br>
             <input type="file" class="userimage" required id="file2" name="thumbnail" >
             <div class="fileupload">
              <label for="file2">
         
                  Choose Picture
                 </label>
                
             </div>
             <br><br><br><br>
            <h6> VIDEO TITLE</h6>
            <br><br>
            <input type="text" class="input-box" placeholder="Enter The Title Of Your Video" required name="videotitle">
            <br><br><br><br>
            <h6> VIDEO DESCRIPTION</h6>
            <br><br>
            <textarea name="videodescription" id="videodescription" cols="30" rows="10" placeholder="Enter Video Description"></textarea>
            <br><br><br><br>
            <h6>UPLOAD SUBTITLES</h6>
            <br><br>
            <div class="text">
             <p>Upload .vtt subtitle files only!!.</p>
             </div>
            <div class="videodiv">
            <input type="file" name="subtitles" id="subtitles">
            </div>
            <?php
            if($row["catagory"]=='Music'){
                include 'includes/contentdatabase.inc.php';
                $sql2="SELECT * FROM music WHERE  uploader=?;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql2)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt,"s",$accountname);
                mysqli_stmt_execute($stmt);
                $result2=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                
                $rownum2=mysqli_num_rows($result2);
                ?>
           <h6>LINK VIDEO TO SONG</h6>
           <br>
           <select name="link">
            <?php
            if($rownum2>0){
                while($row2=mysqli_fetch_assoc($result2)){
                    ?>
                    <option><?php echo $row2["songtitle"]; ?></option>
                    <?php
                }
            }
            ?>
            <option>None</option>
           </select><br><br>
           <?php
            }
            ?>
          <h6>DONE?</h6>
          <br><br>
          <button class="submit-btn" name="upload">UPLOAD</button>
          <br><br>
          <input type="hidden" name="uploadedtime" value="<?php $time=time();
            echo "$time";
          ?>">
          <input type="hidden" name="genre" value="<?php echo $row["genre"]; ?>">
          <input type="hidden" name="country" value="<?php echo $row["country"]; ?>">
        </form>
        <a href="home.php"><button class="submit-btn">CANCEL</button></a>
        <br>
        <script src="js/filechoice.js"></script>
        <?php
        }
        else{
            ?>
                <form id="uploadvideo" action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
             <br><br>
             <div class="text">
             <p>Choose Your Video.Make Sure That The Size Of Your Video Is Less Than 2gb.</p>
             </div>
             
             <div class="videodiv">
             <input type="file" required id="video" name="video" >
             </div>
             
            <h6> THUMBNAIL</h6>
            <br><br>
            <div class="video">
                <img id="image" class="filename2" >
            </div>
             <br><br>
             <input type="file" class="userimage" required id="file2" name="thumbnail" >
             <div class="fileupload">
              <label for="file2">
         
                  Choose Picture
                 </label>
                
             </div>
             <br><br><br><br>
            <h6> VIDEO TITLE</h6>
            <br>
            <input type="text" class="input-box" placeholder="Enter The Title Of Your Video" required name="videotitle">
            <br><br>
            <h6> VIDEO DESCRIPTION</h6>
            <br><br>
            <textarea name="videodescription" id="videodescription" cols="30" rows="10" placeholder="Enter Video Description"></textarea>
            <br><br>
            <h6>UPLOAD SUBTITLES</h6>
            <br><br>
            <div class="text">
             <p>Upload .vtt subtitle files only!!.</p>
             </div>
            <div class="videodiv">
            <input type="file" name="subtitles" id="video">
            </div>
            
            <?php
            if($row["catagory"]=='Podcasts'){
                include 'includes/contentdatabase.inc.php';
                $sql2="SELECT * FROM podcasts WHERE  uploader=?;";
                $stmt=mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt,$sql2)){
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt,"s",$accountname);
                mysqli_stmt_execute($stmt);
                $result2=mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                
                $rownum2=mysqli_num_rows($result2);
                ?>
           <h6>LINK VIDEO TO PODCAST</h6>
           <br>
           <select name="link">
            <?php
            if($rownum2>0){
                while($row2=mysqli_fetch_assoc($result2)){
                    ?>
                    <option><?php echo $row2["songtitle"]; ?></option>
                    <option>None</option>
                    
                    <?php
                }
            }
            ?>
           </select>
           <?php
            }
            ?>
          <h6>DONE?</h6>
          
          <button class="submit-btn" name="upload">UPLOAD</button>
          <br>
          <input type="hidden" name="uploadedtime" value="<?php $time=time();
            echo "$time";
          ?>">
          <input type="hidden" name="genre" value="<?php echo $row["genre"]; ?>">
          <input type="hidden" name="country" value="<?php echo $row["country"]; ?>">
        </form>
        <a href="home.php"><button class="submit-btn">CANCEL</button></a>
        <br>
        <style>
            #video{
                display: block;
            }
        </style>
        <script src="js/filechoice2.js"></script>
            <?php
        }
        ?>

    </div>
    </div>
    </div>
    </div>
    <footer>
    <section class="second_text">
        <p>&copy;Mirth.com<sup>2022</sup></p>
    </section>
    </footer>

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


          