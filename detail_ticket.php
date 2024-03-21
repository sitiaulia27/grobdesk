<!DOCTYPE html>
<html lang="en">
    <?php
include 'config.php';
include 'function_detail_ticket.php';
include 'function_log.php';
include 'function_macro.php';
include 'function_user.php';
isLoggedIn();
$id = $_GET['id'];
$data = detail_ticket($id);

function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

$order_id = $data['order_id'];
$email = $data['email'];
$url =
    'https://www.grobmart.com/packing-grobmart/api_order.php?key=bdOHg38aPu7dC4CYCVJH&&secret=7Cg44kx1Zlao5lUQyuk3&&order_id=' .
    $order_id .
    '&&email=' .
    $email .
    '';
// var_dump($uri);die;

$curl = curl($url);

// mengubah JSON menjadi array
$get = json_decode($curl, true);
$data_order = [];
$detail = [];
$histori = [];
if (count($get['order_data']) <= 0) {
    # code...
    echo '<input type="hidden" name="cek" value="' .
    count($get['order_data']) .
        '">';
} else {
    # code...
    $data_order = $get['order_data'][0];
    $detail = $get['order_product'];
    $histori = $get['order_history'];
    echo '<input type="hidden" name="cek" value="' .
    count($get['order_data']) .
        '">';
}
?>
<head>
    <?php include 'global_head.php';?>
    <title>Detail Ticket</title>
    <script src="tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'.editor',
            menubar: 'format',
            // plugins : 'autoresize',
            width: '100%',
            height: 250,
            min_height: 100,
            // max_height: 400,
            // min_width: 400,
            // max_width: 500,
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="hias.css" rel="stylesheet" type="text/css">
    <link href="style2.css" rel="stylesheet" type="text/css">
    <style>
        .card{
            border-radius:0.1rem;
            border-color: #fafafa;
            box-shadow:0 0;
        }
        .select2-selection__rendered{
            margin-top: -9px !important;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="detail_title">
    <!-- navbar -->
    <?php include 'global_header.php';?>
    <?php include 'global_sidebar.php';?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text bg-light mb-7">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="data">
                                    <?php
$id = $_GET['id'];
$data = detail_ticket($id);
?>
                                    </div>
                                    <div class="mb-1">
                                        <label for="exampleFormControlInput1" class="form-label">Ticket ID</label>
                                        <input class="form-control" type="text" value="<?php echo $data[
    'ticket_id'
]; ?>" aria-label="Disabled input example" disabled readonly>
                                    </div>

                                    <div class="mb-1">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input class="form-control" type="text" value="<?php echo $data[
    'email'
]; ?>" aria-label="Disabled input example" disabled readonly>
                                    </div>

                                    <div class="mb-1">
                                        <label for="exampleFormControlInput1" class="form-label">Category</label>
                                        <input class="form-control" type="text" value="<?php echo $data[
    'catename'
]; ?>" aria-label="Disabled input example" disabled readonly>
                                    </div>

                                    <div class="mb-1">
                                        <label for="exampleFormControlInput1" class="form-label">Order ID</label>
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" value="<?php echo $data[
    'order_id'
]; ?>" disabled readonly>
                                        <button class="btn btn-primary" type="button" name="detail" id="detail">Detail</button>
                                    </div>
                                    <!-- </form> -->


                                    <div class="mb-1">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input class="form-control" type="text" value="<?php echo $data[
    'tname'
]; ?>" aria-label="Disabled input example" disabled readonly>
                                    </div>
                                    <!-- <form method="post" action="" enctype="multipart/form-data"> -->
                                    <div class="form-group">
                                        <form action="" method="post">
                                        <input type="hidden" name="ticketid" value="<?php echo $id; ?>">
                                        <label for="exampleFormControlInput1" class="form-label">Assign to</label><br>
                                        <select class="form-select form-control mt-2" aria-label="Default select example" name="useroption" id="useroption" required>
                                        <?php userOption();?>
                                        </select>
                                        <button class="btn btn-danger float-right mt-2" type="submit" name="asign" id="asign">Assign</button></br></br>
                                        </form>
                                    </div>
                                    <?php
include 'function_asign.php';
if (isset($_POST['asign'])) {
    asign($_POST);
}
?>
	                                <!-- Tombol untuk menampilkan modal-->
                                    <?php
