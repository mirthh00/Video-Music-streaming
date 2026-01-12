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
    <link href="css/intelliprenuer/intelliprenuership.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        .responses h6 {
            color: red;
            font-style: italic;
        }
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
       <h2><big>Create  Channel</big></h2>
       <form method="POST" action="includes/intellipreneurship.inc.php" enctype="multipart/form-data">
             <h6>Upload Profile Picture</h6>
            
            <div class="video">
                <img id="image2" class="filename" >
            </div>
             <br><br>
             <input type="file" class="userimage" required id="file" name="profile" >
             <div class="fileupload">
              <label for="file">
         
                  Choose Picture
                 </label>
                
             </div>
            <br><br><br>
            <h6>Upload Cover Picture</h6>
            
            <div class="video">
                <img id="image" class="filename2" >
            </div>
             <br><br>
             <input type="file" class="userimage" required id="file2" name="cover" >
             <div class="fileupload">
              <label for="file2">
         
                  Choose Picture
                 </label>
                
             </div>
             <br><br><br>

             <h6>Upload Account Verification Video</h6>
            
            <div class="video">
                <video id="image3" controls muted preload="auto"></video>
            </div>
             <br><br>
             <input type="file" class="userimage" required id="file3" name="verificationvideo" >
             <div class="fileupload">
              <label for="file3">
         
                  Choose Video
                 </label>
                
             </div>
            <br><br><br>
            <h6>Upload Account Overview Video</h6>
            
            <div class="video">
                <video id="image4" controls muted preload="auto"></video>
            </div>
             <br><br>
             <input type="file" class="userimage" required id="file4" name="overviewvideo" >
             <div class="fileupload">
              <label for="file4">
         
                  Choose video
                 </label>
                
             </div>
             <br><br><br>
           <h6>Create Account Name</h6>
           <input type="text" class="input-box" placeholder="Enter The Name Of Your Account" required name="accountname">
           <br><br>
           <h6>Select Content Catagory</h6>
           <br>
           <select class="countries" name="catagory">
            <option>Movies</option>
            <option>Series</option>
            <option>Videos</option>
            <option>Podcasts</option>
            <option>Music</option>
           
           </select>
           <br><br>
           <h6>Select Content Genre</h6>
           
           <select class="countries" name="genre">
            <option>Action</option>
            <option>Horror/Thriller</option>
            <option>Romance</option>
            <option>Adventure</option>
            <option>Comedy</option>
            <option>Drama</option>
            <option>Bollyhood</option>
            <option>Nollyhood</option>
            <option>Music Videos</option>
            <option>Performances</option>
            <option>Reviews</option>
            <option>Short Stories</option>
            <option>Hip Hop</option>
            <option>Amapiano</option>
            <option>Afro Pop</option>
            <option>House</option>
            <option>Fiction</option>
            <option>Romance</option>
            <option>Modelling</option>
            <option>Wildlife</option>
            <option>Motivational</option>
            <option>Random</option>
           </select><br><br>
           <h6>About</h6>
           <textarea cols="30" rows="10" placeholder="Pleae Describe Your Account" required name="accountbio"></textarea>
           
           
           <h6>Your Inspiration</h6>
           <textarea cols="30" rows="10"  placeholder="Pleae write what inspired your account and content" required name="inspiration"></textarea>
           
           
           <h6>Your Vision</h6>
           <textarea cols="30" rows="10" placeholder="Pleae write your vision for this account as a creator" required name="vision"></textarea>
       
           
           <h6>Your Promise To Unlockers</h6>
           <textarea cols="30" rows="10" placeholder="Pleae write what you want to promise people who will unlock your account" required name="promise"></textarea>
           
           
           <h6>Number Of Uploads Per Month</h6>
           <input type="text" class="input-box" placeholder="Pleae write the total number of uploads you will release in a month" required name="uploadcount">
        
           <h6>Days Of New Upload</h6>
           <input type="text" class="input-box" placeholder="Pleae write weekdays seperated by '|' e.g Monday | Sunday" required name="uploadays">
           
           <h6>Time Of New Upload</h6>
           <input type="text" class="input-box" placeholder="Pleae write the time you will release new content" required name="uploadtime">
           
           <h6>Select Timezone</h6>
           
           <select class="countries" name="timezone">
            <option>A</option>
            <option>ACDT</option>
            <option>ACST</option>
            <option>ACT</option>
            <option>ACWST</option>
           
           </select>
           <br><br>
           <h6>Set Unlocking Price</h6>
           <input type="number" class="input-box" placeholder="Enter Price Excluding Currency Abreviation" required name="price">
            
            <h6>Select Currency</h6>
            
            <select class="countries" name="currency">
             <option>Rand</option>
             <option>Dollar</option>
             <option>Euro</option>
             <option>Pound</option>
             <option>Naira</option>
             <option>Pula</option>
            </select>
            <br><br>
            <h6>Create Fans Room</h6>
            
            <select class="countries" name="room">
             <option>Yes</option>
             <option>No</option>
            </select>
             <br><br>
             <input type="hidden" class="input-box" value="<?php 
             $useremail=$_SESSION["useremail"];
             echo "$useremail";
             ?>" name="email"> 
           <button class="submit-btn" name="submit">Create Account</button>
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
        <p>&copy;Mirthh.com<sup>2022</sup></p>
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
    <script src="js/filechoice.js"></script>
</body>
</html>