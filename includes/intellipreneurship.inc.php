<?php
session_start();
if(isset($_SESSION["username"])){
    require_once "functions.inc.php";
}
else{
    header("location: ../login.php");
    exit();
}
?>

<?php
require_once 'accountdatabase.inc.php';
if (isset($_POST["submit"]))
{
    date_default_timezone_set("Africa/Johannesburg");
    $creationdate=date("Y-m-d");
    $accountholder=$_SESSION["fullname"];
    $accountname=mysqli_real_escape_string($conn,$_POST["accountname"]);
    $catagory=mysqli_real_escape_string($conn,$_POST["catagory"]);
    $genre=mysqli_real_escape_string($conn,$_POST["genre"]);
    $accountbio=mysqli_real_escape_string($conn,$_POST["accountbio"]);
    $price=mysqli_real_escape_string($conn,$_POST["price"]);
    $currency=mysqli_real_escape_string($conn,$_POST["currency"]);
    $country=$_SESSION["country"];
    $room=mysqli_real_escape_string($conn,$_POST["room"]);
    $inspiration=mysqli_real_escape_string($conn,$_POST["inspiration"]);
    $promise=mysqli_real_escape_string($conn,$_POST["promise"]);
    $vision=mysqli_real_escape_string($conn,$_POST["vision"]);
    $uploadcount=mysqli_real_escape_string($conn,$_POST["uploadcount"]);
    $uploadays=mysqli_real_escape_string($conn,$_POST["uploadays"]);
    $uploadtime=mysqli_real_escape_string($conn,$_POST["uploadtime"]);
    $timezone=mysqli_real_escape_string($conn,$_POST["timezone"]);
    $roomid=str_shuffle("QWERTasdgd12345");
    $useremail=$_SESSION["useremail"];

    if(strpos($accountname,$check1) || strpos($accountname,$check2) || strpos($accountname,$check3) || strpos($accountname,$check4) || strpos($accountname,$check5)
    || strpos($accountname,$check6) || strpos($accountname,$check7) || strpos($accountname,$check8) || strpos($accountname,$check9) || strpos($accountname,$check10)
    || strpos($accountname,$check11) || strpos($accountname,$check12) || strpos($accountname,$check13) || strpos($accountname,$check14)
    || strpos($accountname,$check15) || strpos($accountname,$check16) || strpos($accountname,$check17) || strpos($accountname,$check18) || strpos($accountname,$check19)
    || strpos($accountname,$check20) || strpos($accountname,$check21) || strpos($accountname,$check22) || strpos($accountname,$check23)
    || strpos($accountname,$check24) || strpos($accountname,$check25) || strpos($accountname,$check26) || strpos($accountname,$check27) || strpos($accountname,$check28)
    || strpos($accountname,$check29) || strpos($accountname,$check30) || strpos($accountname,$check31) || strpos($accountname,$check32)
    || strpos($accountname,$check33) || strpos($accountname,$check34) || strpos($accountname,$check35) || strpos($accountname,$check36) || strpos($accountname,$check37)
    || strpos($accountname,$check38) || strpos($accountname,$check39) || strpos($accountname,$check40) || strpos($accountname,$check41) || strpos($accountname,$check42)
    || strpos($accountname,$check43) || strpos($accountname,$check44) || strpos($accountname,$check45) || strpos($accountname,$check46) || strpos($accountname,$check47) || strpos($accountname,$check48) 
    || strpos($accountname,$check49) || strpos($accountname,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }

    if(strpos($catagory,$check1) || strpos($catagory,$check2) || strpos($catagory,$check3) || strpos($catagory,$check4) || strpos($catagory,$check5)
    || strpos($catagory,$check6) || strpos($catagory,$check7) || strpos($catagory,$check8) || strpos($catagory,$check9) || strpos($catagory,$check10)
    || strpos($catagory,$check11) || strpos($catagory,$check12) || strpos($catagory,$check13) || strpos($catagory,$check14)
    || strpos($catagory,$check15) || strpos($catagory,$check16) || strpos($catagory,$check17) || strpos($catagory,$check18) || strpos($catagory,$check19)
    || strpos($catagory,$check20) || strpos($catagory,$check21) || strpos($catagory,$check22) || strpos($catagory,$check23)
    || strpos($catagory,$check24) || strpos($catagory,$check25) || strpos($catagory,$check26) || strpos($catagory,$check27) || strpos($catagory,$check28)
    || strpos($catagory,$check29) || strpos($catagory,$check30) || strpos($catagory,$check31) || strpos($catagory,$check32)
    || strpos($catagory,$check33) || strpos($catagory,$check34) || strpos($catagory,$check35) || strpos($catagory,$check36) || strpos($catagory,$check37)
    || strpos($catagory,$check38) || strpos($catagory,$check39) || strpos($catagory,$check40) || strpos($catagory,$check41) || strpos($catagory,$check42)
    || strpos($catagory,$check43) || strpos($catagory,$check44) || strpos($catagory,$check45) || strpos($catagory,$check46) || strpos($catagory,$check47) || strpos($catagory,$check48) 
    || strpos($catagory,$check49) || strpos($catagory,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    if(strpos($genre,$check1) || strpos($genre,$check2) || strpos($genre,$check3) || strpos($genre,$check4) || strpos($genre,$check5)
    || strpos($genre,$check6) || strpos($genre,$check7) || strpos($genre,$check8) || strpos($genre,$check9) || strpos($genre,$check10)
    || strpos($genre,$check11) || strpos($genre,$check12) || strpos($genre,$check13) || strpos($genre,$check14)
    || strpos($genre,$check15) || strpos($genre,$check16) || strpos($genre,$check17) || strpos($genre,$check18) || strpos($genre,$check19)
    || strpos($genre,$check20) || strpos($genre,$check21) || strpos($genre,$check22) || strpos($genre,$check23)
    || strpos($genre,$check24) || strpos($genre,$check25) || strpos($genre,$check26) || strpos($genre,$check27) || strpos($genre,$check28)
    || strpos($genre,$check29) || strpos($genre,$check30) || strpos($genre,$check31) || strpos($genre,$check32)
    || strpos($genre,$check33) || strpos($genre,$check34) || strpos($genre,$check35) || strpos($genre,$check36) || strpos($genre,$check37)
    || strpos($genre,$check38) || strpos($genre,$check39) || strpos($genre,$check40) || strpos($genre,$check41) || strpos($genre,$check42)
    || strpos($genre,$check43) || strpos($genre,$check44) || strpos($genre,$check45) || strpos($genre,$check46) || strpos($genre,$check47) || strpos($genre,$check48) 
    || strpos($genre,$check49) || strpos($genre,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }

    if(strpos($accountbio,$check1) || strpos($accountbio,$check2) || strpos($accountbio,$check3) || strpos($accountbio,$check4) || strpos($accountbio,$check5)
    || strpos($accountbio,$check6) || strpos($accountbio,$check7) || strpos($accountbio,$check8) || strpos($accountbio,$check9) || strpos($accountbio,$check10)
    || strpos($accountbio,$check11) || strpos($accountbio,$check12) || strpos($accountbio,$check13) || strpos($accountbio,$check14)
    || strpos($accountbio,$check15) || strpos($accountbio,$check16) || strpos($accountbio,$check17) || strpos($accountbio,$check18) || strpos($accountbio,$check19)
    || strpos($accountbio,$check20) || strpos($accountbio,$check21) || strpos($accountbio,$check22) || strpos($accountbio,$check23)
    || strpos($accountbio,$check24) || strpos($accountbio,$check25) || strpos($accountbio,$check26) || strpos($accountbio,$check27) || strpos($accountbio,$check28)
    || strpos($accountbio,$check29) || strpos($accountbio,$check30) || strpos($accountbio,$check31) || strpos($accountbio,$check32)
    || strpos($accountbio,$check33) || strpos($accountbio,$check34) || strpos($accountbio,$check35) || strpos($accountbio,$check36) || strpos($accountbio,$check37)
    || strpos($accountbio,$check38) || strpos($accountbio,$check39) || strpos($accountbio,$check40) || strpos($accountbio,$check41) || strpos($accountbio,$check42)
    || strpos($accountbio,$check43) || strpos($accountbio,$check44) || strpos($accountbio,$check45) || strpos($accountbio,$check46) || strpos($accountbio,$check47) || strpos($accountbio,$check48) 
    || strpos($accountbio,$check49) || strpos($accountbio,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    if(strpos($price,$check1) || strpos($price,$check2) || strpos($price,$check3) || strpos($price,$check4) || strpos($price,$check5)
    || strpos($price,$check6) || strpos($price,$check7) || strpos($price,$check8) || strpos($price,$check9) || strpos($price,$check10)
    || strpos($price,$check11) || strpos($price,$check12) || strpos($price,$check13) || strpos($price,$check14)
    || strpos($price,$check15) || strpos($price,$check16) || strpos($price,$check17) || strpos($price,$check18) || strpos($price,$check19)
    || strpos($price,$check20) || strpos($price,$check21) || strpos($price,$check22) || strpos($price,$check23)
    || strpos($price,$check24) || strpos($price,$check25) || strpos($price,$check26) || strpos($price,$check27) || strpos($price,$check28)
    || strpos($price,$check29) || strpos($price,$check30) || strpos($price,$check31) || strpos($price,$check32)
    || strpos($price,$check33) || strpos($price,$check34) || strpos($price,$check35) || strpos($price,$check36) || strpos($price,$check37)
    || strpos($price,$check38) || strpos($price,$check39) || strpos($price,$check40) || strpos($price,$check41) || strpos($price,$check42)
    || strpos($price,$check43) || strpos($price,$check44) || strpos($price,$check45) || strpos($price,$check46) || strpos($price,$check47) || strpos($price,$check48) 
    || strpos($price,$check49) || strpos($price,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    if(strpos($currency,$check1) || strpos($currency,$check2) || strpos($currency,$check3) || strpos($currency,$check4) || strpos($currency,$check5)
    || strpos($currency,$check6) || strpos($currency,$check7) || strpos($currency,$check8) || strpos($currency,$check9) || strpos($currency,$check10)
    || strpos($currency,$check11) || strpos($currency,$check12) || strpos($currency,$check13) || strpos($currency,$check14)
    || strpos($currency,$check15) || strpos($currency,$check16) || strpos($currency,$check17) || strpos($currency,$check18) || strpos($currency,$check19)
    || strpos($currency,$check20) || strpos($currency,$check21) || strpos($currency,$check22) || strpos($currency,$check23)
    || strpos($currency,$check24) || strpos($currency,$check25) || strpos($currency,$check26) || strpos($currency,$check27) || strpos($currency,$check28)
    || strpos($currency,$check29) || strpos($currency,$check30) || strpos($currency,$check31) || strpos($currency,$check32)
    || strpos($currency,$check33) || strpos($currency,$check34) || strpos($currency,$check35) || strpos($currency,$check36) || strpos($currency,$check37)
    || strpos($currency,$check38) || strpos($currency,$check39) || strpos($currency,$check40) || strpos($currency,$check41) || strpos($currency,$check42)
    || strpos($currency,$check43) || strpos($currency,$check44) || strpos($currency,$check45) || strpos($currency,$check46) || strpos($currency,$check47) || strpos($currency,$check48) 
    || strpos($currency,$check49) || strpos($currency,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }

    if(strpos($room,$check1) || strpos($room,$check2) || strpos($room,$check3) || strpos($room,$check4) || strpos($room,$check5)
    || strpos($room,$check6) || strpos($room,$check7) || strpos($room,$check8) || strpos($room,$check9) || strpos($room,$check10)
    || strpos($room,$check11) || strpos($room,$check12) || strpos($room,$check13) || strpos($room,$check14)
    || strpos($room,$check15) || strpos($room,$check16) || strpos($room,$check17) || strpos($room,$check18) || strpos($room,$check19)
    || strpos($room,$check20) || strpos($room,$check21) || strpos($room,$check22) || strpos($room,$check23)
    || strpos($room,$check24) || strpos($room,$check25) || strpos($room,$check26) || strpos($room,$check27) || strpos($room,$check28)
    || strpos($room,$check29) || strpos($room,$check30) || strpos($room,$check31) || strpos($room,$check32)
    || strpos($room,$check33) || strpos($room,$check34) || strpos($room,$check35) || strpos($room,$check36) || strpos($room,$check37)
    || strpos($room,$check38) || strpos($room,$check39) || strpos($room,$check40) || strpos($room,$check41) || strpos($room,$check42)
    || strpos($room,$check43) || strpos($room,$check44) || strpos($room,$check45) || strpos($room,$check46) || strpos($room,$check47) || strpos($room,$check48) 
    || strpos($room,$check49) || strpos($room,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }

    if(strpos($inspiration,$check1) || strpos($inspiration,$check2) || strpos($inspiration,$check3) || strpos($inspiration,$check4) || strpos($inspiration,$check5)
    || strpos($inspiration,$check6) || strpos($inspiration,$check7) || strpos($inspiration,$check8) || strpos($inspiration,$check9) || strpos($inspiration,$check10)
    || strpos($inspiration,$check11) || strpos($inspiration,$check12) || strpos($inspiration,$check13) || strpos($inspiration,$check14)
    || strpos($inspiration,$check15) || strpos($inspiration,$check16) || strpos($inspiration,$check17) || strpos($inspiration,$check18) || strpos($inspiration,$check19)
    || strpos($inspiration,$check20) || strpos($inspiration,$check21) || strpos($inspiration,$check22) || strpos($inspiration,$check23)
    || strpos($inspiration,$check24) || strpos($inspiration,$check25) || strpos($inspiration,$check26) || strpos($inspiration,$check27) || strpos($inspiration,$check28)
    || strpos($inspiration,$check29) || strpos($inspiration,$check30) || strpos($inspiration,$check31) || strpos($inspiration,$check32)
    || strpos($inspiration,$check33) || strpos($inspiration,$check34) || strpos($inspiration,$check35) || strpos($inspiration,$check36) || strpos($inspiration,$check37)
    || strpos($inspiration,$check38) || strpos($inspiration,$check39) || strpos($inspiration,$check40) || strpos($inspiration,$check41) || strpos($inspiration,$check42)
    || strpos($inspiration,$check43) || strpos($inspiration,$check44) || strpos($inspiration,$check45) || strpos($inspiration,$check46) || strpos($inspiration,$check47) || strpos($inspiration,$check48) 
    || strpos($inspiration,$check49) || strpos($inspiration,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }

    if(strpos($vision,$check1) || strpos($vision,$check2) || strpos($vision,$check3) || strpos($vision,$check4) || strpos($vision,$check5)
    || strpos($vision,$check6) || strpos($vision,$check7) || strpos($vision,$check8) || strpos($vision,$check9) || strpos($vision,$check10)
    || strpos($vision,$check11) || strpos($vision,$check12) || strpos($vision,$check13) || strpos($vision,$check14)
    || strpos($vision,$check15) || strpos($vision,$check16) || strpos($vision,$check17) || strpos($vision,$check18) || strpos($vision,$check19)
    || strpos($vision,$check20) || strpos($vision,$check21) || strpos($vision,$check22) || strpos($vision,$check23)
    || strpos($vision,$check24) || strpos($vision,$check25) || strpos($vision,$check26) || strpos($vision,$check27) || strpos($vision,$check28)
    || strpos($vision,$check29) || strpos($vision,$check30) || strpos($vision,$check31) || strpos($vision,$check32)
    || strpos($vision,$check33) || strpos($vision,$check34) || strpos($vision,$check35) || strpos($vision,$check36) || strpos($vision,$check37)
    || strpos($vision,$check38) || strpos($vision,$check39) || strpos($vision,$check40) || strpos($vision,$check41) || strpos($vision,$check42)
    || strpos($vision,$check43) || strpos($vision,$check44) || strpos($vision,$check45) || strpos($vision,$check46) || strpos($vision,$check47) || strpos($vision,$check48) 
    || strpos($vision,$check49) || strpos($vision,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    if(strpos($promise,$check1) || strpos($promise,$check2) || strpos($promise,$check3) || strpos($promise,$check4) || strpos($promise,$check5)
    || strpos($promise,$check6) || strpos($promise,$check7) || strpos($promise,$check8) || strpos($promise,$check9) || strpos($promise,$check10)
    || strpos($promise,$check11) || strpos($promise,$check12) || strpos($promise,$check13) || strpos($promise,$check14)
    || strpos($promise,$check15) || strpos($promise,$check16) || strpos($promise,$check17) || strpos($promise,$check18) || strpos($promise,$check19)
    || strpos($promise,$check20) || strpos($promise,$check21) || strpos($promise,$check22) || strpos($promise,$check23)
    || strpos($promise,$check24) || strpos($promise,$check25) || strpos($promise,$check26) || strpos($promise,$check27) || strpos($promise,$check28)
    || strpos($promise,$check29) || strpos($promise,$check30) || strpos($promise,$check31) || strpos($promise,$check32)
    || strpos($promise,$check33) || strpos($promise,$check34) || strpos($promise,$check35) || strpos($promise,$check36) || strpos($promise,$check37)
    || strpos($promise,$check38) || strpos($promise,$check39) || strpos($promise,$check40) || strpos($promise,$check41) || strpos($promise,$check42)
    || strpos($promise,$check43) || strpos($promise,$check44) || strpos($promise,$check45) || strpos($promise,$check46) || strpos($promise,$check47) || strpos($promise,$check48) 
    || strpos($promise,$check49) || strpos($promise,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }
    if(strpos($uploadays,$check1) || strpos($uploadays,$check2) || strpos($uploadays,$check3) || strpos($uploadays,$check4) || strpos($uploadays,$check5)
    || strpos($uploadays,$check6) || strpos($uploadays,$check7) || strpos($uploadays,$check8) || strpos($uploadays,$check9) || strpos($uploadays,$check10)
    || strpos($uploadays,$check11) || strpos($uploadays,$check12) || strpos($uploadays,$check13) || strpos($uploadays,$check14)
    || strpos($uploadays,$check15) || strpos($uploadays,$check16) || strpos($uploadays,$check17) || strpos($uploadays,$check18) || strpos($uploadays,$check19)
    || strpos($uploadays,$check20) || strpos($uploadays,$check21) || strpos($uploadays,$check22) || strpos($uploadays,$check23)
    || strpos($uploadays,$check24) || strpos($uploadays,$check25) || strpos($uploadays,$check26) || strpos($uploadays,$check27) || strpos($uploadays,$check28)
    || strpos($uploadays,$check29) || strpos($uploadays,$check30) || strpos($uploadays,$check31) || strpos($uploadays,$check32)
    || strpos($uploadays,$check33) || strpos($uploadays,$check34) || strpos($uploadays,$check35) || strpos($uploadays,$check36) || strpos($uploadays,$check37)
    || strpos($uploadays,$check38) || strpos($uploadays,$check39) || strpos($uploadays,$check40) || strpos($uploadays,$check41) || strpos($uploadays,$check42)
    || strpos($uploadays,$check43) || strpos($uploadays,$check44) || strpos($uploadays,$check45) || strpos($uploadays,$check46) || strpos($uploadays,$check47) || strpos($uploadays,$check48) 
    || strpos($uploadays,$check49) || strpos($uploadays,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }

    if(strpos($uploadcount,$check1) || strpos($uploadcount,$check2) || strpos($uploadcount,$check3) || strpos($uploadcount,$check4) || strpos($uploadcount,$check5)
    || strpos($uploadcount,$check6) || strpos($uploadcount,$check7) || strpos($uploadcount,$check8) || strpos($uploadcount,$check9) || strpos($uploadcount,$check10)
    || strpos($uploadcount,$check11) || strpos($uploadcount,$check12) || strpos($uploadcount,$check13) || strpos($uploadcount,$check14)
    || strpos($uploadcount,$check15) || strpos($uploadcount,$check16) || strpos($uploadcount,$check17) || strpos($uploadcount,$check18) || strpos($uploadcount,$check19)
    || strpos($uploadcount,$check20) || strpos($uploadcount,$check21) || strpos($uploadcount,$check22) || strpos($uploadcount,$check23)
    || strpos($uploadcount,$check24) || strpos($uploadcount,$check25) || strpos($uploadcount,$check26) || strpos($uploadcount,$check27) || strpos($uploadcount,$check28)
    || strpos($uploadcount,$check29) || strpos($uploadcount,$check30) || strpos($uploadcount,$check31) || strpos($uploadcount,$check32)
    || strpos($uploadcount,$check33) || strpos($uploadcount,$check34) || strpos($uploadcount,$check35) || strpos($uploadcount,$check36) || strpos($uploadcount,$check37)
    || strpos($uploadcount,$check38) || strpos($uploadcount,$check39) || strpos($uploadcount,$check40) || strpos($uploadcount,$check41) || strpos($uploadcount,$check42)
    || strpos($uploadcount,$check43) || strpos($uploadcount,$check44) || strpos($uploadcount,$check45) || strpos($uploadcount,$check46) || strpos($uploadcount,$check47) || strpos($uploadcount,$check48) 
    || strpos($uploadcount,$check49) || strpos($uploadcount,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }

    if(strpos($uploadtime,$check1) || strpos($uploadtime,$check2) || strpos($uploadtime,$check3) || strpos($uploadtime,$check4) || strpos($uploadtime,$check5)
    || strpos($uploadtime,$check6) || strpos($uploadtime,$check7) || strpos($uploadtime,$check8) || strpos($uploadtime,$check9) || strpos($uploadtime,$check10)
    || strpos($uploadtime,$check11) || strpos($uploadtime,$check12) || strpos($uploadtime,$check13) || strpos($uploadtime,$check14)
    || strpos($uploadtime,$check15) || strpos($uploadtime,$check16) || strpos($uploadtime,$check17) || strpos($uploadtime,$check18) || strpos($uploadtime,$check19)
    || strpos($uploadtime,$check20) || strpos($uploadtime,$check21) || strpos($uploadtime,$check22) || strpos($uploadtime,$check23)
    || strpos($uploadtime,$check24) || strpos($uploadtime,$check25) || strpos($uploadtime,$check26) || strpos($uploadtime,$check27) || strpos($uploadtime,$check28)
    || strpos($uploadtime,$check29) || strpos($uploadtime,$check30) || strpos($uploadtime,$check31) || strpos($uploadtime,$check32)
    || strpos($uploadtime,$check33) || strpos($uploadtime,$check34) || strpos($uploadtime,$check35) || strpos($uploadtime,$check36) || strpos($uploadtime,$check37)
    || strpos($uploadtime,$check38) || strpos($uploadtime,$check39) || strpos($uploadtime,$check40) || strpos($uploadtime,$check41) || strpos($uploadtime,$check42)
    || strpos($uploadtime,$check43) || strpos($uploadtime,$check44) || strpos($uploadtime,$check45) || strpos($uploadtime,$check46) || strpos($uploadtime,$check47) || strpos($uploadtime,$check48) 
    || strpos($uploadtime,$check49) || strpos($uploadtime,$check50)
    )
    {
        header("location: ../signup.php");
        exit();
    }

    $profileName=$_FILES['profile']['name'];
    $profileSize=$_FILES['profile']['size'];
    $profileTmpName=$_FILES['profile']['tmp_name'];
    $newprofileTmpName=$_FILES['profile']['tmp_name'];

    $profilext = end((explode(".", $profileName))); # extra () to prevent notice
    echo $profilext;

    if($profilext != "jpg"){
        header("location: ../signup.php?error=wps");
        exit();
    }

    $profileExt=explode(".",$profileName);
    $profileActualExt=strtolower(end($profileExt));
    $profileFullname=$profileName . "." . uniqid("",true) . "." . $profileActualExt;
    $profileFolder="../profilepictures/".$profileFullname;

    $coverName=$_FILES['cover']['name'];
    $coverSize=$_FILES['cover']['size'];
    $coverTmpName=$_FILES['cover']['tmp_name'];

    $coverext = end((explode(".", $coverName))); # extra () to prevent notice
    echo $coverext;

    if($coverext != "jpg"){
        header("location: ../signup.php?error=wcs");
        exit();
    }

    $coverExt=explode(".",$coverName);
    $coverActualExt=strtolower(end($coverExt));
    $coverFullname=$coverName . "." . uniqid("",true) . "." . $coverActualExt;
    $coverFolder="../intelliprenuercoverpictures/".$coverFullname;
  
    $verificationvideoFullname=$_FILES['verificationvideo']['name'];
    $verificationvideoSize=$_FILES['verificationvideo']['size'];
    $verificationvideoTmpName=$_FILES['verificationvideo']['tmp_name'];
    $videoext = end((explode(".", $verificationvideoFullname))); # extra () to prevent notice
    echo $videoext;

    if($videoext != "mp4"){
        header("location: ../signup.php?error=wvvs");
        exit();
    }

    $overviewvideoFullname=$_FILES['overviewvideo']['name'];
    $overviewvideoSize=$_FILES['overviewvideo']['size'];
    $overviewvideoTmpName=$_FILES['overviewvideo']['tmp_name'];

    $overvideoext = end((explode(".", $overviewvideoFullname))); # extra () to prevent notice
    echo $overvideoext;

    if($overvideoext != "mp4"){
        header("location: ../signup.php?error=wovs");
        exit();
    }
    
    require_once 'functions.inc.php';

    if (accountExist($conn, $accountname, $useremail) !== false) {
        header("location: ../intellipreneurship.php?error=userexists");
        exit();
    }

    createroom($conn,$room,$roomid,$accountname);
    createaccount($conn,$accountholder,$accountname,$catagory,$genre,$accountbio,$price,$currency,$country,$room,$useremail,$profileFullname,
    $profileSize,$profileTmpName,$profileFolder,$coverFullname,$coverSize,$coverTmpName,$coverFolder,$creationdate,$verificationvideoFullname,$verificationvideoSize,$verificationvideoTmpName,$overviewvideoFullname,$overviewvideoSize,$overviewvideoTmpName,
    $inspiration,$promise,$vision,$uploadcount,$uploadays,$uploadtime,$timezone);
 

   

}

else{
    header("location: ../intellipreneurship.php");
}