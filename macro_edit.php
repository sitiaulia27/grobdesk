<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
include 'function_macro.php';
isLoggedIn();
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Macro Update</title>
	<?php include 'global_head.php';?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

	<?php include 'global_header.php';?>
	<?php include 'global_sidebar.php';?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Update Macro</h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="card">
						<div class="card-header">
							<h5>Update Data Macro</h5>
						</div>
						<div class="card-body">
							<?php
$id = $_GET['id'];
$data = macro_edit($id);
?>
								<form action="" method="post">
									<input type="hidden" name="id" value="<?php echo $data['macro_id']; ?>">
									<div class="form-group row">
										<label for="name" class="col-sm-2 col-form-label">Name</label>
										<div class="col-sm-10">
											<input class="form-control" type="text" name="macro_name" value="<?php echo $data[
    'macro_name'
]; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="text" class="col-sm-2 col-form-label">Text</label>
										<div class="col-sm-10">
											<textarea class="form-control" type="text" name="macro_text"><?php echo $data[
    'macro_text'
]; ?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="status" class="col-sm-2 col-form-label">Status</label>
										<div class="col-sm-10">
											<select name="status" class="form-control">
												<option value="enabled" class="form-control">Enabled</option>
												<option value="disabled" class="form-control">Disabled</option>
											</select>
										</div>
									</div>
									<input class="btn btn-primary" type="submit" value="Save" name="update">
									<a class="btn btn-secondary" href="macro_index.php">Back</a>
								</form>
							<?php
//endwhile;
?>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

        <?php if (isset($_POST['update'])) {
    updateMacro($_POST);
}?>
	<?php include 'global_footer.php';?>
</body>
</html>