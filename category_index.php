<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
isLoggedIn();
?>

<head>
  <?php
  include 'global_head.php';
  include 'function_category.php';
  $query_category = readCategory();
  ?>
  <title>Category</title>
  <style>
    .icon {
      margin-left: 1050px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper" id="ticket">

    <!-- Navbar -->
    <?php include 'global_header.php'; ?>
    <?php include 'global_sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Category Ticket</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between">

                  <a href="category_add.php" data-bs-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp Add category</a>
                </div>
              </div>
              <div class="card-body">
                <table class="table dTable table-bordered w-100 table-striped table-responsive">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th width="1%">NO</th>
                      <th>NAME</th>
                      <th width="15%">OPSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include 'config.php';
                    $no = 1;

                    while (
                        $fetch_category = mysqli_fetch_assoc($query_category)
                    ) { ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $fetch_category['name']; ?></td>
                        <td>
                          <?php if (
                              $fetch_category['category_ticket_id'] != 0
                          ) { ?>
                            <a class="btn btn-warning btn-sm" href="category_update.php?id=<?= $fetch_category[
                                'category_ticket_id'
                            ] ?>"><i class="fa fa-edit"></i>edit</a>
                            <a class="btn btn-danger btn-sm" href="category_delete.php?id=<?= $fetch_category[
                                'category_ticket_id'
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
</body>
</html>