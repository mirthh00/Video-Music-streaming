<?php
session_start();
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

<?php

if(isset($_GET["ID"]))
{
    $theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
    }
    else{
        $color="dark-theme";
    }
    include 'includes/accountdatabase.inc.php';
   
    $ID=mysqli_real_escape_string($conn,$_GET["ID"]);
    $sql="SELECT * FROM intellipreneurs WHERE id=$ID;";
    $data=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($data);
    $sql2="SELECT * FROM unlockedaccounts WHERE accountid=$ID;";
    $data2=mysqli_query($conn,$sql2);
    $row2=mysqli_num_rows($data2);
    $row2 = currencyFormat($row2);
    include 'includes/contentdatabase.inc.php';
    $sql3="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql3)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result3=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum2=mysqli_num_rows($result3);
    $rownum2 = currencyFormat($rownum2);
    $sql13="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql13)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result13=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum13=mysqli_num_rows($result13);

    $sql21="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql21)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result21=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum21=mysqli_num_rows($result21);

    $sql14="SELECT * FROM albums WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql14)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result14=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum14=mysqli_num_rows($result14);
    $rownum14 = currencyFormat($rownum14);
    $sql15="SELECT * FROM music WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql15)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result15=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum15=mysqli_num_rows($result15);
    $rownum15 = currencyFormat($rownum15);
    $sql22="SELECT * FROM podcasts WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql22)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result22=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum22=mysqli_num_rows($result22);
    $rownum22 = currencyFormat($rownum22);
    include 'includes/accountdatabase.inc.php';
    $sql4="SELECT * FROM rooms WHERE  roomname=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql4)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result4=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row4=mysqli_fetch_assoc($result4);
    $rownum3=mysqli_num_rows($result4);

    include 'includes/contentdatabase.inc.php';
    $sql6="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql6)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result6=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum6=mysqli_num_rows($result6);

    include 'includes/contentdatabase.inc.php';
    $sql7="SELECT * FROM videos WHERE  uploader=? ORDER BY id DESC;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql7)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$row["accountname"]);
    mysqli_stmt_execute($stmt);
    $result7=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum7=mysqli_num_rows($result7);

    $day="December 12";
    $sql24="SELECT * FROM analytics WHERE  uploader=? AND day=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql24)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$row["accountname"],$day);
    mysqli_stmt_execute($stmt);
    $result24=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum24=mysqli_num_rows($result24);
    $totalviews=0;
    $totalviews1=0;
    if($rownum24>0){
    while($row24=mysqli_fetch_assoc($result24)){
        $totalviews=$totalviews+$row24["totalviews"];
    }
}
    $day1="December 14";
    $sql25="SELECT * FROM analytics WHERE  uploader=? AND day=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql25)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$row["accountname"],$day1);
    mysqli_stmt_execute($stmt);
    $result25=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum25=mysqli_num_rows($result25);
    if($rownum25>0){
    while($row25=mysqli_fetch_assoc($result25)){
        $totalviews1=$totalviews1+$row25["totalviews"];
    }
}
    $totalviews2=$totalviews1-$totalviews;
    $totalviews3=$totalviews+$totalviews1;
    if($totalviews3<=0){
        $totalpercent = 0;
    }
    else{
        $totalpercent = ($totalviews2/$totalviews3)*100;
    }
    
    $totalpercent = round($totalpercent,2);
    if($totalpercent<0){
        $totalpercent=$totalpercent*-1;
    }
    $month="December";
    $sql26="SELECT * FROM videos WHERE  uploader=? AND month=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql26)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$row["accountname"],$month);
    mysqli_stmt_execute($stmt);
    $result26=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum26=mysqli_num_rows($result26);

    $month1="January";
    $sql27="SELECT * FROM videos WHERE  uploader=? AND month=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql27)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$row["accountname"],$month1);
    mysqli_stmt_execute($stmt);
    $result27=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $rownum27=mysqli_num_rows($result27);

    $totaluploads=$rownum26 + $rownum27;
    $uploadifference=$rownum27-$rownum26;

    if($totaluploads<=0){
        $uploadpercent = 0;
    }
    else{
        $uploadpercent = ($uploadifference/$totaluploads)*100;
    }
    $uploadpercent = round($uploadpercent,2);
    if($uploadpercent<0){
        $uploadpercent=$uploadpercent * -1;
    }

    include 'includes/dbh.inc.php';
   
    $username=$_SESSION["username"];
    $sql23="SELECT * FROM users WHERE usersUid=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql23)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);
    $data3=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $row5=mysqli_fetch_assoc($data3);
    if(!empty($row5["recommender"])){

    
    $recommender=$row5["recommender"];
    }
    else{
        $recommender = "None";
    }

    include 'includes/contentdatabase.inc.php';
}


