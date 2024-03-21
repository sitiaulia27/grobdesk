<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
isLoggedIn();
?>

<head>
  <?php
include 'global_head.php';
?>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"> -->
  <title> Unassigned Tickets</title>
  <style>
    .icon {
      margin-left: 1050px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper" id="ticket">

    <!-- Navbar -->
    <?php include 'global_header.php';?>
    <?php include 'global_sidebar.php';?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Unassigned Tickets</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Unassigned Tickets</li>
            </ol>
          </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form action="" id="formFilter" method="post">
                  <div class="row">
                    <div class="col-md-12">
                    <label for="">Date Filter</label><br>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-3">
                      <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">From</label>
                        <div class="col-sm-9">
                        <input type="date" class="form-control" id="date" name="date">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 ml-4">
                      <div class="form-group row">
                        <label for="to_date" class="col-md-2 col-form-label">To</label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" id="to_date" name="to_date">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <button class="btn btn-secondary">Filter</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- <div class="card-header">
                <div class="d-flex justify-content-between">
                </div>
              </div> -->
              <div class="card-body">
                <table class="table dTable table-bordered w-100 table-striped table-responsive">
                  <thead>
                    <tr>
                    <th width="1%"><strong>No</strong></th>
                      <th width="15%"><strong>Category</strong></th>
                      <th width="20%"><strong>Subject</strong></th>
                      <th width="15%"><strong>Requester</strong></th>
                      <th width="15%"><strong>Requested</strong></th>
                      <th width="20%"><strong>Latest Updater</strong></th>
                      <th width="20%"><strong>Action</strong></th>

                    </tr>
                  </thead>
                  <tbody>
                    <!-- <?php
// include 'function_ticket.php';
// unassignedTickets();
?> -->
                  </tbody>
                </table>
                </td>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script> -->

    <!-- /.content -->

  </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include 'global_footer2.php';?>

  <script>
    $(function() {
      // $('.table').DataTable();
      // $(document).ready(function(){
     let dataTable =  $('.table').DataTable({
        "processing": true,
        "serverSide": true,
        lengthMenu: [
          [5, 10, 25, 50, -1],
          [5, 10, 25, 50, 100, 'All'],
        ],
        "ajax": {
          "url": "ajax/ajax_unassigned.php?action=table_data",
          "dataType": "json",
          "type": "POST",
          'data': function(data) {
            // Read values
            let date = $('#date').val();
            let toDate = $('#to_date').val();

            data.searchByDate = date;
            data.toDate = toDate;
          }
        },
        // "dataSrc": function(json){
        //   return json.data;
        // },
        "columns": [{
            data: "no"
          },
          {
            data: "category"
          },
          {
            data: "subject"
          },
          {
            data: "requester"
          },
          {
            data: "requested"
          },
          {
            data: "latestupdater"
          },
          {
            data: "aksi"
          },
        ],
      });
      $('#formFilter').on('submit',function (e) {
          e.preventDefault();
          dataTable.ajax.reload();
      })
    });
  </script>
</body>

</html>