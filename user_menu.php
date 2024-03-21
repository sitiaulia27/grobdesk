<!DOCTYPE html>
<html>
<?php
include 'function_log.php';
include 'function_user.php';
isLoggedIn();
?>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include 'global_head.php';
// include 'function_user.php';
?>
  <title>User Menu</title>
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

        <!-- Sidebar Menu -->
        <!-- <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> -->
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
              <!-- <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="input.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add User</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav> -->
        <!-- /.sidebar-menu -->
      <!-- </div> -->
      <!-- /.sidebar -->
    <!-- </aside> -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="dt mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Manage Users</h1>
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
<?php //include 'function_user.php';
if (isset($_GET['pesan'])) {
    $pesan = $_GET['pesan'];
    if ($pesan == 'input') {
        'Data Success to Input.';
    } elseif ($pesan == 'update') {
        'Data Success to Update.';
    } elseif ($pesan == 'delete') {
        'Data Success to Delete.';
    }
} ?>
<div class="dt">
          <div class="col-md-12">
            <div class="card" style="width:100%;">
              <div class="card-header">
              <div class="d-flex justify-content-between">
                  <a href="user_add.php" data-bs-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp Add User</a>
                </div>
              </div>

                <div class="card-body">
                <table class="table dTable table-bordered w-100 table-striped table-responsive">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th width="1%">NAME</th>
                      <th>EMAIL</th>
                      <th>ROLE</th>
                      <th>STATUS</th>
                      <th width="15%">OPSI</th>
                    </tr>
                  </thead>
                  <tbody>
<?php readUser(); ?>

<?php
$data = data_usermenu();
// var_dump($data);
foreach ($data as $dt) { ?>
            <tr>
             <td><?php echo $dt['name']; ?></td>
             <td><?php echo $dt['email']; ?></td>
             <td><?php echo $dt['rolname']; ?></td>
             <td><?php echo $dt['status']; ?></td>
             <td>
               <?php if ($dt['user_id'] != 0) { ?>
                <a class="btn btn-warning btn-sm" href="user_update.php?id=<?= $dt[
                    'user_id'
                ] ?>"><i class="fa fa-edit"></i>edit</a>
                <a class="btn btn-danger btn-sm" href="user_delete.php?id=<?= $dt[
                    'user_id'
                ] ?>" onclick="return confirm('Are you sure you want to delete this data?')"><i class="fa fa-trash"></i> delete</a>
               <?php } ?>
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