<div class="subscribe">
            <div class="subscribebox">
                <div class="subaccount">
                    <img id="account" class="ipaccount" src="profilepictures/<?php echo $row["profileimage"];?>">
                </div>
                <p id="paymentinfo">Pay to unlock the content inside this account.The 
                    payment will grant you access to this account for
                    a month and will not be auto billed.
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
                $useremail=$row2["roomid"];
                echo "$useremail";
                ?>" name="roomid"> 
                <input type="hidden" class="input-box" value="<?php 
                $useremail=$row2["roomname"];
                echo "$useremail";
                ?>" name="roomname"> 
                <input type="hidden" class="input-box" value="<?php 
                echo "$recommender";
                ?>" name="recommender"> 
                  <input type="hidden" class="input-box" value="<?php 
                $price=$row["price"];
                echo "$price";
                ?>" name="price"> 
                <button name="pay" id="paymentbutton"><?php echo $row["price"];?> <?php echo $row["currency"];?>s</button>
                </div>
                </form>
            </div>
</div>

<div class="accountscontainer">
        <?php
        $counter=0;
        
        if($rownum>0)
        {
            while($row=mysqli_fetch_assoc($data)){
                $counter=$counter+1;
                if($counter<9){
                    echo '
                    <div class="a">
                <a href="account.php?ID='.$row["accountid"].'"><img class="ipaccount" src="profilepictures/'.$row["profileimage"].'"></a>
                <p>'.$row["accountname"].'</p>
                </div>
                ';
                }
                }
        }
        else{
            echo '
            <div class="thirdbanner">
            <h1>You have no unlocked accounts!</h1>
            </div>
            ';
        }
        ?>
        </div>

        <form action="includes/boost.inc.php" method="post">
                        <input type="hidden" name="uniqueid" value="<?php echo "$uniqueid"; ?>">
                        <input type="hidden" name="thumbnail" value="<?php echo "$thumbnail"; ?>">
                        <input type="hidden" name="directoryname" value="<?php echo "$directoryname"; ?>">
                        <input type="hidden" name="videotitle" value="<?php echo "$videotitle"; ?>">
                        <input type="hidden" name="uploader" value="<?php echo "$uploader"; ?>">
                        <input type="hidden" name="genre" value="<?php echo "$genre"; ?>">
                        <input type="hidden" name="accountid" value="<?php echo "$accountid"; ?>">
                        <input type="hidden" name="roomid" value="<?php echo "$roomid"; ?>">
                        <button name="boost" type="submit">$10</button>
                    </form>

                    <form action="includes/featured.inc.php" method="post">
                        <input type="hidden" name="accountname" value="<?php echo $row["accountname"]; ?>">
                        <input type="hidden" name="catagory" value="<?php echo $row["catagory"]; ?>">
                        <input type="hidden" name="profileimage" value="<?php echo $row["profileimage"]; ?>">
                        <input type="hidden" name="accountid" value="<?php echo $row["id"]; ?>">
                        <input type="hidden" name="roomid" value="<?php echo "$roomid"; ?>">
                        <button name="pay" type="submit">R500</button>
                    </form>