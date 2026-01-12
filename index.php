<!DOCTYPE html>
<html>
    <head>
        <meta lang="eng" charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Mirthh</title>
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <link href="css/index/layout.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
             <li><a href="index.php" id="home"><i class="fas fa-house"></i>Home</a></li>
             <li>
                <label for="check">
                    <i class="fas fa-bars" id="btn"></i>
                  </label>
             </li>
             <li><a href="About.php"><i class="fa-solid fa-note-sticky"></i>About</a></li>
             <li><a href="signup.php"><i class="fa-solid fa-arrow-up-from-bracket"></i>Sign up</a></li>
             <li><a href="login.php"><i class="fas fa-right-to-bracket"></i>Sign in</a></li>
         </ul>
     </div>
     </nav>
     <input type="checkbox" id="check">
    
     <div class="sidebar">
         <ul>
             <li><a href="index.php" id="home"><i class="fas fa-house"></i>Home</a></li>
             <li><a href="About.php"><i class="fa-solid fa-note-sticky"></i>About</a></li>
             <li><a href="signup.php"><i class="fa-solid fa-arrow-up-from-bracket"></i>Sign up</a></li>
             <li><a href="login.php"><i class="fas fa-right-to-bracket"></i>Sign In</a></li>  
         </ul>
     </div>
     <div class="c">
     <div class="main_text">
        <h1>Take Control<br>Of Your<br>Entertainment Life!</h1>
        <br>
        <br>
        <h3>Explore <b>content</b> you <b>love</b> all in <b>one</b>  place!</h3><br><br>
        <p><b>Watch & Listen</b> to what's <b>worth</b> your <b>time</b>!</p><br><br>
        <p>
         Stream <b>Series! & Videos!</b><br>
         Listen To <b>Music! & Podcasts!</b><br>
        </p>
        <br>
        <br>
        <h2>Still  <b>waiting</b>?</h2>
        <br>
        <br>
        <a class="signup" href="signup.php">Sign up</a>
        <br>
        <br>
        <br>
       
       </div>
       </div>
    </header>

    <section class="second_text">
            <p class="copyright">&copy;  Mirthh.com<sup>2023&reg;</sup>  </p>
           
           <!---- <div class="handles">
                <ul>
                    <li><a href=""><img src="youtube-logo-png-46031.png" alt=""></a></li>
                    <li><a href=""><img src="facebook-icon-png-732-1.png" alt=""></a></li>
                    <li><a href=""><img src="social-icon-png-1838.png" alt=""></a></li>
                    <li><a href=""><img src="instagram-icon-971.jpg" alt=""></a></li>
                </ul>
            </div>-->

            <div class="second_nav_links">
                <ul>
                    <li><a href="privacypolicy.php">privacy policy</a></li>
                    <li><a href="cookies.php">cookies</a></li>
                    <li><a href="copyright.php">copyright</a></li>
                    <li><a href="t&c's.php">conditions</a></li>
                </ul>
            </div>
        </section>
        <noscript>
        <style type="text/css">
            html{
                display: none;
            }
            
        </style>
        <meta http-equiv="refresh" content="0.0;url=offline.php">
    </noscript>
    <script>
/* Get the documentElement (<html>) to display the page in fullscreen */
var elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }
}
</script>
    </body>

</html>
