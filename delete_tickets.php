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
  <title>Delete Tickets</title>
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
              <h1 class="m-0">Delete Tickets</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Delete Tickets </li>
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
                <table class="table dTable table-bordered w-100 table-striped">
                  <thead>
                    <tr>
                      <td><strong>No</strong></td>
                      <td><strong>Category</strong></td>
                      <td><strong>Subject</strong></td>
                      <td><strong>Requester</strong></td>
                      <td><strong>Requested</strong>
                      <td><strong>Latest Updater</strong></td>
                      <td>
                        </>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
// include 'function_ticket.php';
// getdeleteTickets();
?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->

  </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include 'global_footer2.php';?>

  <script>
    $(function() {
      // $('.table').DataTable();
      // $(document).ready(function(){
      let dataTable = $('.table').DataTable({
        "processing": true,
        "serverSide": true,
        lengthMenu: [
          [5, 10, 25, 50, -1],
          [5, 10, 25, 50, 100, 'All'],
        ],
        "ajax": {
          "url": "ajax/ajax_delete.php?action=table_data",
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