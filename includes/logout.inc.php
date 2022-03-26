<?php
//Destroys session to logout
session_start();
session_unset();
session_destroy();
header("location:../index.php");
