<?php
require_once '../config.php';
session_start();
if ($_GET['action'] == "table_data") {

    $columns = array(
        0 => 't.ticket_id',
        1 => 'name',
        2 => 'subject',
        3 => 'email',
        4 => 'date_added',
        5 => 't.ticket_id',
        6 => 'status',
        7 => 'date_modified',
    );
    $user_id = $_SESSION['user_id'];
    // filter
    $searchByDate = $_POST['searchByDate'];
    $toDate = $_POST['toDate'];

    if ($toDate != '') {
        $toDate2 = $toDate;
    } else {
        $toDate2 = $searchByDate;
    }
    if ($searchByDate != '') {
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t INNER JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open' AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2'");
    } else {
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t INNER JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open'");
    }

    $datacount = $querycount->fetch_array();
    // $user_id = $_SESSION['user_id'];

    $totalData = $datacount['jumlah'];

    $totalFiltered = $totalData;

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];

    if (empty($_POST['search']['value'])) {
        if ($searchByDate != '') {
            $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.email, t.subject,t.date_added, t.date_modified, t.status FROM m_ticket t INNER JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open' AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' order by $order $dir LIMIT $limit OFFSET $start");
        } else {
            $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.email, t.subject,t.date_added, t.date_modified, t.status FROM m_ticket t INNER JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open' order by $order $dir LIMIT $limit OFFSET $start");
        }
        // exit;
    } else {
        $search = $_POST['search']['value'];

        if ($searchByDate != '') {
            $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.email, t.subject,t.date_added, t.date_modified, t.status FROM m_ticket t INNER JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open' AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' and (ct.name LIKE '%$search%' or email LIKE '%$search%' or t.subject LIKE '%$search%') order by $order $dir LIMIT $limit OFFSET $start");
        } else {
            $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.email, t.subject,t.date_added, t.date_modified, t.status FROM m_ticket t INNER JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open' AND (ct.name LIKE '%$search%' or email LIKE '%$search%' or t.subject LIKE '%$search%') order by $order $dir LIMIT $limit OFFSET $start");
        }
        // WHERE ct.name LIKE '%$search%' and t.status = 'delete' or t.subject LIKE '%$search%' and t.status = 'delete' or t.email LIKE '%$search%' and t.status = 'delete'
        // WHERE ct.name LIKE '%$search%' or email LIKE '%$search%' and t.status IN ('open', 'unassigned')

        if ($searchByDate != '') {
            $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t INNER JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open' and (ct.name LIKE '%$search%' or email LIKE '%$search%' or t.subject LIKE '%$search%') AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2'");
        } else {
            $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t INNER JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open' and (ct.name LIKE '%$search%' or email LIKE '%$search%' or t.subject LIKE '%$search%')");
        }
        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];
    }

    $data = array();

    if ($query) {
        $no = $start + 1;
        while ($r = $query->fetch_array()) {
            $id_ticket = $r['ticket_id'];

            //tarik data pertama dari ticket detail dimana user idnya bukan customer dan ticket id adalah id
            $que = "SELECT * FROM m_ticket_detail WHERE ticket_id = '$id_ticket' AND user_id <> 0 ORDER BY date_added ASC LIMIT 0,1";
            $sql = mysqli_query($conn, $que);
            $cek = mysqli_fetch_assoc($sql);

            if (mysqli_num_rows($sql) > 0 && $cek['user_id'] == $user_id) {
                //tarik data terakhir dari ticket detail dimana user idnya bukan customer dan ticket id adalah id
                $que2 = "SELECT * FROM m_ticket_detail WHERE user_id <> 0 AND ticket_id = '$id_ticket' ORDER BY date_added DESC LIMIT 0,1";
                $sql2 = mysqli_query($conn, $que2);
                $cek2 = mysqli_fetch_assoc($sql2);

                //JIKA USER PERTAMA DENGAN USER TERAKHIR TIDAK SAMA MAKA TAMPILKAN
                if ($user_id != $cek2['user_id']) {
                    $nestedData['no'] = $no;
                    $nestedData['category'] = $r['catename'];
                    $nestedData['subject'] = $r['subject'];
                    $nestedData['requester'] = $r['email'];
                    $nestedData['status'] = $r['status'];
                    $nestedData['requested'] = $r['date_added'];
                    $nestedData['modified'] = $r['date_modified'];
                    $nestedData['aksi'] = "<a class= 'btn btn-warning btn-sm' href='detail_ticket.php?id=" . $r['ticket_id'] . "'><i class='fa fa-edit'></i>Detail</a>";
                    $data[] = $nestedData;
                    $no++;
                }
            }

        }
    }
    // $data = print_r($nestedData);
    $json_data = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data" => $data,
    );

    echo json_encode($json_data);
}
