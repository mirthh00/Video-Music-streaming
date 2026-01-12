<?php
session_start();
    if(isset($_GET["a"])){
        $recommender=$_GET["a"];
    }
    else{
        $recommender="none";
    }
    if(isset($_GET["error"])){
        $error=$_GET["error"];
    }
    else{
        $error="none";
    }
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
$p = get_client_ip();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mirthh-Signup</title>
    <meta lang="en" charset="UTF-8">
    <link href="css/signup/signup.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
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
        <div class="page-container">
        <nav>
        <a href="index.php"><img src="images/Logopit_1648978873138.png"></a>
        <div class="navigation_links">
            <ul>
                <li><a href="index.php" ><i class="fas fa-house"></i>Home</a></li>
                <li>
                   <label for="check">
                       <i class="fas fa-bars" id="btn"></i>
                     </label>
                </li>
                <li><a href="About.php"><i class="fa-solid fa-note-sticky"></i>About</a></li>
             <li><a href="#" id="home"><i class="fa-solid fa-arrow-up-from-bracket"></i>Sign up</a></li>
                <li><a href="login.php"><i class="fas fa-right-to-bracket"></i>Sign in</a></li>
            </ul>
        </div>
        </nav>
    </header>
    <input type="checkbox" id="check">
    <div class="sidebar">
        <ul>
            <li><a href="index.php"><i class="fas fa-house"></i>Home</a></li>
            <li><a href="About.php"><i class="fa-solid fa-note-sticky"></i>About</a></li>
             <li><a href="#" id="home"><i class="fa-solid fa-arrow-up-from-bracket"></i>Sign up</a></li>
            <li><a href="login.php"><i class="fas fa-right-to-bracket"></i>Sign In</a></li>  
        </ul>
    </div>
    <div class="sign-up-box">
    <div class="card">
    <div class="inner-box" id="card">
    <div class="card-front">
       <h2><big>Sign Up</big></h2>
       <?php
        if($error!="none"){
            if($error=="fullnametaken"){
            echo'<p id="error">Fullname Taken!</p>';
            }
            elseif($error=="emailtaken"){
                echo'<p id="error">Email Taken!</p>';
            }
            elseif($error=="usernametaken"){
                echo'<p id="error">Username Taken!</p>';
            }
            elseif($error=="fullnamenotset"){
                echo'<p id="error">Empty Fullname Input!</p>';
            }
            elseif($error=="picturenotchosen"){
                echo'<p id="error">Please Choose Picture!</p>';
            }
            elseif($error=="birthdaynotset"){
                echo'<p id="error">Empty Birthday Input!</p>';
            }
            elseif($error=="psb"){
                echo'<p id="error">Wrong Profile Picture File Uploaded!</p>';
            }
            elseif($error=="wps"){
                echo'<p id="error">Profile Picture Size Too Big!</p>';
            }
            elseif($error=="usernamenotset"){
                echo'<p id="error">Empty Username Input!</p>';
            }
            elseif($error=="emailnotset"){
                echo'<p id="error">Empty Email Input!</p>';
            }
            elseif($error=="passwordnotset"){
                echo'<p id="error">Empty Password Input!</p>';
            }
        }
        ?>
       <form action="includes/signup.inc.php" method="POST" enctype="multipart/form-data">
      
           <input name="name" type="text" class="input-box" placeholder="Enter Full Name"<?php if(isset($_SESSION["name"])){echo 'value="'.$_SESSION["name"].'"';}; ?> required>
           <input name="uid" type="text" class="input-box" placeholder="Enter Username" <?php if(isset($_SESSION["username"])){echo 'value="'.$_SESSION["username"].'"';}; ?> required>
           <input name="email" type="email" class="input-box" placeholder="Enter Email Adress" <?php if(isset($_SESSION["email"])){echo 'value="'.$_SESSION["email"].'"';}; ?> required>
           <input name="email2" type="email" class="input-box" placeholder="Confirm Email Adress"<?php if(isset($_SESSION["email"])){echo 'value="'.$_SESSION["email"].'"';}; ?> required>
           <input name="password" type="password" id="input" onkeyup="trigger()" class="input-box" placeholder="Enter Password" <?php if(isset($_SESSION["password"])){echo 'value="'.$_SESSION["password"].'"';}; ?> required>
           <div class="indicator">
               <span class="weak"></span>
               <span class="medium"></span>
               <span class="strong"></span>
            </div>
            <div class="text">Your Password is too weak!!</div>
           <input name="password2" type="password" class="input-box" placeholder="Confirm Password" <?php if(isset($_SESSION["password"])){echo 'value="'.$_SESSION["password"].'"';}; ?> required>
           <br>
           <h6>Select Country</h6>
           <br>
           <select name="country" class="countries" >
            <option>Albania</option>
            <option>Andorra</option>
            <option>Angola</option>
            <option>Antigua and Barbuda</option>
            <option>Argentina</option>
            <option>Armenia</option>
            <option>Australia</option>
            <option>Austria</option>
            <option>Azerbaijan</option>
            <option>Bahamas</option>
           <option> Bahrain</option>
            <option>Bangladesh</option>
            <option>Barbados</option>
            <option>Belarus</option>
            <option>Belgium</option>
            <option>Belize</option>
            <option>Benin</option>
            <option>Bhutan</option>
            <option>Bolivia</option>
            <option>Bosnia and Herzegovina</option>
            <option>Botswana</option>
            <option>Brazil</option>
            <option>Brunei</option>
            <option>Bulgaria</option>
            <option>Burkina Faso</option>
            <option>Burundi</option>
             <option>Cabo Verde</option>       
             <option>Cambodia</option>       
             <option>Cameroon</option>       
             <option>Canada</option>       
             <option>Central African Republic</option>       
            <option>Chad</option>        
            <option>Chile</option>        
            <option>China</option>        
            <option>Colombia</option>        
            <option>Comoros</option>        
            <option>Congo</option>        
            <option>Costa Rica</option>        
             <option>Côte d’Ivoire</option>       
             <option>Croatia</option>       
            <option>Cuba</option>        
             <option>Cyprus</option>       
             <option>Czech Republic</option>   
             <option>Denmark</option>       
            <option>Djibouti</option>        
            <option>Dominica</option>        
            <option>Dominican Republic</option>
            <option>East Timor (Timor-Leste)</option>        
            <option>Ecuador</option>        
            <option>Egypt</option>        
            <option>El Salvador</option>        
            <option>Equatorial Guinea</option>        
            <option>Eritrea</option>        
            <option>Estonia</option>        
            <option>Eswatini</option>        
            <option>Ethiopia</option> 
            <option>Fiji</option>        
            <option>Finland</option>        
            <option>France</option> 
            <option>Gabon</option>
            <option>Gambia</option>        
            <option>Georgia</option>        
            <option>Germany</option>        
            <option>Ghana</option>        
            <option>Greece</option>        
            <option>Grenada</option>        
            <option>Guatemala</option>        
            <option>Guinea</option>        
            <option>Guinea-Bissau</option>        
            <option>Guyana</option>  
            <option>Haiti</option>        
            <option>Honduras</option>        
            <option>Hungary</option> 
            <option>Iceland</option>        
            <option>India</option>        
            <option>Indonesia</option>        
            <option>Iran</option>        
            <option>Iraq</option>        
            <option>Ireland</option>        
            <option>Israel</option>        
            <option>Italy</option> 
            <option>Jamaica</option>        
            <option>Japan</option>        
            <option>Jordan</option> 
            <option>Kazakhstan</option>        
            <option>Kenya</option>        
            <option>Kiribati</option>        
            <option>North Korea</option>        
            <option>South Korea</option>        
            <option>Kosovo</option>        
            <option>Kuwait</option>        
            <option>Kyrgyzstan</option>                                   
                    
            </optgroup>        
                                              
                    
           </select><br><br>
           <h6>Select Gender</h6>
           <br>
           <select name="gender" class="countries" >
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
           </select><br><br>
           <h6>Select Race</h6>
           <br>
           <select name="race" class="countries" >
            <option>Black</option>
            <option>White</option>
            <option>Indian</option>
            <option>Coloured</option>
            <option>Other</option>
           </select><br><br>
           <h6>Date of Birth</h6>
           <br>
           <input name="birthday" type="date" class="input-box" placeholder="Enter Date Of Birth In Format DD-MM-YYYY" <?php if(isset($_SESSION["birthday"])){echo 'value="'.$_SESSION["birthday"].'"';}; ?> required>
           <br><br>
           <h6>Upload Profile Picture</h6>
           
           <input name="image" id="file" type="file" accept="image/jpd,image/jpeg,image/png">
           <br>
           <div class="image">
                    <img id="image" class="filename">
               </div>
           <div class="fileupload">
            <label class="label"for="file">
       
                Choose Picture
               </label>
               
               
           </div>
           <br><br><br>
           
           <input type="checkbox" class="newsletter" value="newsletter" required><span>I accept the terms and conditions<br>
            and I vow to honour the copyright and privacy policies.</span>
            <input type="hidden" name="recommender" value="<?php
                    
                        echo "$recommender";
                    ?>">
            <input type="hidden" name="p" value="<?php echo "$p";?>">
           <button name= "submit" type="submit" class="submit-btn">Sign Up</button>
           
       </form>
    </div>
    </div>
    </div>
    </div>
    <footer>
    <section class="second_text">
        <p class="mark">&copy;Mirthh.com<sup>2023&reg;</sup></p>
        <div class="second_nav_links">
            <ul>
                <li><a href="privacypolicy.php">privacy policy</a></li>
                <li><a href="cookies.php">cookies</a></li>
                <li><a href="copyright.php">copyright</a></li>
                <li><a href="t&c's.php">conditions</a></li>
            </ul>
        </div>
    </section>
    </footer>
    </div>
    <noscript>
        <style type="text/css">
            html{
                display: none;
            }
            
        </style>
        <meta http-equiv="refresh" content="0.0;url=offline.php">
    </noscript>
    <script>
         const indicator = document.querySelector(".indicator");
         const input = document.querySelector("#input");
         const weak = document.querySelector(".weak");
         const medium = document.querySelector(".medium");
         const strong = document.querySelector(".strong");
         const text = document.querySelector(".text");
         let regExpWeak = /[a-z]/;
         let regExpMedium = /\d+/;
         let regExpStrong = /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/;
         function trigger(){
           if(input.value != ""){
             indicator.style.display = "block";
             indicator.style.display = "flex";
             if(input.value.length <= 3 && (input.value.match(regExpWeak) || input.value.match(regExpMedium) || input.value.match(regExpStrong)))no=1;
             if(input.value.length >= 6 && ((input.value.match(regExpWeak) && input.value.match(regExpMedium)) || (input.value.match(regExpMedium) && input.value.match(regExpStrong)) || (input.value.match(regExpWeak) && input.value.match(regExpStrong))))no=2;
             if(input.value.length >= 6 && input.value.match(regExpWeak) && input.value.match(regExpMedium) && input.value.match(regExpStrong))no=3;
             if(no==1){
               weak.classList.add("active");
               text.style.display = "flex";
               text.textContent = "Your password is too week";
               text.classList.add("weak");
             }
             if(no==2){
               medium.classList.add("active");
               text.textContent = "Your password is medium";
               text.classList.add("medium");
             }else{
               medium.classList.remove("active");
               text.classList.remove("medium");
             }
             if(no==3){
               weak.classList.add("active");
               medium.classList.add("active");
               strong.classList.add("active");
               text.textContent = "Your password is strong";
               text.classList.add("strong");
             }else{
               strong.classList.remove("active");
               text.classList.remove("strong");
             }
           }else{
             indicator.style.display = "none";
             text.style.display = "none";
           }
         }
      </script>
        <noscript>
        <style type="text/css">
            html{
                display: none;
            }
            
        </style>
        <meta http-equiv="refresh" content="0.0;url=offline.php">
    </noscript>
    <script src="js/signup.js"></script>
</body>
</html>