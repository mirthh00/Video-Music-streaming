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
include 'includes/accountdatabase.inc.php';
$fullname=$_SESSION["fullname"];
$theme=$_SESSION["theme"];
    if($theme == 'light'){
        $color="white-theme";
    }
    else{
        $color="dark-theme";
    }
$sql="SELECT * FROM intellipreneurs WHERE  accountholder=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$fullname);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
$row=mysqli_fetch_assoc($result);
$rownum=mysqli_num_rows($result);

include 'includes/contentdatabase.inc.php';
$accountname=$row["accountname"];
$sql2="SELECT * FROM videos WHERE  uploader=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql2)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$accountname);
mysqli_stmt_execute($stmt);
$result2=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum2=mysqli_num_rows($result2);
include "includes/accountdatabase.inc.php";
                            $sql17="SELECT * FROM intellipreneurs WHERE  accountname=?;";
                            $stmt=mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt,$sql17)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_bind_param($stmt,"s",$accountname);
                            mysqli_stmt_execute($stmt);
                            $result17=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row17=mysqli_fetch_assoc($result17);
                            $directoryname=$row17["directoryname"];
                            $profileimage=$row17["profileimage"];

                            $sql22="SELECT * FROM revenue WHERE accountname=?;";
                            $stmt=mysqli_stmt_init($conn);
                            
                            if(!mysqli_stmt_prepare($stmt,$sql22)){
                                header("location: ../signup.php?error=stmtfailed");
                                exit();
                            }
                            
                            mysqli_stmt_bind_param($stmt,"s",$accountname);
                            mysqli_stmt_execute($stmt);
                            $result22=mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            $row22=mysqli_fetch_assoc($result22);
                            $rownum22=mysqli_num_rows($result22);
                            $totalrevenue=$row22["totalrevenue"];
                            $totalunlockers=$row22["totalunlockers"];
                            include "includes/contentdatabase.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Analytics</title>
    <meta lang="en" charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/analytics/analytics.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a25a382205.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;1,100;1,200;1,300;1,400;1,500;1,700&display=swap');
        .responses h6 {
            color: red;
            font-style: italic;
        }
    </style>
   
