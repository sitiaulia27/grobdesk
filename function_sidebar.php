<?php
function sidebar()
{
    include 'config.php';
    $id = $_SESSION['user_id'];
    $query_mysqli = mysqli_query(
        $conn,
        "SELECT * FROM m_user WHERE user_id = $id"
    );
    while ($data = mysqli_fetch_array($query_mysqli)) {
        echo $data['name'];
    }
}
?>
