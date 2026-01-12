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

    include 'includes/accountdatabase.inc.php';
    $theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
    }
    else{
        $color="dark-theme";
    }
   
    $accountname=mysqli_real_escape_string($conn,$_GET["a"]);
    
    $sql="SELECT * FROM intellipreneurs WHERE accountname='$accountname';";
    $data=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($data);
    $accountid = $row["id"];
    $sql2="SELECT * FROM unlockedaccounts WHERE accountid=$accountid;";
    $data2=mysqli_query($conn,$sql2);
    $row2=mysqli_num_rows($data2);
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
    include 'includes/contentdatabase.inc.php';
    $sql3="SELECT * FROM videos WHERE  uploader=?;";
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
    'return_url' => 'https://3569-41-13-0-1.eu.ngrok.io/Mirth/success.php?a='.$accountid.'',
    'cancel_url' => 'https://3569-41-13-0-1.eu.ngrok.io/Mirth/activate.php?a='.$accountname.'&error=yes',
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
        <title>Activate your channel</title>
        <link href="css/bio/bio.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="profilepictures/<?php echo $row["profileimage"];?>">
        <meta lang="en" charset="UTF-8">
        <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        </style>
    </head>
    <body class="<?php echo "$color";?>">
        <div class="coverbanner">
            <img class="cover" src="intelliprenuercoverpictures/<?php echo $row["coverimage"];?>" alt="">
            <div class="pd">
                <div class="pdn">
            <img class="profile" src="profilepictures/<?php echo $row["profileimage"];?>" >
            <div class="details">
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
        <br><br><br><br>
        <div class="subscribe">
            <div class="subscribebox">
                
                <div class="subaccount">
                 <p id="details">Congratulations on being a mirthher!Please proceed to pay your unlocking amount 
                    as a way to validate that the unlocking price you have set is reasonable and affordable.Thereafter 
                    your channel will be activated and visible for people to unlock.
                 </p> 
                </div>
                <div class="subaccount">
                
                <?php echo $htmlForm;?>
                </div>
                
                
                
              
                
            </div>
        </div>
        <br><br>
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