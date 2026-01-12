<?php
$serverName="localhost";
$dBUsername="root";
$dBPassword="";
$dbName="content";

$conn = mysqli_connect($serverName,$dBUsername,$dBPassword,$dbName);
if (!$conn){
    die ("connection failed:".mysqli_connect_error());
}