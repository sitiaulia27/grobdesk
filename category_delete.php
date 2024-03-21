<?php
include 'function_log.php';
isLoggedIn();
include 'config.php';
include 'function_category.php';
$id = $_GET['id'];
if (!$id) {
    echo header('Location: category_index.php');
}
deleteCategory($id);
