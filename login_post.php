<?php
include 'config.php';
session_start();

// var_dump($_SESSION);
// die();
if (isset($_POST['submit'])) {
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

        $captcha = $_POST['g-recaptcha-response'];

        $secretKey = "6LcwwVghAAAAABwYEJBiWxLDhPvQQLBbQBaJ18sH";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        if ($responseKeys['success']) {
            include 'function_log.php';
            login($_POST);
        } else {
            echo "<script>alert('Robot verification failed, please try again')</script>";
        }

    } else {
        echo "<script>alert('please fill recaptcha!')</script>";
        echo '<meta http-equiv="refresh" content="0; url=login.php" />';
    }

}
