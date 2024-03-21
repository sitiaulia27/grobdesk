<?php

function profil_admin($id)
{
    include 'config.php';
    $data = [];
    $id = $_SESSION['user_id'];
    $query_mysqli = mysqli_query(
        $conn,
        "SELECT * FROM m_user WHERE user_id = $id"
    );
    $data = mysqli_fetch_array($query_mysqli);
    return $data;
}
