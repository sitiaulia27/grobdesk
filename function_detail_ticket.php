<?php
function ticket_detail()
{
    include 'config.php';
    $id = $_GET['id'];
    $no = 1;
    $get = "SELECT td.user_id, t.subject, td.message, td.status, td.date_added, td.date_modified, td.attachment,
            t.order_id, t.email, t.category_ticket, ct.name FROM m_ticket_detail td
            LEFT JOIN m_ticket t ON td.ticket_id = t.ticket_id
            LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket
            WHERE t.ticket_id = '$id'";
    $query = mysqli_query($conn, $get);
    while ($row = mysqli_fetch_assoc($query)) {
        echo '<tr>';
        echo '<td>' . $no++ . '</td>';
        echo '<td>' . $row['subject'] . '</td>';
        echo '<td>' . $row['message'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['date_added'] . '</td>';
        echo '<td>' . $row['date_modified'] . '</td>';
        echo "<td><img src='img/" .
            $row['attachment'] .
            "' width='60' height='60'></td>";
    }
}

function detailTicket()
{
    include 'config.php';
    $id = $_GET['id'];
    $get = "SELECT t.ticket_id, t.order_id, t.subject, t.name as tname, ct.name as catename,
            t.order_id, t.email, t.category_ticket, ct.name FROM m_ticket t
            JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket
            WHERE t.ticket_id = $id";

    $query = mysqli_query($conn, $get);

    $mesage = "SELECT d.*, t.name FROM m_ticket_detail d JOIN m_ticket t ON t.ticket_id = d.ticket_id WHERE d.ticket_id = $id";
    global $query1;
    $query1 = mysqli_query($conn, $mesage);

    $email = $_SESSION['loggrobdesk'];
    $getIDuser = "SELECT * FROM m_user WHERE email='$email'";
    $cek = mysqli_query($conn, $getIDuser);
    global $idUser;
    global $nameUser;
    while ($getid = mysqli_fetch_assoc($cek)) {
        $idUser = $getid['user_id'];
        $nameUser = $getid['name'];
    }
    global $tickID;
    global $subjek;
    while ($row = mysqli_fetch_assoc($query)) {
        echo '<p>ticket id:' . $row['ticket_id'] . '</p>';
        echo '<p>Email:' . $row['email'] . '</p>';
        echo '<p>Kategori:' . $row['catename'] . '</p>';
        echo '<p>Order id:' . $row['order_id'] . '</p>';
        echo '<p>Nama:' . $row['tname'] . '</p>';
        $tickID = $row['ticket_id'];
        $subjek = $row['subject'];
    }
}

function detail_ticket($id)
{
    include 'config.php';
    $customer = [];

    $sql = "SELECT t.ticket_id, t.order_id, t.subject, t.name as tname, ct.name as catename,
    t.order_id, t.email, t.category_ticket, ct.name, t.id_join FROM m_ticket t
    JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket
    WHERE t.ticket_id = $id";
    $cek = mysqli_query($conn, $sql);
    $customer = mysqli_fetch_assoc($cek);
    // $data[$i]['ticket_id'] = $customer['ticket_id'];
    // $data[$i]['email'] = $customer['email'];
    // $data[$i]['catename'] = $customer['catename'];
    // $data[$i]['order_id'] = $customer['attachment'];
    // $data[$i]['tname'] = $customer['tname'];

    return $customer;
}

function getTickets($id)
{
    include 'config.php';
    $data = [];

    $email = $_SESSION['loggrobdesk'];

    $sql = "SELECT d.*, t.name FROM m_ticket_detail d INNER JOIN m_ticket t ON t.ticket_id = d.ticket_id WHERE d.ticket_id = $id";
    $query1 = mysqli_query($conn, $sql);
    $i = 0;
    while ($customer = mysqli_fetch_assoc($query1)) {
        $data[$i]['ticket_id'] = $customer['ticket_id'];
        $data[$i]['name'] = $customer['name'];
        $data[$i]['message'] = $customer['message'];
        $data[$i]['attachment'] = $customer['attachment'];
        $data[$i]['user_id'] = $customer['user_id'];
        if ($customer['user_id'] != 0) {
            $getIDuser =
                "SELECT * FROM m_user WHERE user_id ='" .
                $customer['user_id'] .
                "'";
            $query = mysqli_query($conn, $getIDuser);
            $cek = mysqli_fetch_assoc($query);
            $data[$i]['nameUser'] = $cek['name'];
        } else {
            $data[$i]['nameUser'] = '';
        }
        $i++;
    }
    return $data;
}
