<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "grobdesk";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {

    echo "Koneksi database gagal : " . mysqli_connect_error();
    exit;
}

$SMTP_EMAIL = "mukhasan280502@gmail.com";
$SMTP_PASSWORD = "yzxtrhsqgxegcqdx";
// $SMPT_HOST = "smtp.gmail.com";
$SMPT_PORT = "465";
