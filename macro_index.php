<!DOCTYPE html>
<html>
<?php
include 'function_log.php';
include 'function_macro.php';
isLoggedIn();
?>

<head>

  <?php include 'global_head.php';
// include 'function_user.php';
?>
  <title>Macro</title>
  <style>
    .icon {
      margin-left: 1050px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper" id="ticket">

<!-- Navbar -->
<body>
<?php include 'global_header.php'; ?>
<?php include 'global_sidebar.php'; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="dt mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Macro</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
          </div>
          </div><!-- /.dt -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <!-- <section class="content"> -->
        <div class="container-fluid">
<?php
include 'function_user.php';
if (isset($_GET['pesan'])) {
    $pesan = $_GET['pesan'];
    if ($pesan == 'input') {
        'Data Success to Input.';
    } elseif ($pesan == 'update') {
        'Data Success to Update.';
    } elseif ($pesan == 'delete') {
        'Data Success to Delete.';
    }
}
?>
<div class="dt">
          <div class="col-sm-12">
            <div class="card" style="width:100%;">
              <div class="card-header">
              <div class="d-flex justify-content-between">
                  <a href="macro_add.php" data-bs-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp Add Macro</a>
                </div>
              </div>

                <div class="card-body">
                <table class="table dTable table-bordered w-100 table-striped table-responsive">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th width="1%">NAME</th>
                      <!-- <th>NAME</th> -->
                      <th>TEXT</th>
                      <th>STATUS</th>
                      <th width="15%">OPSI</th>
                    </tr>
                  </thead>
                  <tbody>

<?php
$data = macro_index();
foreach ($data as $dt) { ?>
            <tr>
             <td><?php echo $dt['macro_name']; ?></td>
             <td><?php echo $dt['macro_text']; ?></td>
             <td><?php echo $dt['status']; ?></td>
             <td>
                <a class="btn btn-warning btn-sm" href="macro_edit.php?id=<?= $dt[
                    'macro_id'
                ] ?>"><i class="fa fa-edit"></i>edit</a>
                <a class="btn btn-danger btn-sm" href="macro_delete.php?id=<?= $dt[
                    'macro_id'
                ] ?>" onclick="return confirm('Are you sure you want to delete this data?')"><i class="fa fa-trash"></i>delete</a>
             </td>
            </tr>
        <?php }
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
  <?php include 'global_footer.php'; ?>

	<!-- ./wrapper -->

</body>

</html>