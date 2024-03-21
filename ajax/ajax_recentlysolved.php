<?php
require_once '../config.php';

if ($_GET['action'] == "table_data") {

    $columns = array(
        0 => 't.ticket_id',
        1 => 'subject',
        2 => 'email',
        3 => 'date_added',
        4 => 't.ticket_id',
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
    $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'solved'AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' AND t.date_modified BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() + INTERVAL 1 DAY");
   }else{
    $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'solved' AND t.date_modified BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() + INTERVAL 1 DAY");
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
            $query = $mysqli->query("SELECT t.ticket_id, t.subject, t.email, t.date_added, t.status as status FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'solved'AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' AND t.date_modified BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() + INTERVAL 1 DAY order by $order $dir LIMIT $limit OFFSET $start");
        }else{
            $query = $mysqli->query("SELECT t.ticket_id, t.subject, t.email, t.date_added, t.status as status FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'solved' AND t.date_modified BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() + INTERVAL 1 DAY order by $order $dir LIMIT $limit OFFSET $start");
        }
        // exit;
    } else {
        $search = $_POST['search']['value'];
       if($searchByDate != '')
       {
        $query = $mysqli->query("SELECT t.ticket_id, t.subject, t.email, t.date_added, t.status as status FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.subject LIKE '%$search%'AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' and t.status = 'solved' AND t.date_modified BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() + INTERVAL 1 DAY order by $order $dir LIMIT $limit OFFSET $start");
       }else{
        $query = $mysqli->query("SELECT t.ticket_id, t.subject, t.email, t.date_added, t.status as status FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.subject LIKE '%$search%' and t.status = 'solved' AND t.date_modified BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() + INTERVAL 1 DAY order by $order $dir LIMIT $limit OFFSET $start");
       }
        // WHERE ct.name LIKE '%$search%' and t.status = 'delete' or t.subject LIKE '%$search%' and t.status = 'delete' or t.email LIKE '%$search%' and t.status = 'delete'
        // WHERE ct.name LIKE '%$search%' or email LIKE '%$search%' and t.status IN ('open', 'unassigned')

       if($searchByDate != '')
       {
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.subject LIKE '%$search%' and t.status = 'solved'AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' AND t.date_modified BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() ");
       }else{
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.subject LIKE '%$search%' and t.status = 'solved' AND t.date_modified BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() ");
       }
        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];
    }

    $data = array();

    if ($query) {
        $no = $start + 1;
        while ($r = $query->fetch_array()) {
            $nestedData['no'] = $no;
            $nestedData['subject'] = $r['subject'];
            $nestedData['requester'] = $r['email'];
            $nestedData['requested'] = $r['date_added'];
            $nestedData['aksi'] = "<a class= 'btn btn-warning btn-sm' href='detail_ticket.php?id=" . $r['ticket_id'] . "'><i class='fa fa-edit'></i>Detail</a>";
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
