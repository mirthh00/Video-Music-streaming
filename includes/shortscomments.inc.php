<?php

if(isset($_POST["submit"]))
{
    $videoid=mysqli_real_escape_string($_POST["videoid"]);
    $comment=mysqli_real_escape_string($_POST["comment"]);
    $commenttime=mysqli_real_escape_string($_POST["commenttime"]);
    $username=mysqli_real_escape_string($_POST["username"]);
    $userimage=mysqli_real_escape_string($_POST["userimage"]);
    $id=mysqli_real_escape_string($_POST["id"]);
    include "contentdatabase.inc.php";
    include "functions.inc.php";
    shortscomments($conn,$videoid,$comment,$commenttime,$username,$userimage,$id);
}