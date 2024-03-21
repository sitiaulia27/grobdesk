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
include 'config.php';

if (isset($_POST['submit'])) {
    createCategory($_POST);
}
?>
  <title> Kategori </title>
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
              <h1 class="m-0">Add category</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form action="" method="post">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="enabled">Enabled</option>
                      <option value="disabled">Disabled</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control">
                  </div>
                  <input class="btn btn-primary" type="submit" name="submit" value="Add">
									<a class="btn btn-secondary" href="category_index.php">Back</a>
                  <!-- <div class="form-group">
                    <a class="btn btn-secondary" href="category_index.php">Back</a>
                    <button class="btn btn-primary float-right" name="tambah">Add</button>
                  </div> -->


                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'global_footer.php';?>
</body>

</html>