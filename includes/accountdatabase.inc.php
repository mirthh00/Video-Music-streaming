<?php
$serverName="sql8.freesqldatabase.com";
$dBUsername="sql8814313";
$dBPassword="TumrmqgduS";
$dbName="sql8814313";

$conn = mysqli_connect($serverName,$dBUsername,$dBPassword,$dbName);
if (!$conn){
    die ("connection failed:".mysqli_connect_error());
}
