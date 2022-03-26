<?php
//Returns a user after email is matched
require_once 'functions.inc.php';
require_once 'config.inc.php';
privilegeLevel("Engineering");

if (isset($_POST["modify_user_submit"])) {
    $user_email = $_POST["search_user_email"];
    $userData = readUser($conn, $user_email);
    header("location: ..\modify_user.php");
}
