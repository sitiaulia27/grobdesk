<?php
// include 'config.php';
include 'function_customer_replay.php';
customer_replay($_REQUEST);
// $emails = $_REQUEST['emails'];
// $msg = $_REQUEST['texts'];
// $date = $_REQUEST['dates'];
// $ids = $_REQUEST['id'];
// // $time = strtotime($date[0]);
// // $newformat = date('Y-m-d H:i:s',$time);
// // echo $newformat = date('Y-m-d H:i:s',$time);exit;
// // var_dump($date);exit;
// // customer_replay();
// for ($i = 0; $i < count($emails); $i++) {
//     $email = $emails[$i];
//     $id = $ids[$i];
//     $query = "SELECT * FROM m_ticket WHERE ticket_id=$id";
//     $cek = mysqli_query($conn, $query);
//     $get = mysqli_fetch_assoc($cek);
//     // var_dump($get["ticket_id"]);exit;
//     if ($cek) {
//         // $time = strtotime($date[$i]);
//         // $newformat = date('Y-m-d H:i:s',$time);
//         $tanggal = $date[$i];
//         $ticket_id = $get['ticket_id'];
//         $message = $msg[$i];

//         $query1 = "SELECT * FROM m_ticket_detail WHERE message='$message' and date_added='$tanggal'";
//         $get1 = mysqli_query($conn, $query1);
//         $cek1 = mysqli_fetch_assoc($get1);
//         // var_dump(count($cek1));exit;
//         if ($cek1 == null) {
//             # code...
//             $query = "INSERT INTO m_ticket_detail (ticket_id,message,user_id,status, date_added) VALUE ($ticket_id,'$message',0,'open','$tanggal')";
//             $ins = mysqli_query($conn, $query);
//         }
//     }
// }
// return true;
?>
