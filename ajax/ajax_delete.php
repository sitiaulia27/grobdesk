<?php
require_once '../config.php';

if ($_GET['action'] == "table_data") {


    $columns = array(
        0 => 't.ticket_id',
        1 => 'name',
        2 => 'subject',
        3 => 'email',
        4 => 'date_added',
        5 => 'date_modified',
        6 => 't.ticket_id',
    );

   // filter
   $searchByDate = $_POST['searchByDate'];
   $toDate = $_POST['toDate'];
   
   if($toDate != '')
   {
       $toDate2 = $toDate;
   }else{
       $toDate2 = $searchByDate;
   }

    if($searchByDate != '')
    {
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t
        JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'delete' AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2'");
    }else{
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t
        JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'delete'");
    }
    $datacount = $querycount->fetch_array();


    $totalData = $datacount['jumlah'];

    $totalFiltered = $totalData;

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];

    if (empty($_POST['search']['value'])) {
       if($searchByDate != '')
       {
        $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.subject, t.email, t.date_added, t.date_modified, t.status as status FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'delete' AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' order by $order $dir LIMIT $limit OFFSET $start");
       }else{
        $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.subject, t.email, t.date_added, t.date_modified, t.status as status FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'delete' order by $order $dir LIMIT $limit OFFSET $start");
       }
        // exit;
    } else {
        $search = $_POST['search']['value'];
        if($searchByDate != '')
        {
            $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.subject, t.email, t.date_added, t.date_modified, t.status as status FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE ct.name LIKE '%$search%' and t.status = 'delete' or t.subject LIKE '%$search%' and t.status = 'delete' AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' or t.email LIKE '%$search%' and t.status = 'delete' order by $order $dir LIMIT $limit OFFSET $start");
        }else{
            $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.subject, t.email, t.date_added, t.date_modified, t.status as status FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE ct.name LIKE '%$search%' and t.status = 'delete' or t.subject LIKE '%$search%' and t.status = 'delete' or t.email LIKE '%$search%' and t.status = 'delete' order by $order $dir LIMIT $limit OFFSET $start");
        }


       if($searchByDate != '')
       {
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE ct.name LIKE '%$search%' and t.status = 'delete' or t.subject LIKE '%$search%' and t.status = 'delete' or t.email LIKE '%$search%' AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' and t.status = 'delete' ");
       }else{
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE ct.name LIKE '%$search%' and t.status = 'delete' or t.subject LIKE '%$search%' and t.status = 'delete' or t.email LIKE '%$search%' and t.status = 'delete' ");
       }
        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];
    }

    $data = array();

    if ($query) {
        $no = $start + 1;
        while ($r = $query->fetch_array()) {
            $nestedData['no'] = $no;
            $nestedData['category'] = $r['catename'];
            $nestedData['subject'] = $r['subject'];
            $nestedData['requester'] = $r['email'];
            $nestedData['requested'] = $r['date_added'];
            $nestedData['latestupdater'] = $r['date_modified'];
            $nestedData['aksi'] = "<a class= 'btn btn-secondary btn-sm' href='restoreTickets.php?id=" . $r['ticket_id'] . "'><i class='fa fa-arrow-up'></i>Restore</a>";
            $data[] = $nestedData;
            $no++;
        }
    }
    // $data = print_r($nestedData);
    $json_data = array(
        "draw"            => intval($_POST['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    );

    echo json_encode($json_data);
}