</head>
<body class="<?php echo "$color";?>">
    <header>
        <nav>
        <a href="home.php"><img src="images/Logopit_1648978873138.png"></a>
        </nav>
       
    </header>

    <div class="chartspace">
      
       

        <div class="board">
            <h1 id="boardtitle">WELCOME <?php echo "$accountname"; ?>!</h1>
            <h1 id="boardtitle">UNLOCKERS ANALYTICS</h1>
            <?php
            if($rownum22>0){
                ?>
            <div class="contentcontainer">
         
                <div class="video">
                <div class="videodiv">
                    <img src="profilepictures/<?php echo"$profileimage";?>" alt="" class="thumbnail">
                    <div class="videodata">
                        
                        <h4><?php echo"$accountname";?></h4>
                        <p><?php echo"$totalunlockers";?> Unlockers </p>
                       </div> 
                   </div>
                    <canvas id="myChart"  width="400" height="80"></canvas>
                    <script>
                        const ctx = document.getElementById('myChart').getContext('2d');
                        const myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                <?php
                                include "includes/accountdatabase.inc.php";
                                $sql18="SELECT * FROM revenue WHERE accountname=?;";
                               $stmt=mysqli_stmt_init($conn);
                               
                               if(!mysqli_stmt_prepare($stmt,$sql18)){
                                   header("location: ../signup.php?error=stmtfailed");
                                   exit();
                               }
                               
                               mysqli_stmt_bind_param($stmt,"s",$accountname);
                               mysqli_stmt_execute($stmt);
                               $result18=mysqli_stmt_get_result($stmt);
                               mysqli_stmt_close($stmt);
                              
                               $rownum18=mysqli_num_rows($result18);

                               $sql19="SELECT * FROM revenue WHERE accountname=?;";
                               $stmt=mysqli_stmt_init($conn);
                               
                               if(!mysqli_stmt_prepare($stmt,$sql19)){
                                   header("location: ../signup.php?error=stmtfailed");
                                   exit();
                               }
                               
                               mysqli_stmt_bind_param($stmt,"s",$accountname);
                               mysqli_stmt_execute($stmt);
                               $result19=mysqli_stmt_get_result($stmt);
                               mysqli_stmt_close($stmt);
                              
                               $rownum19=mysqli_num_rows($result19);
                               ?>
                               labels: [<?php while($row18=mysqli_fetch_assoc($result18)){?>
                                '<?php echo $row18["day"];?>',
                                <?php
                               }
                               ?>
                                ],
                                datasets: [{
                                    label: 'Unlockers Per Day',
                                    
                                    backgroundColor: [
                                        'cornflowerblue'
                                        
                                    ],
                                    borderColor: [
                                        'lightskyblue'
                                     
                                    ],
                                    data: [<?php while($row19=mysqli_fetch_assoc($result19)){?>
                                <?php echo $row19["unlockers"];?>,
                                <?php
                               }
                               ?>],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                        </script>

                </div>
              
            </div>

            <h1 id="boardtitle">REVENUE ANALYTICS</h1>
            <div class="contentcontainer">
                        
                <div class="video">
                <div class="videodiv">
                    <img src="profilepictures/<?php echo"$profileimage";?>" alt="" class="thumbnail">
                    <div class="videodata">
                        
                        <h4><?php echo"$accountname";?></h4>
                        <p><?php echo"$totalrevenue";?> <?php echo $row17["currency"];?>s </p>
                    </div> 
                </div>
                    <canvas id="myChar"  width="400" height="80"></canvas>
                    <script>
                        const ct = document.getElementById('myChar').getContext('2d');
                        const myChar = new Chart(ct, {
                            type: 'line',
                            data: {
                                <?php
                                
                                $sql20="SELECT * FROM revenue WHERE accountname=?;";
                               $stmt=mysqli_stmt_init($conn);
                               
                               if(!mysqli_stmt_prepare($stmt,$sql20)){
                                   header("location: ../signup.php?error=stmtfailed");
                                   exit();
                               }
                               
                               mysqli_stmt_bind_param($stmt,"s",$accountname);
                               mysqli_stmt_execute($stmt);
                               $result20=mysqli_stmt_get_result($stmt);
                               mysqli_stmt_close($stmt);
                              
                               $rownum20=mysqli_num_rows($result20);

                               $sql21="SELECT * FROM revenue WHERE accountname=?;";
                               $stmt=mysqli_stmt_init($conn);
                               
                               if(!mysqli_stmt_prepare($stmt,$sql21)){
                                   header("location: ../signup.php?error=stmtfailed");
                                   exit();
                               }
                               
                               mysqli_stmt_bind_param($stmt,"s",$accountname);
                               mysqli_stmt_execute($stmt);
                               $result21=mysqli_stmt_get_result($stmt);
                               mysqli_stmt_close($stmt);
                              
                               $rownum21=mysqli_num_rows($result21);
                               ?>
                               labels: [<?php while($row20=mysqli_fetch_assoc($result20)){?>
                                '<?php echo $row20["day"];?>',
                                <?php
                               }
                               ?>
                                ],
                                datasets: [{
                                    label: 'Revenue Per Day',
                                    
                                    backgroundColor: [
                                        'cornflowerblue'
                                        
                                    ],
                                    borderColor: [
                                        'lightskyblue'
                                     
                                    ],
                                    data: [<?php while($row21=mysqli_fetch_assoc($result21)){?>
                                <?php echo $row21["returns"];?>,
                                <?php
                               }
                               ?>],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                        </script>

                </div>
              
            </div>
            <?php
            }
            ?>

            <h1 id="boardtitle">VIDEOS ANALYTICS</h1>
            <?php 
            include "includes/contentdatabase.inc.php";
                while($row2=mysqli_fetch_assoc($result2)){
                    
                    $videotitle=$row2['videotitle'];
                    $sql3="SELECT * FROM analytics WHERE videotitle=? AND uploader=?;";
                    $stmt=mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt,$sql3)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                    }

                    mysqli_stmt_bind_param($stmt,"ss",$videotitle,$accountname);
                    mysqli_stmt_execute($stmt);
                    $result3=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row3=mysqli_fetch_assoc($result3);
                    $rownum3=mysqli_num_rows($result3);


                    $sql16="SELECT * FROM analytics WHERE videotitle=? AND uploader=? ORDER BY id DESC;";
                    $stmt=mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt,$sql16)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                    }

                    mysqli_stmt_bind_param($stmt,"ss",$videotitle,$accountname);
                    mysqli_stmt_execute($stmt);
                    $result16=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row16=mysqli_fetch_assoc($result16);

                    if($rownum3>0){
                    $id=$row3['id'];
                    $day=$row3["day"];
                    $totalviews=$row3["totalviews"];
                    $views=$row16["videoviews"];
                    $uploadedtime=$row3["uploadedtime"];
                    $time=uploadedtime($uploadedtime);
                    $thumbnail=$row3["thumbnail"];
            ?>
            <div class="contentcontainer">
                <div class="video">
                   <div class="videodiv">
                    <img src="content/videos/thumbnails/<?php echo"$directoryname";?>/<?php echo"$thumbnail";?>" alt="" class="thumbnail">
                    <div class="videodata">
                        
                        <h4><?php echo"$videotitle";?></h4>
                        <p><?php echo"$views";?> Views | <?php echo"$time";?></p>
                       </div> 
                   </div>
                   <canvas id="myChart<?php echo"$id";?>"  width="400" height="80"></canvas>
                   <script>
                       const ctx<?php echo"$id";?> = document.getElementById('myChart<?php echo"$id";?>').getContext('2d');
                       const myChart<?php echo"$id";?> = new Chart(ctx<?php echo"$id";?>, {
                           type: 'line',
                           data: {
                            <?php
                                $videotitle=$row2['videotitle'];
                                $sql4="SELECT * FROM analytics WHERE videotitle=? AND uploader=?;";
                               $stmt=mysqli_stmt_init($conn);
                               
                               if(!mysqli_stmt_prepare($stmt,$sql4)){
                                   header("location: ../signup.php?error=stmtfailed");
                                   exit();
                               }
                               
                               mysqli_stmt_bind_param($stmt,"ss",$videotitle,$accountname);
                               mysqli_stmt_execute($stmt);
                               $result4=mysqli_stmt_get_result($stmt);
                               mysqli_stmt_close($stmt);
                              
                               $rownum4=mysqli_num_rows($result4);

                               $sql5="SELECT * FROM analytics WHERE videotitle=? AND uploader=?;";
                               $stmt=mysqli_stmt_init($conn);
                               
                               if(!mysqli_stmt_prepare($stmt,$sql5)){
                                   header("location: ../signup.php?error=stmtfailed");
                                   exit();
                               }
                               
                               mysqli_stmt_bind_param($stmt,"ss",$videotitle,$accountname);
                               mysqli_stmt_execute($stmt);
                               $result5=mysqli_stmt_get_result($stmt);
                               mysqli_stmt_close($stmt);
                              
                               $rownum5=mysqli_num_rows($result5);
                               ?>
                               labels: [<?php while($row4=mysqli_fetch_assoc($result4)){?>
                                '<?php echo $row4["day"];?>',
                                <?php
                               }
                               ?>
                            ],
                               datasets: [{
                                   label: 'Views Per Day',
                                   
                                   backgroundColor: [
                                       'cornflowerblue'
                                       
                                   ],
                                   borderColor: [
                                       'lightskyblue'
                                    
                                   ],
                                   data: [<?php while($row5=mysqli_fetch_assoc($result5)){?>
                                <?php echo $row5["totalviews"];?>,
                                <?php
                               }
                               ?>],
                                   borderWidth: 2
                               }]
                           },
                           options: {
                               scales: {
                                   y: {
                                       beginAtZero: true
                                   }
                               }
                           }
                       });
                       </script>
                </div>
                
                
            </div>
            <?php
                    }

}

if($row17["catagory"]=="Music"){
    include 'includes/contentdatabase.inc.php';
$accountname=$row["accountname"];
$sql23="SELECT * FROM music WHERE  uploader=?;";
$stmt=mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql23)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt,"s",$accountname);
mysqli_stmt_execute($stmt);
$result23=mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

$rownum23=mysqli_num_rows($result23);
    ?>
    <h1 id="boardtitle">MUSIC ANALYTICS</h1>

    <?php 
            include "includes/contentdatabase.inc.php";
                while($row23=mysqli_fetch_assoc($result23)){
                    
                    $song=$row23['song'];
                    $sql24="SELECT * FROM musicanalytics WHERE song=? ORDER BY id DESC;";
                    $stmt=mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt,$sql24)){
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                    }

                    mysqli_stmt_bind_param($stmt,"s",$song);
                    mysqli_stmt_execute($stmt);
                    $result24=mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                    $row24=mysqli_fetch_assoc($result24);
                    $rownum24=mysqli_num_rows($result24);

                    if($rownum24>0){

                    $id=$row24['id'];
                    $day=$row24["day"];
                    $totalstreams=$row24["totalstreams"];
                    $streams=$row24["streams"];
                    $uploadedtime=$row24["uploadedtime"];
                    $time=uploadedtime($uploadedtime);
                    $cover=$row24["songcover"];
                    $songtitle=$row24["songtitle"];
            ?>
            <div class="contentcontainer">
                <div class="video">
                   <div class="videodiv">
                    <img src="music/covers/<?php echo"$cover";?>.jpg" alt="" class="thumbnail">
                    <div class="videodata">
                        
                        <h4><?php echo"$songtitle";?></h4>
                        <p><?php echo"$totalstreams";?> Streams | <?php echo"$time";?></p>
                       </div> 
                   </div>
                   <canvas id="myChar<?php echo"$id";?>"  width="400" height="80"></canvas>
                   <script>
                       const ct<?php echo"$id";?> = document.getElementById('myChar<?php echo"$id";?>').getContext('2d');
                       const myChar<?php echo"$id";?> = new Chart(ct<?php echo"$id";?>, {
                           type: 'line',
                           data: {
                            <?php
                                $sql25="SELECT * FROM musicanalytics WHERE song=? ORDER BY id DESC;";
                                $stmt=mysqli_stmt_init($conn);
            
                                if(!mysqli_stmt_prepare($stmt,$sql25)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }
            
                                mysqli_stmt_bind_param($stmt,"s",$song);
                                mysqli_stmt_execute($stmt);
                                $result25=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $rownum25=mysqli_num_rows($result25);

                                $sql26="SELECT * FROM musicanalytics WHERE song=? ORDER BY id DESC;";
                                $stmt=mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt,$sql26)){
                                    header("location: ../signup.php?error=stmtfailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt,"s",$song);
                                mysqli_stmt_execute($stmt);
                                $result26=mysqli_stmt_get_result($stmt);
                                mysqli_stmt_close($stmt);
                                $rownum26=mysqli_num_rows($result26);
                               
                              
                               ?>
                               labels: [<?php while($row25=mysqli_fetch_assoc($result25)){?>
                                '<?php echo $row25["day"];?>',
                                <?php
                               }
                               ?>
                            ],
                               datasets: [{
                                   label: 'Streams Per Day',
                                   
                                   backgroundColor: [
                                       'cornflowerblue'
                                       
                                   ],
                                   borderColor: [
                                       'lightskyblue'
                                    
                                   ],
                                   data: [<?php while($row26=mysqli_fetch_assoc($result26)){?>
                                <?php echo $row26["streams"];?>,
                                <?php
                               }
                               ?>],
                                   borderWidth: 2
                               }]
                           },
                           options: {
                               scales: {
                                   y: {
                                       beginAtZero: true
                                   }
                               }
                           }
                       });
                       </script>
                </div>
                
                
            </div>
            <?php
                    }

}
    
}
?>
         
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
</body>
</html>