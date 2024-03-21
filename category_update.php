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

$id = $_GET['id'];
if (!$id) {
    echo header('Location: category_index.php');
}

if (isset($_POST['submit'])) {
    updateCategory($id, $_POST);
}
?>
  <title> Kategori </title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper" id="ticket">

    <!-- Navbar -->
    <?php include 'global_header.php';?>
    <?php include 'global_sidebar.php';?>

    <?php
$id = $_GET['id'];
$category = data_update($id);
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Edit Category</h1>
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
                    <input type="text" name="name" class="form-control" value="<?=$category[
    'name'
]?>">
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option <?php if (
    $category['status'] === 'enabled'
): ?> selected <?php endif;?> value="enabled">Enabled</option>
                      <option <?php if (
    $category['status'] === 'disabled'
): ?> selected <?php endif;?> value="disabled">Disabled</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?=$category[
    'sort_order'
]?>">
                  </div>
                  <input class="btn btn-primary" type="submit" name="submit" value="Save">
									<a class="btn btn-secondary" href="category_index.php">Back</a>
                  <!-- <div class="form-group">
                    <a class="btn btn-secondary" href="category_index.php">Back</a>
                    <button class="btn btn-primary float-right" name="simpan">Save</button>
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