?>

<?php
/**
 * @param array $data
 * @param null $passPhrase
 * @return string
 */
function generateSignature($data, $passPhrase = null) {
    // Create parameter string
    $pfOutput = '';
    foreach( $data as $key => $val ) {
        if($val !== '') {
            $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
        }
    }
    // Remove last ampersand
    $getString = substr( $pfOutput, 0, -1 );
    if( $passPhrase !== null ) {
        $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
    }
    return md5( $getString );
}

// Construct variables
$cartTotal = $row["price"]+'.00'; // This amount needs to be sourced from your application
$passphrase = 'jt7NOE43FZPn';
$data = array(
    // Merchant details
    'merchant_id' => '10000100',
    'merchant_key' => '46f0cd694581a',
    'return_url' => 'https://d494-41-13-2-166.eu.ngrok.io/Mirth/success.php?a='.$ID.'',
    'cancel_url' => 'https://d494-41-13-2-166.eu.ngrok.io/Mirth/subscribe.php?ID='.$ID.'&error=yes',
    // Buyer details
    'name_first' => 'First Name',
    'name_last'  => 'Last Name',
    'email_address'=> 'test@test.com',
    // Transaction details
    'm_payment_id' => '1234', //Unique payment ID to pass through to notify_url
    'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', '' ),
    'item_name' => ''.$row["accountname"].' Channel'
);

$signature = generateSignature($data, $passphrase);
$data['signature'] = $signature;

// If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
$testingMode = true;
$pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
$htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post">';
foreach($data as $name=> $value)
{
    $htmlForm .= '<input name="'.$name.'" type="hidden" value=\''.$value.'\' />';
}
$htmlForm .= '<div class="paybtn"><button name="pay" id="paymentbutton">PAY '.$row["price"].' '.$row["currency"].'s</button></div></form>';

?>


