<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
include 'function_user.php';
isLoggedIn();
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Update</title>
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
							<h1 class="m-0">Update Data User</h1>
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
							<?php
$id = $_GET['id'];
$data = update_user($id);
?>

																	<form action="user_update_post.php" class="form-horizontal" method="post">
																		<input type="hidden" name="id" value="<?php echo $data['user_id']; ?>">
																		<div class="form-group row">
																			<label for="name" class="col-sm-2 col-form-label">Name</label>
																			<div class="col-sm-10">
																				<input class="form-control" type="text" name="name" value="<?php echo $data[
    'usname'
]; ?>">
																			</div>
																		</div>
																		<div class="form-group row">
																			<label for="email" class="col-sm-2 col-form-label">Email</label>
																			<div class="col-sm-10">
																				<input class="form-control" type="text" name="email" value="<?php echo $data[
    'email'
]; ?>">
																			</div>
																		</div>
																		<div class="form-group row">
																			<label for="role_id" class="col-sm-2 col-form-label">Role</label>
																			<div class="col-sm-10">
																			<select class="form-control" name="role_id">
																			<?php role_user($data['role_id']);
?>



											  </select>
																			<!-- <input class="form-control" type="text" name="role_id" value="<?php
//echo $data['role_id'];
?>"> -->
																			</div>
																		</div>
																		<div class="form-group row">
																			<label for="password" class="col-sm-2 col-form-label">Password</label>
																			<div class="col-sm-10">
																				<input class="form-control" type="password" name="password">
																			</div>
																		</div>
																		<div class="form-group row">
																			<label for="cfm_password" class="col-sm-2 col-form-label">Confirm Password</label>
																			<div class="col-sm-10">
																				<input class="form-control" type="password" name="cfm_password">
																			</div>
																		</div>
																		<div class="form-group row">
																			<label for="status" class="col-sm-2 col-form-label">Status</label>
																			<div class="col-sm-10">
																			<select class="form-control" name="status">
																			<option value="enabled"<?php echo $data == 'enabled'
? 'selected="selected"'
: ''; ?>>Enabled</option>
									                            <option value="disabled"<?php echo $data ==
'disabled'
? 'selected="selected"'
: ''; ?>>Disabled</option>
											</select>
																			<!-- <select name="status" class="form-control" value="<?php
//echo $data['status'];
?>"></select> -->
																			<!-- <select name="status" class="form-control">
																					<option value="enabled" class="form-control">Enabled</option>
																					<option value="disabled" class="form-control">Disabled</option>
																				</select> -->
																			</div>
																		</div>
																		<input class="btn btn-primary" type="submit" value="Save">
																		<a class="btn btn-secondary" href="user_menu.php">Back</a>
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

	<!-- <script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	</script> -->
	<?php include 'global_footer.php';?>
</body>
</html>