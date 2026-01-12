<?php
function emptyInput($name, $username, $email, $email2, $password, $password2){
    $result;
    if (empty($name) || empty($username) || empty($email) || empty($email2) || empty($password) || empty($password2)){
        $result = true;

    }
    else {
        $result = false;
    }

    return $result;
}

function usernameInvalid($username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        $result = true;
    }
    else{
        $result= false;
    }

    return $result;
}

function emailInvalid($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;

    }
    else {
        $result = false;
    }

    return $result;
}

function emailCheck($email, $email2){
    $result;
    if ($email !== $email2){
        $result = true;

    }
    else {
        $result = false;
    }

    return $result;
}

function passwordCheck($password, $password2){
    $result;
    if ($password !== $password2){
        $result = true;

    }
    else {
        $result = false;
    }

    return $result;
}

function sendMail($email,$uniqueid,$name){
    $result;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        $subject="Email Validate";
        $message="Hey $name!Thanks for signing up!Here is your validation code :$uniqueid.Validate your account
        and explore great content!!!";
        $sender="From: mirthh00@gmail.com";
        if(mail($email,$subject,$message,$sender)){
            $result=false;
        }
        else{
            $result=true;
        }
    }

    return $result;
}

function userExist($conn, $username, $email){
    $sql="SELECT * FROM users WHERE usersUid=? OR usersEmail=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$username,$email);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    if ($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result=false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createuser($conn,$name,$username,$email,$password,$usercountry,$imageName,$imageSize,$imageTmpName,$imageFolder,$recommender,$uniqueid,$race,$gender,$birthday,$p){
    $them = "dark";
    $sql="INSERT INTO users(usersName,usersUid,usersEmail,usersPwd,usersCountry,usersImage,recommended,validator,race,gender,birthday,theme,ipaddress) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    if($imageSize<5000000)
    {
        move_uploaded_file($imageTmpName,$imageFolder);
    }
    else{
        header("location: ../signup.php?error=wps");
        exit();
    }
        

    $hashedpassword=password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssssssssss", $name, $username, $email, $hashedpassword,$usercountry,$imageName,$recommender,$uniqueid,$race,$gender,$birthday,$them,$p);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../uservalidate.php");
    exit();
}

function emptyLoginInput($username, $useremail, $userpassword){
    $result;
    if (empty($username) || empty($useremail) || empty($userpassword)){
        $result = true;

    }
    else {
        $result = false;
    }

    return $result;
}

function loginuser($conn,$username,$useremail,$userpassword,$v,$p){
    $userExists=userExist($conn, $username, $useremail);
    if ($userExists === false){
        header("location: ../login.php?v=$v&error=invaliduser");
        exit();
    }
    if($useremail!=$userExists["usersEmail"])
    {
        header("location: ../login.php?v=$v&error=invalidemail");
        exit(); 
    }
    if($username!=$userExists["usersUid"])
    {
        header("location: ../login.php?v=$v&error=invalidusername");
        exit();
    }
    $pwdHashed=$userExists["usersPwd"];
    $checkpassword=password_verify($userpassword,$pwdHashed);

    if( $checkpassword === false){
        header("location: ../login.php?v=$v&error=invalidpassword");
        exit();
    }
    elseif ($checkpassword === true){
        $sql="SELECT * FROM users WHERE usersUid=? and usersEmail=?;";
        $stmt=mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt,"ss",$username,$useremail);
        mysqli_stmt_execute($stmt);
    
        $result=mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        
        session_start();
        $_SESSION["userid"]=$userExists["id"];
        $_SESSION["username"]=$userExists["usersUid"];
        $_SESSION["useremail"]=$userExists["usersEmail"];
        $_SESSION["userimage"]=$userExists["usersImage"];
        $_SESSION["fullname"]=$userExists["usersName"];
        $_SESSION["country"]=$userExists["usersCountry"];
        $_SESSION["theme"]=$userExists["theme"];
        if($v!="none"){
            header("location: views.inc.php?v=$v");
            exit();
        }
        else{
            header("location: ../home.php");
            exit();
        }
    
        
    }
}

