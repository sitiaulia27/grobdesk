<?php
function merge($post)
{
    session_start();
    include 'config.php';

    $get_id = $_REQUEST['join_id'];
    $detail_id = $_REQUEST['ticket_id'];
    $id = '(' . $detail_id . ',' . $get_id . ')';
    $join = '[' . $detail_id . ',' . $get_id . ']';
    $user_id = $_SESSION['user_id'];

    $get = "SELECT subject FROM m_ticket WHERE ticket_id IN $id";
    $query5 = mysqli_query($conn, $get);
    while ($row = mysqli_fetch_assoc($query5)) {
        $subject[] = $row['subject'];
    }

    $message =
        'Request #' .
        $detail_id .
        '(' .
        $subject[0] .
        ') was closed and merged into this request. Last commment in request #' .
        $get_id .
        '(' .
        $subject[1] .
        ')';

    $query = mysqli_query(
        $conn,
        "UPDATE m_ticket SET id_join = '$join' WHERE ticket_id IN $id"
    );

    $query1 = mysqli_query(
        $conn,
        "UPDATE m_ticket SET status = 'solved' WHERE ticket_id = $detail_id"
    );
    $query2 = mysqli_query(
        $conn,
        "INSERT INTO m_ticket_detail (ticket_id,message,user_id,status) VALUES ($detail_id,'$message',$user_id,'solved'),($get_id,'$message',$user_id,'solved')"
    );
    $query3 = mysqli_query(
        $conn,
        "UPDATE m_ticket_detail SET status = 'solved' WHERE ticket_id = $detail_id"
    );
    if ($query1 && $query2 && $query3) {
        echo '<script type="text/javascript">';
        echo 'alert("Join Ticket Successfully!")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0; url=detail_ticket.php?id=' .
            $detail_id .
            '" />';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Join Ticket Failed!")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0; url=detail_ticket.php?id=' .
            $detail_id .
            '" />';
    }
}

?>
