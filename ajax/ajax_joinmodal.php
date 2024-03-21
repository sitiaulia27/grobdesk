
<?php
require_once '../config.php';

if ($_GET['action'] == 'table_data') {
    $columns = [
        0 => 'ticket_id',
        1 => 'requester',
        4 => 'email',
        3 => 'subject',
        4 => 'date_added',
        5 => 'date_modified',
        6 => 'action',
    ];

    $detail_id = $_POST['ticket_id'];
    $querycount = $mysqli->query(
        'SELECT count(t.ticket_id) as jumlah FROM m_ticket t'
    );

    $datacount = $querycount->fetch_array();

    $totalData = $datacount['jumlah'];

    $totalFiltered = $totalData;

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];

    if (empty($_POST['search']['value'])) {
        $query = $mysqli->query(
            "SELECT t.ticket_id, t.name, t.email, t.subject, t.date_added, t.date_modified FROM m_ticket t WHERE t.ticket_id != $detail_id order by $order $dir LIMIT $limit OFFSET $start"
        );
    } else {
        $search = $_POST['search']['value'];
        $query = $mysqli->query(
            "SELECT t.ticket_id, t.subject, t.email,t.name, t.date_added, t.date_modified FROM m_ticket t WHERE t.ticket_id != $detail_id && (t.ticket_id LIKE '%$search%' or t.name LIKE '%$search%' or t.email LIKE '%$search%' or t.subject LIKE '%$search%') order by $order $dir LIMIT $limit OFFSET $start"
        );

        $querycount = $mysqli->query(
            "SELECT count(t.ticket_id) as jumlah FROM m_ticket t WHERE (t.ticket_id LIKE '%$search%' or t.name LIKE '%$search%' or t.email LIKE '%$search%' or t.subject LIKE '%$search%') "
        );

        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];
    }

    $data = [];

    if ($query) {
        $no = $start + 1;
        while ($r = $query->fetch_array()) {
            $nestedData['action'] =
                "<a class = 'btn btn-primary btn-xl' onclick = 'mergeThis(" .
                $r['ticket_id'] .
                ")' ></i>Merge</a>";
            $nestedData['ticket_id'] = $r['ticket_id'];
            $nestedData['subject'] = $r['subject'];
            $nestedData['email'] = $r['email'];
            $nestedData['requester'] = $r['name'];
            $nestedData['date_added'] = $r['date_added'];
            $nestedData['date_modified'] = $r['date_modified'];
            $data[] = $nestedData;
            $no++;
        }
    }
    // $data = print_r($nestedData);
    $json_data = [
        'draw' => intval($_POST['draw']),
        'recordsTotal' => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        'data' => $data,
    ];

    echo json_encode($json_data);
}

