<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
isLoggedIn();
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Input User</title>
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
							<h1 class="m-0">Add Macro</h1>
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
							<h5>Input Data</h5>
						</div>
						<div class="card-body">
							<form action="#" class="form-horizontal" method="post">
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Name</label>
									<div class="col-sm-10">
										<input class="form-control" type="text" name="macro_name">
									</div>
								</div>
								<div class="form-group row">
									<label for="text" class="col-sm-2 col-form-label">Text</label>
									<div class="col-sm-10">
										<textarea class="form-control" type="text" name="macro_text"></textarea>
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
								<input class="btn btn-primary" type="submit" name="add" value="Add">
								<a class="btn btn-secondary" href="macro_index.php">Back</a>
							</form>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- ./wrapper -->
    <?php if (isset($_POST['add'])) {
    include 'function_macro.php';
    addMacro($_POST);
}?>
	<?php include 'global_footer.php';?>

	<!-- <script>
    $(document).ready(function () {
    $('#example2').DataTable();
	});
	</script> -->

</body>
</html>