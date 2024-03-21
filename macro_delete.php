<?php
include 'config.php';
include 'function_macro.php';
include 'function_log.php';
isLoggedIn();
$id = $_GET['id'];
deleteMacro($id);
