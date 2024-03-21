<?php
include 'config.php';
include 'function_role.php';
include 'function_log.php';
isLoggedIn();
$id = $_GET['id'];
deleteRole($id);
