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
<!DOCTYPE html>
<html>
<head>
    <title>Mirth</title>
    <meta lang="en" charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/accountupdate/accountupdate.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
    </style>
   
</head>
<body>
<div id="preloader"></div>
        <script>
            var loader=document.getElementById("preloader");
            window.addEventListener("load",function() {
                loader.style.display="none";
                
            })
        </script>
    <header>
        <nav>
        <a href="home.php"><img src="images/Logopit_1648978873138.png"></a>
        </nav>
     
    </header>
    <div class="sign-up-box">
    <div class="card">
    <div class="inner-box" id="card">
    <div class="card-front">
        <div class="n">

        
       <h2><big>Profile Update</big></h2>
       
        </div>
       <form method="POST" action="includes/profileupdate.inc.php" enctype="multipart/form-data">
        <br>
        <div class="n">
            <?php
                 if(isset($_SESSION['username']))
                 {
                     $imagename=$_SESSION['userimage'];
                     echo "<img id='account-btn' class='account' src='profilepictures/$imagename'>
                     ";
                 } 
            ?>
            </div>
           
           <h6>Change Your Username</h6>
           
           <input type="text" class="input-box" placeholder="Enter New Username" required name="newusername">
        
           <h6>Change Your Profile Picture</h6>
          
           <input type="file" id="file"  class="userimage" required name="newimage" accept="image/jpd,image/jpeg,image/png">
           <div class="fileupload">
            <div class="n">
            <img  id="image" class="filename">
            </div>
            <div class="n">
            <label for="file">
       
                Choose Picture
               </label>
               </div>
               
           </div>
           
           <h6>Change Your Password</h6>
           
           <input type="password" class="input-box" placeholder="Enter New Password" required name="newpassword">
           
           <button class="submit-btn" name="update">Update</button>
           <br>
           <button class="submit-btn"><a href="home.php">Cancel</a></button>
       </form>
       
       
    </div>
 
        

    </div>
    </div>
    </div>
    </div>
    <footer>
    <section class="second_text">
        <p>&copy;Mirthh.com<sup>2022</sup></p>
    </section>
    </footer>
    <script src="js/signup.js"></script>
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