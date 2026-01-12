<?php
session_start();
date_default_timezone_set("Africa/Johannesburg");
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}
$username=$_SESSION["username"];
$theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
    }
    else{
        $color="dark-theme";
    }
include 'includes/dbh.inc.php';
$sql="SELECT * FROM users WHERE recommended=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){
   header("location: ../signup.php?error=stmtfailed");
   exit();
}

mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum=mysqli_num_rows($data);

include 'includes/accountdatabase.inc.php';


$sql5="SELECT * FROM unlockedaccounts WHERE recommender=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql5)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$username);
mysqli_stmt_execute($stmt);
$data1=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$rownum4=mysqli_num_rows($data1);

$revenue=10*($rownum4/100);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Mirthh Affiliate Links</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <meta lang="en" charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/affiliatelinks/affiliatelinks.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        .responses h6 {
            color: red;
            font-style: italic;
        }
    </style>
      <link rel="stylesheet" type="text/css" href="css/affiliatelinks/jssocials.css"/>
      <link rel="stylesheet" type="text/css" href="css/affiliatelinks/jssocials-theme-flat.css"/>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/jssocials.min.js"></script>
</head>
<body class="<?php echo "$color";?>">
    <header>
        <nav>
        <a href="home.php"><img src="images/Logopit_1648978873138.png"></a>
        </nav>
       
    </header>

    <div class="chartspace">
      
       

        <div class="board">
            <h1 id="boardtitle">WELCOME <?php echo "$username"; ?>!</h1>
            <h1 id="boardtitle">AFFILIATE LINK ANALYTICS</h1>
            <div class="contentcontainer">
         
                <div class="info-container">
                    <div class="information">
                        
                        <p>Number Of People Who Signed Up : <?php echo "$rownum"; ?></p>
                        <p>Number Of Unlockers : <?php echo "$rownum4"; ?></p>
                       
                        <p>Revenue : R<?php echo "$revenue"; ?></p>
                        <p>Link : localhost/Mirth/signup.php?a=<?php echo "$username"; ?></p>
                        <div id="share"></div>
                    </div>
                    
                </div>
              
            </div>
            
          

            <br><br><br><br>
        </div>
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
        $(document).ready(function(){
        $("#share").jsSocials({
            url: "localhost/Mirth/signup.php?a=<?php echo "$username"; ?>",
            text: "Signup with Mirthh and watch great content of your favourite creators!",
            showLabel: false,
            shares: ["twitter", "facebook", "whatsapp","linkedin", "pinterest"],
        })
    })
    </script>
</body>
</html>