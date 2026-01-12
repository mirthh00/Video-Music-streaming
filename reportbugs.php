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
$fullname=$_SESSION["username"];

$userimage=$_SESSION["userimage"];
$useremail=$_SESSION["useremail"];
$username=$_SESSION["fullname"];
if(isset($_GET["s"])){
    $s=$_GET["s"];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Mirthh Report Bugs</title>
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
       <h2><big>Report Bugs</big></h2>
      
       <form method="POST" action="includes/reportbugs.inc.php">
        <br>
        <div class="n">
        <img id='account-btn' class='account' src='profilepictures/<?php echo "$userimage";?>'>
        </div>
           <br><br><br>
           <?php
           if($s=="d"){
            ?>
            <p id="s">Report successfully submitted.</p>
            <?php
           }
           ?>
           <h6><?php echo "$username";?> we appreciate your interest in keeping the platform
            a healthy enviroment for you and other users.Your interest and kind actions will be rewarded
            as soon as your report is validated.</h6>
           <br>
           <textarea name="report"  placeholder="Type to report a bug..." cols="30" rows="10"></textarea>
           <br><br>
           <input type="hidden" name="name" value="<?php echo "$username";?>">
           <input type="hidden" name="useremail" value="<?php echo "$useremail";?>">
           <button class="submit-btn" name="submit">Report Bug</button>
           <br>
      
       </form>
       <button class="submit-btn"><a href="home.php">Cancel</a></button>
       
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