function updateuser($conn,$newusername,$currentuser,$newpassword,$newimageName,$newimageSize,$newimageTmpName,$newimageFolder){
    
    $hashedpassword=password_hash($newpassword, PASSWORD_DEFAULT);
    if($newimageSize<5000000)
    {
        $uploaded=move_uploaded_file($newimageTmpName,$newimageFolder);

        if($uploaded)
        {
            $sql="UPDATE users SET usersUid='$newusername',usersPwd='$hashedpassword',usersImage='$newimageName' WHERE usersUid='$currentuser';";
            mysqli_query($conn,$sql);
            $_SESSION["userid"]=$userExists["id"];
            $_SESSION["username"]=$userExists["usersUid"];
            $_SESSION["useremail"]=$userExists["usersEmail"];
            $_SESSION["userimage"]=$userExists["usersImage"];
            $_SESSION["fullname"]=$userExists["usersName"];
            $_SESSION["country"]=$userExists["usersCountry"];
            $_SESSION["theme"]=$userExists["theme"];
            header("location: ../home.php");
            exit();
        }
    }
    else{
        header("location: ../profileupdate.php?error=profiletoobig");
         exit();
    }
     
}

function updateaccounteverywhere($conn,$accountname,$currentaccount,$profileName,$accountid){
    
           if(!empty($accountname)){
            $sql="UPDATE analytics SET uploader='$accountname' WHERE uploader='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE albums SET uploader='$accountname' WHERE uploader='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE stats SET uploader='$accountname' WHERE uploader='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE videos SET uploader='$accountname' WHERE uploader='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE likedcomments SET username='$accountname' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE likedmusic SET username='$accountname' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE likedreplies SET username='$accountname' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE likedvideos SET username='$accountname' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE chats SET username='$accountname' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE comments SET username='$accountname' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE replies SET username='$accountname' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE music SET uploader='$accountname' WHERE uploader='$currentaccount';";
            mysqli_query($conn,$sql);
           }

           if(!empty($profileName)){
            $sql="UPDATE chats SET profileimage='$profileName' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE comments SET thumbnail='$profileName' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE replies SET thumbnail='$profileName' WHERE username='$currentaccount';";
            mysqli_query($conn,$sql);
            $sql="UPDATE music SET uploaderprofile='$profileName' WHERE uploader='$currentaccount';";
            mysqli_query($conn,$sql);
           }
            
            header("location: ../account.php?ID=$accountid");
            exit();
        
    }
     


function updateaccount($conn,$accountname,$currentaccount,$bio,$price,$profileName,$profileSize,$profileTmpName,$profileFolder,$coverName,$coverSize,$coverTmpName,$coverFolder,$accountid){
    
    if(!empty($profileName)){
    if($profileSize<5000000)
    {
        move_uploaded_file($profileTmpName,$profileFolder);
    }
    
    else{
        header("location: ../accountupdate.php?error=profiletoobig");
         exit();
    }
    $sql="UPDATE intellipreneurs SET profileimage='$profileName'  WHERE accountname='$currentaccount';";
    mysqli_query($conn,$sql);
    $sql="UPDATE unlockedaccounts SET profileimage='$profileName' WHERE accountname='$currentaccount';";
    mysqli_query($conn,$sql);
}
if(!empty($coverName)){
    if($coverSize<5000000)
    {
        move_uploaded_file($coverTmpName,$coverFolder);
    }
    
    else{
        header("location: ../accountupdate.php?error=covertoobig");
         exit();
    }
    $sql="UPDATE intellipreneurs SET coverimage='$coverName'  WHERE accountname='$currentaccount';";
    mysqli_query($conn,$sql);
}
if(!empty($accountname)){
    $sql="UPDATE intellipreneurs SET accountname='$accountname'  WHERE accountname='$currentaccount';";
    mysqli_query($conn,$sql);
    $sql="UPDATE rooms SET roomname='$accountname' WHERE roomname='$currentaccount';";
    mysqli_query($conn,$sql);
    $sql="UPDATE unlockedrooms SET roomname='$accountname' WHERE roomname='$currentaccount';";
    mysqli_query($conn,$sql);
    $sql="UPDATE unlockedaccounts SET accountname='$accountname' WHERE accountname='$currentaccount';";
    mysqli_query($conn,$sql);
}
if(!empty($bio)){
    $sql="UPDATE intellipreneurs SET bio='$bio'  WHERE accountname='$currentaccount';";
    mysqli_query($conn,$sql);
}
if(!empty($price)){
    $sql="UPDATE intellipreneurs SET price='$price'  WHERE accountname='$currentaccount';";
    mysqli_query($conn,$sql);
}
    
}

