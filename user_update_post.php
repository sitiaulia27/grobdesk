<?php

include 'config.php';
include 'function_user.php';
$password = $_POST['password'];
$repassword = $_POST['cfm_password'];

if ($password != $repassword) {
    echo '<script type ="text/JavaScript">';
    echo 'alert("Password dan Confirm Password tidak sama");';
    echo "window.location.href='javascript:window.history.go(-1)';";
    echo '</script>';
    // echo '<meta http-equiv="refresh" content="0; url=user_update.php" />';
    die;
}

updateUser($_POST);