$joins = preg_split(
    '[,]',
    $data['id_join']
);
$join = ltrim($joins[0], '[');

if ($data['ticket_id'] != $join) {?>
                                        <div class="form-group">
                                    <!-- Tombol untuk menampilkan modal join-->
                                    <label>Merge Ticket to</label></br>
                                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#joinModal" onclick="join()">Merge</button>
                                    </div>
                                        <?php }
?>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <div class="" id="">
                                <div class="card scroll2 bg-light mb-3" style="max-height:400px">
                                    <div class="card-body">
                                        <div class="p-1 px-lg-1 border-bottom">
                                            <?php echo '<h5>' .
    $data['subject'] .
    '</h5>'; ?>
                                        </div>
                                        <?php
$datas = getTickets($_GET['id']);

for ($x = 0; $x < count($datas); $x++) {

    $attachment = '';
    $user_id = $_SESSION['user_id'];
    if ($datas[$x]['user_id'] == 0) {
        $style = 'float-left';
        $name = $datas[$x]['name'];
    } else {
        $style = 'float-right';
        $name = $datas[$x]['nameUser'];
    }
    if (
        $datas[$x]['attachment'] != ''
    ) {
        $attachment =
            "<img id='myImg' src='img/" .
            $datas[$x]['attachment'] .
            "' width='60' height='60'>";
    }
    ?>
                                        <div class="row">
                                            <div class="chat-conversation p-1">
                                                <div class="card mb-1 <?php echo $style; ?>" style="min-width: 60%;max-width: 80%;">
                                                    <div class="card-body">
                                                        <span class="text-muted float-left text-bold"><?=$name?></span>
                                                        <p class="card-text"><?php echo $datas[
        $x
    ]['message']; ?></p>
                                                        <?php echo $attachment; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
}
?>
                                    </div>
                                </div>
                            </div>
                            <?php
$joins = preg_split('[,]', $data['id_join']);
$join = ltrim($joins[0], '[');

if ($data['ticket_id'] != $join) {?>
                            <div class="chat" id="chat">
                                <form method="post" action="" enctype="multipart/form-data" id="ticketform">
                                    <div id="editor">
                                        <div class="form-group">
                                            <textarea class="editor" id="message" name="pesan" placeholder="Type here..."></textarea>
                                        </div>
                                    </div>
                                    <input class="form-control form-control-sm mt-2" type="file" name="berkas" accept="image/jpeg,image/png">
                                    <input type="hidden" name="id" value="<?php echo $_SESSION[
    'user_id'
]; ?>">
                                    <input type="hidden" name="tickId" value="<?php echo $id; ?>">
                                    <input type="hidden" name="orderid" value="<?php echo $data[
    'order_id'
]; ?>">
                                    <input type="hidden" name="emailto" value="<?php echo $data[
    'email'
]; ?>">
                                    <br>
                                    <div class="form-group">

                                        <select class="form-select form-control col-md-3" id="macro" aria-label="Default select example" name="kategori" required>
                                            <option selected>Macro</option>
                                            <?php macroOption();?>
                                        </select>
                                        </br>
                                        <!-- <span class="col-md-2" style="width:100%;">&nbsp;&nbsp;</span> -->

                                        <input type="hidden" name="aksi" id="aksi" />
                                        <button type="submit" name="solved" class="btn btn-success float-right mt-2" onclick="return ticketAction();">Solved</button>
                                        <button type="submit" name="reply" class="btn btn-primary float-right mt-2 mr-5" >Reply</button></br>
                                        <?php
include 'function_replay.php';
    if (isset($_POST['reply'])) {
        replay($_POST);
    }
    ?>
                                        <?php
