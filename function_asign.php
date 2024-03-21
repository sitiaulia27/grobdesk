<?php

function asign($post)
{
    include 'config.php';
    // include 'function_user.php';

    $user = $_REQUEST['useroption'];
    $newuser = getUserById($user);
    $pesan = 'This ticket assigned to new agent : ' . $newuser['name'];
    $user_id = $_SESSION['user_id'];
    $status = 'open';
    $ticket_id = $post['ticketid'];
    $user = $post['useroption'];
    $query = "INSERT INTO m_ticket_detail SET ticket_id = '$ticket_id', message = '$pesan', user_id = '$user', status = '$status', date_added = NOW(), date_modified = NOW(), attachment = ''";
    if (mysqli_query($conn, $query)) {
        $query1 = "UPDATE m_ticket SET status='open' WHERE ticket_id=$ticket_id";
        if (mysqli_query($conn, $query1)) {
            echo '<script type ="text/JavaScript">';
            echo 'alert("pesan terkirim")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=" />';
            // $response = [
            //     'message' => 'berhasil',
            // ];
        } else {
            echo '<script type ="text/JavaScript">';
            echo 'alert("Gagal !!")';
            echo '</script>';
            // $response = [
            //     'message' => 'gagal',
            // ];
        }
    } else {
        echo '<script type ="text/JavaScript">';
        echo 'alert("Gagal !")';
        echo '</script>';
        // $response = [
        //     'message' => 'gagal',
        // ];
    }
    //     header('Content-Type: application/json');
    //     echo json_encode($response);
}
