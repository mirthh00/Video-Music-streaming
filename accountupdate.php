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
include 'includes/accountdatabase.inc.php';
$fullname=$_SESSION["fullname"];
$sql3="SELECT * FROM intellipreneurs WHERE  accountholder=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql3)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname);
mysqli_stmt_execute($stmt);
$result3=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row3=mysqli_fetch_assoc($result3);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mirth</title>
    <meta lang="en" charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/accountupdate/accountupdate.css" rel="stylesheet">
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
        <div class="n">
       <h2><big>Account Update</big></h2>
       </div>
      
       <form method="POST" action="includes/accountupdate.inc.php" enctype="multipart/form-data">
        <br>
        <div class="n">
        <img id='account-btn' class='account' src='profilepictures/<?php echo $row3["profileimage"];?>'>
        </div>
           
           <h6>Change Account Name</h6>
           
           <input type="text" class="input-box" placeholder="Enter New Account Name"  name="newaccountname">
        
           <h6>Change Your Profile Picture</h6>
           
           <input type="file" class="userimage"  id="file2" name="profile" accept="image/jpd,image/jpeg,image/png">
           <div class="fileupload2">
           <div class="n">
               <img  id="image" class="filename2">
               </div>
           <div class="n">

          
            <label for="file2">
       
                Choose Picture
               </label>
               </div>   
           </div>
           
           <h6>Change Your Cover Picture</h6>
           
           <input type="file" class="userimage"  id="file" name="cover" accept="image/jpd,image/jpeg,image/png">
           <div class="fileupload">
           <div class="n">
               <img  id="image2" class="filename">
               </div>
               <div class="n">

               
            <label for="file">
       
                Choose Picture
               </label>
               </div>
           </div>
           
           <h6>Change Account Bio</h6>
           <input type="text" class="input-box" placeholder="Enter New Account Bio"  name="bio">
           
           <h6>Change Unlocking Price</h6>
           <input type="number" class="input-box" placeholder="Enter New Unlocking Price Excluding Currency Abreviation"  name="price">
           <br>
           <input type="hidden" name="accountname" value="<?php
                            
                            echo $row3["accountname"];
                        ?>">
                         <input type="hidden" name="accountid" value="<?php
                            $accountid=$row3["id"];
                            echo "$accountid";
                        ?>">
           <button class="submit-btn" name="update">Update</button>
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