include 'function_solved.php';
    if (isset($_POST['solved'])) {
        solved($_POST);
    }
    ?>
                                    </div>
                                </form>
                            </div>
                            <?php }
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <?php if (count($get['order_data']) >= 1): ?>
    <div id="Modal" class="modal modal-xl" role="dialog">
        <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- body modal -->
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Email:</label>
                            <input type="text" value="<?php echo $data_order[
    'email'
]; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Phone Number:</label>
                            <input type="text" value="<?php echo $data_order[
    'telephone'
]; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Address:</label>
                            <textarea class="form-control" rows="3" readonly><?php echo $data_order[
    'address_1'
]; ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">City:</label>
                            <input type="text" value="<?php echo $data_order[
    'shipping_city'
]; ?>"class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Province:</label>
                            <input type="text" value="<?php echo $data_order[
    'shipping_province'
]; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Shipping Method:</label>
                            <input type="text" value="<?php echo strip_tags(
    $data_order['shipping_method']
); ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Payment Method:</label>
                            <input type="text" value="<?php echo $data_order[
    'payment_method'
]; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Order Date:</label>
                            <input type="text" value="<?php echo date(
    'Y-m-d',
    strtotime($data_order['date_added'])
); ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Order Via:</label>
                            <input type="text" value="<?php echo $data_order[
    'ordervia'
]; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Last Status:</label>
                            <input type="text" value="<?php echo $data_order[
    'last_status'
]; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Total:</label>
                            <input type="text" value="<?php echo number_format(
    $data_order['total'],
    0,
    ',',
    '.'
); ?>" class="form-control" readonly>
                        </div>
                    </form></br>

                    <table class="table  table-bordered w-100 table-striped myTable">
                        <thead>
                            <tr class="text-center">
                            <!-- <td><input type="checkbox" onchange="checkAll(this)"></td> -->
                            <td><strong>ID Product</strong>
                            <td><strong>Model</strong></td>
                            <td><strong>Name</strong></td>
                            <td><strong>Quantity</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $dt): ?>
                            <tr>
                                <td><?=$dt['product_id']?></td>
                                <td><?=$dt['model']?></td>
                                <td><?=$dt['name']?></td>
                                <td><?=$dt['quantity']?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table></br>
                    <table class="table table-bordered w-100 table-striped myTable">
                        <thead>
                            <tr class="text-center">
                                <td><strong>History Date</strong></td>
                                <td><strong>Status</strong></td>
                                <td><strong>comment</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($histori as $dt): ?>
                            <tr>
                                <td><?=$dt['date_added']?></td>
                                <td><?=$dt['name']?></td>
                                <td><?=$dt['comment']?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary tutup" id="close" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>

    <!-- Modal -->
    <div id="joinModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <form  method="post" action="">
                <div class="modal-header">
                    <!-- <h4 class="modal-title">Bagian heading modal</h4> -->
                    <label>Enter ticket ID to merge into:</label></br></br>
                    <div class="col-md-3">
                    <input type="text" class="form-control ml-1" name="join_id" id="input_idticket" placeholder="Ticket Id" required>
                    <input type="hidden" id="ticketid" name="ticket_id" value="<?php echo $data[
    'ticket_id'
]; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-auto ml-1" name="merge" onclick="return confirm('Are you sure you want to join this ticket?')">Merge</button>
                </div>
                <?php
include 'function_merge.php';
if (isset($_POST['merge'])) {
    merge($_POST);
}
?>
                </form>
                <!-- body modal -->
                <!-- <div class="col-md-12"> -->
                <div class="modal-body">
                    <table class="table dTable table-bordered w-100 table-striped table-responsive table-to-join text-center">
                        <thead>
                            <tr>
                                <td width="5%"><strong> </strong></td>
                                <td width="5%"><strong>ID Ticket</strong></td>
                                <td width="20%"><strong>Email</strong></td>
                                <td width="20%"><strong>Subject</strong></td>
                                <td width="20%"><strong>Requester</strong></td>
                                <td width="20%"><strong>Date Added</strong></td>
                                <td width="20%"><strong>Date Modified</strong></td>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close bg-black tutup" id="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption">

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </div>

<!-- <?php include 'global_footer.php';?> -->
<!-- <footer class="main-footer sticky-footer ">
    <strong>Copyright &copy; 2014-2021 <a href="#">Grobdesk</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
</footer> -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


<script>

// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.querySelectorAll("img#myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
for (let x = 0; x < img.length; x++) {
    const element = img[x];

    element.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
}

$("#detail").click(function(){
    $("#Modal").show();
});

// $("#join").click(function(){
//     $("#joinModal").show();
// });

$(document).ready(function(){
    $("#detail").prop('disabled',false);
    var cek = $("input[name='cek']").val();
    console.log(cek);
    if (cek <= 0) {
        $("#detail").prop('disabled',true);
    } else {
        $("#detail").prop('disabled',false);
    }
});


