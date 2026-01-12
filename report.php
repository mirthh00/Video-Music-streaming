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
include 'includes/contentdatabase.inc.php';
$videoid=mysqli_real_escape_string($conn,$_GET["v"]);

$fullname=$_SESSION["username"];
$sql2="SELECT * FROM videos WHERE  uniqueid=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$videoid);
mysqli_stmt_execute($stmt);
$result2=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row2=mysqli_fetch_assoc($result2);

$uploader=$row2["uploader"];

$userimage=$_SESSION["userimage"];
$useremail=$_SESSION["useremail"];
$username=$_SESSION["fullname"];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Mirthh Report Issue</title>
    <meta lang="en" charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="css/upload/upload.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
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
       <h2><big>Report Issue!</big></h2>
      
       <form method="POST" action="includes/report.inc.php">
        <br>
        <div class="n">
        <img id='account-btn' class='account' src='profilepictures/<?php echo "$userimage";?>'>
        </div>
           <br><br><br>
           <h6><?php echo "$username";?> we appreciate your interest in keeping the platform
            a healthy enviroment for you and other users.Your interest and kind actions will be rewarded
            as soon as your report is validated.</h6>
           <br>
           <textarea name="report"  placeholder="Type report about issues related to video,it can be stolen,sexual,harmful,dangerous,bad-influential content!Your report
           will be taken into serious consideration and your identity will be kept anonymous." cols="30" rows="10"></textarea>
           <br><br>
           <input type="hidden" name="name" value="<?php echo "$username";?>">
           <input type="hidden" name="videoid" value="<?php echo "$videoid";?>">
           <input type="hidden" name="uploader" value="<?php echo "$uploader";?>">
           <input type="hidden" name="useremail" value="<?php echo "$useremail";?>">
           <button class="submit-btn" name="submit">report</button>
           <br>
      
       </form>
       <button class="submit-btn"><a href="watchcontent.php?watch=<?php echo "$videoid";?>">Cancel</a></button>
       
    </div>
 
        

    </div>
    </div>
    </div>
    </div>
    <footer>
    <section class="second_text">
        <p>&copy;Mirthh.com<sup>2023</sup></p>
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