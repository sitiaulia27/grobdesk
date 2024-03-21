<?php
include 'config.php';
include 'function_user.php';
include 'function_log.php';
isLoggedIn();
$id = $_GET['id'];
if (!$id) {
    echo header('Location: user_menu.php');
}
deleteUser($id);