// Get the <span> element that closes the modal
$(".tutup").each(function(){

    var prnt = $(this).parent();
    var cek = 5;
    for (let x = 0; x < cek; x++) {
        if($(prnt).hasClass("modal") == false){
            prnt = $(prnt).parent();
        } else {
            x=5;
        }
    }

    $(this).click(function(){
        $(prnt).hide();
        // prnt.style.display = "none";
    })
});

$("#macro").change(function (){
    //$("#tinymce").html($(this).val());
    // prnt$(this).val().insertAfter( "#tinymce" );
    tinyMCE.activeEditor.setContent($(this).val());
})

// When the user clicks on <span> (x), close the modal

$(document).ready(function() {
    $("#macro").select2({
        width: 'resolve' // need to override the changed default
    });
});

function ticketAction(){
    var question = confirm('Are you sure you want to solved this ticket?');
    if(question==true){
        return true;
    }else{
        return false;
    }
}

function join(){
    $('.table-to-join').DataTable().destroy();
    $('.table-to-join').DataTable({
        "processing": true,
        "serverSide": true,
        "filter": true,
        bAutoWidth: false,
        // sScrollX: "100%",
        lengthMenu: [
          [5, 10, 25, 50, -1],
          [5, 10, 25, 50, 100, 'All'],
        ],
        "ajax": {
          "url": "ajax/ajax_joinmodal.php?action=table_data",
          "dataType": "json",
          "type": "POST",
          'data': function(data) {
            // Read values
            let date = $('#date').val();
            let toDate = $('#to_date').val();
            let ticket_id = $('#ticketid').val();

            data.searchByDate = date;
            data.toDate = toDate;
            data.ticket_id = ticket_id ;
          }
        },
        // "dataSrc": function(json){
        //   return json.data;
        // },
        "columns": [{
            data: "action"
          },
          {
            data: "ticket_id"
          },
          {
            data: "email"
          },
          {
            data: "subject"
          },
          {
            data: "requester"
          },
          {
            data: "date_added"
          },
          {
            data: "date_modified"
          },
        ],
        columnDefs: [
            { "width": "100px", "targets": [0] },
            { "width": "150px", "targets": [1] },
            { "width": "200px", "targets": [2] },
            { "width": "200px", "targets": [3] },
            { "width": "200px", "targets": [4] },
            { "width": "150px", "targets": [5] },
        ]
    });
}

$("#useroption").change(function (){
    //$("#tinymce").html($(this).val());
    // prnt$(this).val().insertAfter( "#tinymce" );
    tinyMCE.activeEditor.setContent($(this).val());
})

$(document).ready(function() {
    $("#useroption").select2({
        width: 'resolve' // need to override the changed default
    });
});


// console.log($('#textarea_id').tinymce().save());
// $(document).ready(function() {

//     $("#asign").click(function() {
//         tinyMCE.triggerSave();
//         var ticketid = $('input[name=ticketid]').val();
//         var useroption = $('#useroption').val();
//         var mydata = {
//             ticketid:ticketid,
//             useroption:useroption,
//         }
//         // console.log(mydata);
//         $.ajax({
//             url : 'asign.php',
//             method: 'GET',
//             data: mydata,
//             success: function(data) {
//                 // var get = JSON.parse(data);
//                 // console.log(get);
//                 //alert(data.message);
//                 if (data.message == 'gagal') {
//                     alert("Gagal !!!"+data.data)
//                 } else {
//                     alert("pesan terkirim")
//                     //menurut pembimbing kami dilapangan harusnya tdk menggunakan location.reload diganti dgn url yg sedang dibuka
//                     location.reload();
//                     //<meta http-equiv="refresh" content="0; url=detail_ticket.php">
//                 }
//             }
//         })

//     });



//     // $('.dTable').DataTable({
//     //   "paging": true,
//     //   "lengthChange": true,
//     //   "searching": true,
//     //   "ordering": true,
//     //   "info": true,
//     //   "autoWidth": true,
//     //   // "responsive": true,
//     //   lengthMenu: [
//     //         [5, 25, 50, -1],
//     //         [5, 25, 50, 100, 'All'],
//     //     ],
//     // });
// })
function mergeThis(id){
    // alert(id);
    $("#input_idticket").val(id);
}

</script>

</body>
</html>