function sendPasswordMail($userEmail,$url){
    $result;
    if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
        $subject="Password Reset";
        $message="<p>You are receiving this email due to the request you made
        to reset,if you are not the one who sent the request you can ignore this email and 
        look at your account activity,you may consider changing your details to stop other users
        from accessing your account.Click on the link or copy and paste it in your browser:</p>".$url;
        $sender="From: lightdee04@gmail.com";
        if(mail($userEmail,$subject,$message,$sender)){
            $result=false;
        }
        else{
            $result=true;
        }
    }

    return $result;
}

function accountExist($conn, $accountname, $useremail){
    $sql="SELECT * FROM intellipreneurs WHERE accountname=? OR email=?;";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$accountname,$useremail);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    if ($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result=false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createaccount($conn,$accountholder,$accountname,$catagory,$genre,$accountbio,$price,$currency,$country,$room,$useremail,$profileFullname,
$profileSize,$profileTmpName,$profileFolder,$coverFullname,$coverSize,$coverTmpName,$coverFolder,$creationdate,$verificationvideoFullname,
$verificationvideoSize,$verificationvideoTmpName,$overviewvideoFullname,$overviewvideoSize,$overviewvideoTmpName,$inspiration,$promise,$vision,$uploadcount,$uploadays,$uploadtime,$timezone)
{
    $sql="INSERT INTO intellipreneurs(accountholder,accountname,catagory,genre,bio,price,currency,country,room,email,profileimage,
    coverimage,directoryname,Date,inspiration,vision,promise,uploads,uploadays,uploadtime,timezone,verificationvideo,overviewvideo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    if($profileSize<5000000)
    {
        move_uploaded_file($profileTmpName,$profileFolder);
       
    }
    else{
        header("location: ../intellipreneurship.php?error=psb");
        exit();
    }

    if($coverSize<5000000)
    {
        move_uploaded_file($coverTmpName,$coverFolder);
    }
    else{
        header("location: ../intellipreneurship.php?error=csb");
        exit();
    }
    if($verificationvideoSize<100000000){
        if(!is_dir("../content/videos/".$accountname)){
            mkdir("../content/videos/".$accountname,0777);
        }

        $verificationvideoFolder="../content/videos/".$accountname."/".$verificationvideoFullname;
        move_uploaded_file($verificationvideoTmpName,$verificationvideoFolder);
    }
    else{
        header("location: ../intellipreneurship.php?error=vvsb");
        exit();
    }
    if($overviewvideoSize<100000000){
        if(!is_dir("../content/videos/".$accountname)){
            mkdir("../content/videos/".$accountname,0777);
        }

        $overviewvideoFolder="../content/videos/".$accountname."/".$overviewvideoFullname;
        move_uploaded_file($overviewvideoTmpName,$overviewvideoFolder);
    }
    else{
        header("location: ../intellipreneurship.php?error=ovsb");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssss", $accountholder, $accountname, $catagory, $genre,$accountbio,$price,$currency,$country,$room,$useremail,$profileFullname,
    $coverFullname,$accountname,$creationdate,$inspiration,$promise,$vision,$uploadcount,$uploadays,$uploadtime,$timezone,$verificationvideoFullname,$overviewvideoFullname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../activate.php?a=$accountname");
}

function createroom($conn,$room,$roomid,$accountname)
{
    if($room=="Yes")
    {
        $sql="INSERT INTO rooms(roomid,roomname) VALUES (?,?);";
        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $roomid,$accountname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}


function addunlockedaccount($conn,$accountname,$accountid,$profilename,$userfullname,$username,$useremail,$userid,$catagory,$unlockdate,$recommender)
{
    $sql="INSERT INTO unlockedaccounts(accountname,accountid,profileimage,userfullname,username,useremail,userid,catagory,unlockdate,recommender) VALUES (?,?,?,?,?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssssss",$accountname,$accountid,$profilename,$userfullname,$username,$useremail,$userid,$catagory,$unlockdate,$recommender);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: account.php?ID=$accountid");
    exit();
}

function report($conn,$name,$videoid,$report,$uploader)
{
    $sql="INSERT INTO reports(reporter,videoid,report,uploader) VALUES (?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss",$name,$videoid,$report,$uploader);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../watchcontent.php?watch=$videoid");
    exit();
}

function reportbugs($conn,$name,$report,$useremail)
{
    $sql="INSERT INTO reportbugs(reporter,report,email) VALUES (?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss",$name,$report,$useremail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../reportbugs.php?s=d");
    exit();
}

function addunlockedroom($conn,$roomid,$roomname,$useremail)
{
    $sql="INSERT INTO unlockedrooms(roomid,roomname,unlockeremail) VALUES (?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss",$roomid,$roomname,$useremail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function poll($conn,$roomid,$pollstatement,$option1,$option2,$option3,$option4,$option5,$option6,$option7,$option8,$option9,$option10,$date)
{
    $sql="INSERT INTO polls(roomid,pollstatement,option1,option2,option3,option4,option5,option6,option7,option8,option9,option10,createdat) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssssssss",$roomid,$pollstatement,$option1,$option2,$option3,$option4,$option5,$option6,$option7,$option8,$option9,$option10,$date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../fansroom.php?r=$roomid");
    exit();
}
function vote($conn,$roomid,$optionid,$username,$pollid)
{
    $sql="INSERT INTO votes(roomid,optionid,username,pollid) VALUES (?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss",$roomid,$optionid,$username,$pollid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../fansroom.php?r=$roomid");
    exit();
}

function upload($conn,$uniqueid,$accountname,$videotitle,$videodescription,$videoName,
$videoSize,$videoTmpName,$thumbnailName,$thumbnailSize,$thumbnailTmpName,$subtitlesName,$subtitlesSize,$subtitlesTmpName,$accountid,$uploadedtime,$genre,$views,$country,$directoryname,$link)
{
    $sql="INSERT INTO videos(uniqueid,videotitle,videodescription,thumbnail,video,uploader,uploadedtime,genre,views,uploadercountry,link,subtitles) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    if($videoSize<2000000000)
    {
        if(!is_dir("../content/videos/".$directoryname)){
            mkdir("../content/videos/".$directoryname,0777);
        }

        $videoFolder="../content/videos/".$directoryname."/".$videoName;
        move_uploaded_file($videoTmpName,$videoFolder);
        
        
    }
    else{
        header("location: ../upload.php?e=vsb");
        exit();
    }

    if($thumbnailSize<2000000)
    {
        if(!is_dir("../content/videos/thumbnails/".$directoryname)){
            mkdir("../content/videos/thumbnails/".$directoryname,0777);
        }
        
        $thumbnailFolder="../content/videos/thumbnails/".$directoryname."/".$thumbnailName;
        move_uploaded_file($thumbnailTmpName,$thumbnailFolder);
    }
    else{
        header("location: ../upload.php?e=tsb");
        exit();
    }

    if($subtitlesSize<1000000)
    {
        if(!is_dir("../content/videos/thumbnails/".$directoryname)){
            mkdir("../content/videos/thumbnails/".$directoryname,0777);
        }
        
        $subtitlesFolder="../content/videos/thumbnails/".$directoryname."/".$subtitlesName;
        move_uploaded_file($subtitlesTmpName,$subtitlesFolder);
    }
    else{
        header("location: ../upload.php?e=sb");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssssssss", $uniqueid, $videotitle,$videodescription, $thumbnailName,$videoName,$accountname,$uploadedtime,$genre,$views,$country,$link,$subtitlesName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../account.php?ID=$accountid");
    exit();
}

function uploadalbum($conn,$albumtitle,$albumcoverName,$accountname,$albumcoverSize,$albumcoverTmpName)
{
    $sql="INSERT INTO albums(albumtitle,albumcover,uploader) VALUES (?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    if($albumcoverSize<2000000)
    {
        $coverFolder="../music/covers/".$albumcoverName."";
        move_uploaded_file($albumcoverTmpName,$coverFolder);
    }
    else{
        header("location: ../uploadmusic.php?e=acsb");
        exit();
    }
   
    mysqli_stmt_bind_param($stmt, "sss",$albumtitle,$albumcoverName,$accountname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function uploadmusic($conn,$uniqueid,$accountname,$songtitle,$artists,$songName,
$songSize,$songTmpName,$coverName,$coverSize,$coverTmpName,$accountid,$uploadedtime,$genre,$streams,
$uploaderprofile,$albumtitle,$albumcoverName,$albumcoverSize,$albumcoverTmpName)
{
    $sql="INSERT INTO music(songtitle,artists,cover,song,uploader,uploadedtime,genre,streams,uploaderprofile,albumtitle,albumcover) VALUES (?,?,?,?,?,?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    if($songSize<15000000)
    {
        $songFolder="../music/".$uniqueid.".mp3";
        move_uploaded_file($songTmpName,$songFolder); 
    }

    else{
        header("location: ../uploadmusic.php?e=ssb");
        exit();
    }

    if($coverSize<2000000)
    {
        $coverFolder="../music/covers/".$uniqueid.".jpg";
        move_uploaded_file($coverTmpName,$coverFolder);
    }
    else{
        header("location: ../uploadmusic.php?e=csb");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "sssssssssss", $songtitle,$artists, $coverName,$uniqueid,$accountname,$uploadedtime,$genre,$streams,$uploaderprofile,$albumtitle,$albumcoverName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../account.php?ID=$accountid");
    exit();
}

function uploadpodcast($conn,$uniqueid,$accountname,$songtitle,$artists,$songName,
$songSize,$songTmpName,$coverName,$coverSize,$coverTmpName,$accountid,$uploadedtime,$genre,$streams,
$uploaderprofile)
{
    $sql="INSERT INTO podcasts(songtitle,artists,cover,podcast,uploader,uploadedtime,genre,streams,uploaderprofile) VALUES (?,?,?,?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    if($songSize<200000000)
    {
        $songFolder="../podcasts/".$uniqueid.".mp3";
        move_uploaded_file($songTmpName,$songFolder); 
    }
    else{
        header("location: ../uploadmusic.php?e=psb");
        exit();
    }

    if($coverSize<2000000)
    {
        $coverFolder="../podcasts/covers/".$uniqueid.".jpg";
        move_uploaded_file($coverTmpName,$coverFolder);
    }
    
    else{
        header("location: ../uploadmusic.php?e=csb");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssss", $songtitle,$artists, $coverName,$uniqueid,$accountname,$uploadedtime,$genre,$streams,$uploaderprofile);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../account.php?ID=$accountid");
    exit();
}

function uploadedtime($time)
{
    date_default_timezone_set("Africa/Johannesburg");
    $time_ago = $time;
    $current_time = time();
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;
    $minutes = floor($seconds / 60);
    $hours = floor($seconds / 3600);
    $days = floor($seconds / 86400);
    $weeks = floor($seconds / 604800);
    $months = floor($seconds / 2629440);
    $years = floor($seconds / 31553280);

    if($seconds < 60)
    {
        return "$seconds Seconds Ago";
    }
    else if($minutes<60)
    {
        if($minutes==1)
        {
            return "1 Minute Ago";
        }
        else{
            return "$minutes Minutes Ago";
        }
    }

    else if($hours<24)
    {
        if($hours==1)
        {
            return "1 Hour Ago";
        }
        else{
            return "$hours Hours Ago";
        }
    }

    else if($days<7)
    {
        if($days==1)
        {
            return "Yesterday";
        }
        else{
            return "$days Days Ago";
        }
    }

    else if($weeks<4.3)
    {
        if($weeks==1)
        {
            return "1 Week Ago";
        }
        else{
            return "$weeks Weeks Ago";
        }
    }

    else if($months<=12)
    {
        if($months==1)
        {
            return "1 Month Ago";
        }
        else{
            return "$months Months Ago";
        }
    }

    else if($hours<24)
    {
        if($hours==1)
        {
            return "1 Hour Ago";
        }
        else{
            return "$hours Hours Ago";
        }
    }
    else
    {
        if($years==1)
        {
            return "1 Year Ago";
        }
        else{
            return "$years Years Ago";
        }
    }

    
}

function comment($conn,$videoid,$comment,$commenttime,$username,$thumbnail)
{
    $sql="INSERT INTO comments(videoid,commentwords,commentuploadedtime,username,thumbnail) VALUES (?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss",$videoid,$comment,$commenttime,$username,$thumbnail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../watchcontent.php?watch=$videoid");
    exit();
}

function reply($conn,$videoid,$commentid,$reply,$replytime,$username,$thumbnail) 
{
    $sql="INSERT INTO replies(commentid,replywords,replyuploadedtime,username,thumbnail) VALUES (?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss",$commentid,$reply,$replytime,$username,$thumbnail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../watchcontent.php?watch=$videoid");
    exit();
}

function  chat($conn,$roomid,$message,$messagetime,$username,$imagename)
{
    $sql="INSERT INTO chats(roomid,chat,messagetime,username,profileimage) VALUES (?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss",$roomid,$message,$messagetime,$username,$imagename);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../fansroom.php?r=$roomid");
    exit();
}

function  featured($conn,$accountname,$catagory,$profileimage,$accountid)
{
    $sql="INSERT INTO featuredaccounts(accountname,catagory,profileimage,accountid) VALUES (?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss",$accountname,$catagory,$profileimage,$accountid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: account.php?ID=$accountid&s=fd");
    exit();
}

function  boost($conn,$uniqueid,$thumbnail,$videotitle,$uploader,$genre,$directoryname,$accountid)
{
    $sql="INSERT INTO suggestedvideos(uniqueid,thumbnail,videotitle,uploader,genre,directoryname) VALUES (?,?,?,?,?,?);";
    $stmt=mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss",$uniqueid,$thumbnail,$videotitle,$uploader,$genre,$directoryname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: account.php?ID=$accountid&s=bd");
    exit();
}
function currencyFormat($num) {

    if($num>999) {
  
          $x = round($num);
          $x_number_format = number_format($x);
          $x_array = explode(',', $x_number_format);
          $x_parts = array('K', 'M', 'B', 'T');
          $x_count_parts = count($x_array) - 1;
          $x_display = $x;
          $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
          $x_display .= $x_parts[$x_count_parts - 1];
  
          return $x_display;
  
    }
  
    return $num;
  }

  function theme($conn,$theme,$username,$link){
    $sql="UPDATE users SET theme='$theme'  WHERE usersUid='$username';";
    mysqli_query($conn,$sql);
    header("location: ../$link.php");
    exit();
  }



