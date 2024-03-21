<?php
require_once '../config.php';

if ($_REQUEST['action'] == "table_data") {


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
    $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t WHERE t.status='open' and t.ticket_id in (SELECT ticket_id FROM m_ticket_detail td where user_id = 0 and status='open') AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' GROUP BY t.ticket_id");
   }else{
    $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t WHERE t.status='open' and t.ticket_id in (SELECT ticket_id FROM m_ticket_detail td where user_id = 0 and status='open')GROUP BY t.ticket_id");
   }
    $datacount = mysqli_fetch_assoc($querycount);

    $totalData = $datacount ? $datacount['jumlah'] : 0;

    $totalFiltered = $totalData;

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];

    if (empty($_POST['search']['value'])) {
       if($searchByDate != '')
       {
        $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.email, t.subject, t.date_added, t.date_modified, t.status as status FROM m_ticket t
        JOIN m_category_ticket ct on ct.category_ticket_id=t.category_ticket
        WHERE t.status='open' and t.ticket_id in (SELECT ticket_id FROM m_ticket_detail td where user_id = 0 and status='open') AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' GROUP BY t.ticket_id order by $order $dir LIMIT $limit OFFSET $start");
       }else{
        $query = $mysqli->query("SELECT t.ticket_id, ct.name as catename, t.email, t.subject, t.date_added, t.date_modified, t.status as status FROM m_ticket t
        JOIN m_category_ticket ct on ct.category_ticket_id=t.category_ticket
        WHERE t.status='open' and t.ticket_id in (SELECT ticket_id FROM m_ticket_detail td where user_id = 0 and status='open')GROUP BY t.ticket_id order by $order $dir LIMIT $limit OFFSET $start");
       }

        // $query = $mysqli->query("SELECT td.ticket_id,t.ticket_id, ct.name as catename, t.email, t.subject, t.date_added, t.date_modified, t.status as status FROM m_ticket_detail td 
        // JOIN m_ticket t on t.ticket_id=td.ticket_id
        // JOIN m_category_ticket ct on ct.category_ticket_id=t.category_ticket
        // WHERE td.status='open' and td.user_id=0 order by $order $dir LIMIT $limit OFFSET $start");
        // exit;
    } else {
        $search = $_POST['search']['value'];

       if($searchByDate != '')
       {
        $query = $mysqli->query("SELECT t.ticket_id, t.email, t.subject, t.date_added, t.date_modified, t.status as status FROM m_ticket t
        WHERE t.status='open' and t.ticket_id in (SELECT ticket_id FROM m_ticket_detail td where user_id = 0 and status='open') and (t.email LIKE '%$search%' or t.subject like '%$search%') GROUP BY t.ticket_id AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' order by $order $dir LIMIT $limit OFFSET $start");
       }else{
        $query = $mysqli->query("SELECT t.ticket_id, t.email, t.subject, t.date_added, t.date_modified, t.status as status FROM m_ticket t
        WHERE t.status='open' and t.ticket_id in (SELECT ticket_id FROM m_ticket_detail td where user_id = 0 and status='open') and (t.email LIKE '%$search%' or t.subject like '%$search%') GROUP BY t.ticket_id order by $order $dir LIMIT $limit OFFSET $start");
       }

        // $query = $mysqli->query("SELECT td.ticket_id,t.ticket_id, ct.name as catename, t.email, t.subject, t.date_added, t.date_modified, t.status as status FROM m_ticket_detail td 
        // JOIN m_ticket t on t.ticket_id=td.ticket_id
        // JOIN m_category_ticket ct on ct.category_ticket_id=t.category_ticket
        // WHERE td.status='open' and td.user_id=0 and ct.name LIKE '%$search%' order by $order $dir LIMIT $limit OFFSET $start");

      if($searchByDate != '')
      {
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t
        WHERE t.status='open' and t.ticket_id in (SELECT ticket_id FROM m_ticket_detail td where user_id = 0 and status='open') and (t.email LIKE '%$search%' or t.subject like '%$search%') AND DATE(t.date_added) BETWEEN '$searchByDate' AND '$toDate2' GROUP BY t.ticket_id");
      }else{
        $querycount = $mysqli->query("SELECT count(t.ticket_id) as jumlah FROM m_ticket t
        WHERE t.status='open' and t.ticket_id in (SELECT ticket_id FROM m_ticket_detail td where user_id = 0 and status='open') and (t.email LIKE '%$search%' or t.subject like '%$search%') GROUP BY t.ticket_id");
      }
        $datacount = mysqli_fetch_assoc($querycount);
        if ($datacount != null) {
            # code...
            $totalFiltered = $datacount['jumlah'];
        } else {
            $totalFiltered = 0;
        }
    }

    $data = array();

    if ($query) {
        $no = $start + 1;
        while ($r = $query->fetch_array()) {
            $nestedData['no'] = $no;
            $nestedData['cek'] = $datacount;
            $nestedData['subject'] = $r['subject'];
            $nestedData['requester'] = $r['email'];
            $nestedData['requested'] = $r['date_added'];
            $nestedData['assignee'] = $r['email'];
            $nestedData['aksi'] = "<a class= 'btn btn-warning btn-sm' href='detail_ticket.php?id=" . $r['ticket_id'] . "'><i class='fa fa-edit'></i>Detail</a>";
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