<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $row["accountname"]; ?></title>
        <link href="css/subscribe/subscribe.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="profilepictures/<?php echo $row["profileimage"];?>">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <meta lang="en" charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body class="<?php echo "$color";?>">
    
        <div class="coverbanner">
            <img class="cover" src="intelliprenuercoverpictures/<?php echo $row["coverimage"];?>" alt="">
            <div class="pd">
            <div class="pdn">
            
            <div class="img">
                <img class="profile" src="profilepictures/<?php echo $row["profileimage"];?>" >
            </div>
            
            <div class="details">
                <div class="n">
                    <div class="tv">
                    <h1><?php echo $row["accountname"]; ?><img src="images/check.png" alt=""></h1>
                    
                    </div>
                
                <?php 
                    if($row["catagory"]=="Music"){
                        
                        echo '<p>'.$row2.' Unlockers | '.$rownum2.' Music Videos | '.$rownum14.' Albums | '.$rownum15.' Songs ';
                    }
                    else if($row["catagory"]=="Podcasts"){
                        echo '<p>'.$row2.' Unlockers | '.$rownum2.' Podcasts Videos | '.$rownum22.' Podcasts ';
                    }
                    else{
                        echo '<p>'.$row2.' Unlockers | '.$rownum2.' Videos';
                    }
                ?>
            </div>
            </div>
            </div>
        </div>
     
        <br>
        <?php if(isset($_GET["error"])){
            echo" <div class='contentcatagory'>
            <p class='error'>Sorry,your payment was cancelled please try again...</p>
        </div>";
        }
        ?>
        <div class="contentcatagory">
            <h1><?php echo $row["genre"]; ?> <?php echo $row["catagory"]; ?></h1>
        </div>
        <div class="contentcatagory">
            <h2>Account Verification Video</h2>
        </div>
        <br>
        <div class="verification-vid">
            <video src="content/videos/<?php echo $row["accountname"];?>/<?php echo $row["verificationvideo"];?>" controls autoplay  oncontextmenu="return false;" controlsList="nodownload"></video>
        </div>

        <div class="contentcatagory">
            <h2>Account Overview Video</h2>
        </div>
        <br>
        <div class="verification-vid">
            <video src="content/videos/<?php echo $row["accountname"];?>/<?php echo $row["overviewvideo"];?>" controls   oncontextmenu="return false;" controlsList="nodownload"></video>
        </div>
        <br><br>
        <div class="contentcatagory">
            <h1>About</h1>
        </div>
        <br>
        <div class="d">
            <p><?php echo $row["bio"];?>
            </p>
            <div class="contentcatagory">
            <h2>Inspiration</h2>
            </div>
            <br>
            <p><?php echo $row["inspiration"];?>
            </p>
            <div class="contentcatagory">
            <h2>Vision</h2>
            </div>
            <br>
            <p><?php echo $row["vision"];?>
            </p>
            <div class="contentcatagory">
            <h2>Promise</h2>
            </div>
            <br>
            <p><?php echo $row["promise"];?>
            </p>
        </div>
        <br><br>
        <div class="contentcatagory">
            <h1>Account Details</h1>
        </div>
        <div class="u">
            <div class="contentcatagory">
            <h2>Unlockers Engagement Rate</h2>
           
            </div>
            <br>
            <?php
            if($totalviews2>0){
                echo"<p><b>Increased</b> by <b>$totalpercent%</b> from last month</p>";
            }
            else if($totalviews2==0){
                echo "<p>No change in unlockers engagement rate from last month</p>";
            }
            else{
                echo"<p><b id='d'>Decreased</b> by <b id='d'>$totalpercent%</b> from last month</p>";
            }
            ?>
            <div class="contentcatagory">
            <h2>Uploading Rate</h2>
            </div>
            <br>
            <?php
            if($uploadifference>0){
                echo"<p><b>Increased</b> by <b>$uploadpercent%</b> from last month</p>";
            }
            else if($uploadifference==0){
                echo "<p>No change in uploading rate from last month</p>";
            }
            else{
                echo"<p><b id='d'>Decreased</b> by <b id='d'>$uploadpercent%</b> from last month</p>";
            }
            ?>
            <div class="contentcatagory">
            <h2>Unlocking Rate</h2>
            </div>
            <br>
            <p><b>Increased</b> by <b>6.67%</b> from last month</p>
            <div class="contentcatagory">
            <h2>Hangout Spot</h2>
            </div>
            <br>
            <?php 
            if($row["room"]=="Yes"){

            ?>
            <p><?php echo $_SESSION["username"];?>,We have a hangout spot where fans from all over the world get to hangout with <?php echo $row["accountname"];?> 
            and have lots of fun as a family.We treat each other with love and respect as we get to know each other beyond content.
            We believe you're not a fan but a family member therefore feel free to interect with your brothrs and sisters.Thank You!    
            </p>
            <?php
            }
            else{
                ?>
                <p><?php echo $_SESSION["username"];?>,unfortunately we have not created a hangout spot yet for some other reasons but we will as time goes on.
                We apologize genuinely for the inconvinience.Thank You!    
                </p>
                <?php
                
            }
            ?>
            
        </div>
        <br><br>
        <div class="contentcatagory">
            <h1>Payment</h1>
        </div>
        <br><br>
        <div class="subscribe">
            <div class="subscribebox">
                <p id="paymentinfo">Pay to unlock the content inside this account.To show support and love
                    to <?php echo $row["accountname"];?>.The 
                    payment will grant you access to this account for
                    a month and will not be auto billed.Thank you for unlocking my account.Thank you
                    for believing in my <?php echo $row["catagory"];?>.You're highly appreciated <?php echo $_SESSION["username"];?>!
                </p>
                <div class="subaccount">
                <form method="POST" action="includes/unlockedaccounts.inc.php">
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row["accountname"];
                echo "$useremail";
                ?>" name="accountname"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row["id"];
                echo "$useremail";
                ?>" name="accountid"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row["profileimage"];
                echo "$useremail";
                ?>" name="profilename"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$_SESSION["username"];
                echo "$useremail";
                ?>" name="username"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$_SESSION["fullname"];
                echo "$useremail";
                ?>" name="userfullname"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$_SESSION["useremail"];
                echo "$useremail";
                ?>" name="useremail"> 
                 <input type="hidden" class="input-box" value="<?php 
                $useremail=$row["catagory"];
                echo "$useremail";
                ?>" name="catagory"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$_SESSION["userid"];
                echo "$useremail";
                ?>" name="userid"> 
                 <input type="hidden" class="input-box" value="<?php 
                $useremail=$row4["roomid"];
                echo "$useremail";
                ?>" name="roomid"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row4["roomname"];
                echo "$useremail";
                ?>" name="roomname"> 
                <input type="hidden" class="input-box" value="<?php 
                echo "$recommender";
                ?>" name="recommender"> 
                  <input type="hidden" class="input-box" value="<?php 
                $price=$row["price"];
                echo "$price";
                ?>" name="price"> 
                
                </div>
                </form>

               <?php echo $htmlForm;?>
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
</body>

</html>