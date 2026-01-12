<?php
session_start();
    if(isset($_GET["v"])){
        $v=$_GET["v"];
    }
    else{
        $v="none";
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
    <title>Mirthh-Signin</title>
    <meta lang="en" charset="UTF-8">
    <link href="css/signup/signup.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
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
             <li><a href="signup.php"><i class="fa-solid fa-arrow-up-from-bracket"></i>Sign up</a></li>
                <li><a href="login.php" id="home"><i class="fas fa-right-to-bracket"></i>Sign in</a></li>
            </ul>
        </div>
        </nav>
    </header>
    <input type="checkbox" id="check">
    <div class="sidebar">
        <ul>
            <li><a href="index.php"><i class="fas fa-house"></i>Home</a></li>
            <li><a href="About.php"><i class="fa-solid fa-note-sticky"></i>About</a></li>
             <li><a href="signup.php"><i class="fa-solid fa-arrow-up-from-bracket"></i>Sign up</a></li>
            <li><a href="login.php" id="home"><i class="fas fa-right-to-bracket"></i>Sign In</a></li>  
        </ul>
    </div>

    
    <div class="sign-up-box">
    <div class="card">
    <div class="inner-box" id="card">
   
    <div class="card-front">
        <h2><big>Sign In</big></h2>
        <?php
        if($error!="none"){
            if($error=="invalidpassword"){
            echo'<p id="error">incorrect password</p>';
            }
            elseif($error=="invalidemail"){
                echo'<p id="error">incorrect Email</p>';
            }
            elseif($error=="invalidusername"){
                echo'<p id="error">incorrect username</p>';
            }
            elseif($error=="invaliduser"){
                echo'<p id="error">Oups!,Something Went Wrong!</p>';
            }
            elseif($error=="invalidusernameandemail"){
                echo'<p id="error">Incorrect Username And Email</p>';
            }
            elseif($error=="noaccess"){
                echo'<p id="error">No Authorised Access</p>';
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
        
        <form action="includes/login.inc.php" method="post">
            <br>
            <br>
            <input name="username" id="username" type="text" class="input-box" placeholder="Enter Username" <?php if(isset($_SESSION["username"])){echo 'value="'.$_SESSION["username"].'"';}; ?> required>
            <br>
            <br>
            <input name="useremail" id="useremail" type="email" class="input-box" placeholder="Enter Email Adress" <?php if(isset($_SESSION["email"])){echo 'value="'.$_SESSION["email"].'"';}; ?> required>
            <br>
            <br>
            <input name="userpassword" id="password" type="password" class="input-box" placeholder="Enter Password" <?php if(isset($_SESSION["password"])){echo 'value="'.$_SESSION["password"].'"';}; ?> required>
             <br>
            <input type="checkbox" name="" id=""onclick="toggle()"><Span>. Show Password</Span>
            <br>
            <br>
            <br>
            <input type="hidden" name="v" value="<?php echo "$v";?>">
            <input type="hidden" name="p" value="<?php echo "$p";?>">
            <button name="submit" class="submit-btn">Login</button>
            
        </form>
     
        <a href="password.php">Forgot Password</a>

        <br>
      
        

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
    <script>
    function toggle(){
            var state= false;
    if(state){
	document.getElementById("password").setAttribute("type","password");
	state = false;
     }
     else{
	document.getElementById("password").setAttribute("type","text");
	state = true;
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
   
    
</body>
</html>