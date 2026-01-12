<!DOCTYPE html>
<html>
<head>
    <title>Mirth Signup/Signin</title>
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
                <li><a href="About.php"><i class="fas fa-scroll"></i>About</a></li>
                <li><a href="signup.php" ><i class="fas fa-file-signature"></i>Sign Up</a></li>
                <li><a href="login.php"><i class="fas fa-right-to-bracket"></i>Sign in</a></li>
            </ul>
        </div>
        </nav>
    </header>
    <input type="checkbox" id="check">
    <div class="sidebar">
        <ul>
            <li><a href="index.php"><i class="fas fa-house"></i>Home</a></li>
            <li><a href="About.php"><i class="fas fa-scroll"></i>About</a></li>
            <li><a href="signup.php"><i class="fas fa-file-signature"></i>Sign Up</a></li>
            <li><a href="login.php"><i class="fas fa-right-to-bracket"></i>Sign In</a></li>  
        </ul>
    </div>

    
    <div class="sign-up-box">
    <div class="card">
    <div class="inner-box" id="card">
   
    <div class="card-front">
        <h2><big>USER VALIDATE</big></h2>
        <form action="includes/uservalidate.inc.php" method="post">
            <br>
            <br>
            
            <br>
            <br>
           
            <br>
            <br>
            <input name="code" type="text" class="input-box" placeholder="Enter Validation Code" required>
            <br>
            <br>
            <br>
            <br>
            <button name="submit" class="submit-btn">VALIDATE ME!</button>
            
        </form>
        

    </div>
    </div>
    </div>
    </div>
    <footer>
    <section class="second_text">
        <p>&copy;Mirthh.com<sup>2022</sup></p>
        <div class="second_nav_links">
            <ul>
                <li><a href="privacypolicy.php">privacy policy</a></li>
                <li><a href="cookies.php">cookies</a></li>
                <li><a href="copyright.php">copyright</a></li>
                <li><a href="t&c's.php">terms&conditions</a></li>
            </ul>
        </div>
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