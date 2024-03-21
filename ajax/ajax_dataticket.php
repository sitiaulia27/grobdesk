<?php
require_once '../config.php';

if ($_GET['action'] == "table_data") {

    $columns = array(
        0 => 'ticket_id',
        1 => 'name',
        4 => 'email',
        3 => 'subject',
        4 => 'date_added',
        5 => 'ticket_id',
    );

    // filter
    $searchByDate = $_POST['searchByDate'];
    $toDate = $_POST['toDate'];

    if ($toDate != '') {
        $toDate2 = $toDate;
    } else {
        $toDate2 = $searchByDate;
    }

    if ($searchByDate != '') {
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t WHERE DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2'");
    } else {
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t");
    }
    $datacount = $querycount->fetch_array();

    $totalData = $datacount['jumlah'];

    $totalFiltered = $totalData;

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];

    if (empty($_POST['search']['value'])) {
        if ($searchByDate != '') {
            $query = $mysqli->query("SELECT t.ticket_id, t.name, t.email, t.subject, t.date_added FROM m_ticket t WHERE DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' order by $order $dir LIMIT $limit OFFSET $start");
        } else {
            $query = $mysqli->query("SELECT t.ticket_id, t.name, t.email, t.subject, t.date_added FROM m_ticket t order by $order $dir LIMIT $limit OFFSET $start");
        }
        // exit;
    } else {
        $search = $_POST['search']['value'];
        if ($searchByDate != '') {
            $query = $mysqli->query("SELECT t.ticket_id, t.name, t.email, t.subject, t.date_added FROM m_ticket t WHERE (t.name LIKE '%$search%' or t.email LIKE '%$search%' or t.subject LIKE '%$search%') AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' order by $order $dir LIMIT $limit OFFSET $start");
        } else {
            $query = $mysqli->query("SELECT t.ticket_id, t.subject, t.email,t.name, t.date_added FROM m_ticket t WHERE (t.name LIKE '%$search%' or t.email LIKE '%$search%' or t.subject LIKE '%$search%') order by $order $dir LIMIT $limit OFFSET $start");
        }
        // WHERE cname LIKE '%$search%' and t.status = 'delete' or t.subject LIKE '%$search%' and t.status = 'delete' or t.email LIKE '%$search%' and t.status = 'delete'
        // WHERE ct.name LIKE '%$search%' or email LIKE '%$search%' and t.status IN ('open', 'unassigned')

        if ($searchByDate != '') {
            $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t WHERE (t.name LIKE '%$search%' or t.email LIKE '%$search%' or t.subject LIKE '%$search%') AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' ");
        } else {
            $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t WHERE (t.name LIKE '%$search%' or t.email LIKE '%$search%' or t.subject LIKE '%$search%') ");
        }
        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];
    }

    $data = array();

    if ($query) {
        $no = $start + 1;
        while ($r = $query->fetch_array()) {
            $nestedData['no'] = $no;
            $nestedData['name'] = $r['name'];
            $nestedData['email'] = $r['email'];
            $nestedData['subject'] = $r['subject'];
            $nestedData['requested'] = $r['date_added'];
            $nestedData['aksi'] = "<a class='btn btn-warning btn-sm' href='detail_ticket.php?id=" . $r['ticket_id'] . "'><i a class = 'fa fa-info-circle'></i>Detail</a>
                <a class='btn btn-danger btn-sm' href='deleteTickets.php?id=" . $r['ticket_id'] . "'><i class = 'fa fa-trash'></i>Delete</a>";
            $data[] = $nestedData;
            $no++;
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
