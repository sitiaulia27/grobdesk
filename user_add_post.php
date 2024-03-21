<?php 

include 'config.php';
include 'function_user.php';
$password = $_POST['password'];
$repassword = $_POST['cfm_password'];

if ($password != $repassword) {
    echo '<script type ="text/JavaScript">';
    echo 'alert("Password dan Confirm Password tidak sama")';
    echo '</script>';
    header("location:input.php");
    die;
}

createUser($_POST);



//mysqli_query($conn, "INSERT INTO m_user (name, email, status)VALUES('','$name', '$email', '$status')");

// echo '<meta http-equiv="refresh" content="0; url=index.php" />';
?>