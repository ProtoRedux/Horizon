<?php
//Change this from default
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "captec";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (mysqli_connect_errno()) {
    die("Database connectio failed!" . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
