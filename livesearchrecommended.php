<?php
session_start();
if(isset($_SESSION["username"])){
    require_once "includes/functions.inc.php";
}
else{
    header("location: login.php");
    exit();
}
?>

<?php
include 'includes/functions.inc.php';
include "includes/contentdatabase.inc.php";
if (isset($_POST["query"])){
$search = mysqli_real_escape_string($conn,$_POST["query"]);


        
        
        $sql3="SELECT * FROM videos WHERE videotitle LIKE CONCAT('%',?,'%') ORDER BY id DESC ;";
        $stmt=mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql3)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt,"s",$search);
        mysqli_stmt_execute($stmt);
        $result3=mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
       
        $rownum3=mysqli_num_rows($result3);
        
            if($rownum3>0)
            {
                while($row3=mysqli_fetch_assoc($result3)){
                    $sql4="SELECT * FROM videos WHERE videotitle LIKE CONCAT('%',?,'%') ORDER BY RAND() ;";
                    $stmt=mysqli_stmt_init($conn);
        
                    if(!mysqli_stmt_prepare($stmt,$sql4)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                    }
        
                    mysqli_stmt_bind_param($stmt,"s",$search);
                    mysqli_stmt_execute($stmt);
                    $result4=mysqli_stmt_get_result($stmt);
                    $row4=mysqli_fetch_assoc($result4);
                    mysqli_stmt_close($stmt);
       
                    
                    $videotitle=$row3["videotitle"];
                   $thumbnail=$row3["thumbnail"];
                   $uploader=$row3["uploader"];
                   $uniqueid=$row3["uniqueid"];
                   $views=$row3["views"];
                   $uptime=$row3["uploadedtime"];
                            $ptime=uploadedtime($uptime);
                            $views=currencyFormat($views);
                   include "includes/accountdatabase.inc.php";
                            $sql22="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql22)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_bind_param($stmt,"s",$row3["uploader"]);
                            mysqli_stmt_execute($stmt);
                            $result22=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row22=mysqli_fetch_assoc($result22);
                            
                            include "includes/contentdatabase.inc.php";
                            $directoryname=$row22["directoryname"];
                   if($row3["genre"]==$row4["genre"])
                   {
                       
                       echo "
                       <form action='includes/views.inc.php' method='POST'>
                       <div class='side-video-list'>
                           <input type='hidden' value='$uniqueid' name='uniqueid'>
                           <input type='image' src='content/videos/thumbnails/$directoryname/$thumbnail' class='small-thumbnail' id='small-thumbnail' title='Watch $videotitle' >
                  
                           <div class='vid-info'>
                               <div class='recviddesc'>
                               <p>$videotitle</p>
                               <br>
                               </div>
                             
                               <div class='dv'>
                               <div class='verification'>
                               <div class='updesc'>
                               <p class='opacity' title='$uploader'>$uploader</p>
                               </div>
                               <img src='images/check.png' class='account3'>
                               </div> 
                               <div class='updesc'>
                               <p class='opacity'>$views Views  &bullet; $ptime</p>
                               </div> 
                               </div>   
                           </div>
                       </div>
                   </form>
                       ";
                   }
               }
            }
            
}





?>

                  