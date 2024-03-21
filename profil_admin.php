<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
include 'function_profiladmin.php';
isLoggedIn();
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Profil</title>
	<?php include 'global_head.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

	<?php include 'global_header.php'; ?>
	<?php include 'global_sidebar.php'; ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<!-- <h1 class="m-0">Update Data Admin</h1> -->
              <h1 class="m-0">Admin Profil</h1>
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
							<h5>Data</h5>
						</div>
						<div class="card-body">
							<?php
       $id = $_SESSION['user_id'];
       $data = profil_admin($id);
       ?>
								<form action="admin_update_post.php" class="form-horizontal" method="post">
									<input type="hidden" name="id" value="<?php echo $data['user_id']; ?>">
									<div class="form-group row">
										<label for="name" class="col-sm-2 col-form-label">Name</label>
										<div class="col-sm-10">
											<input class="form-control" type="text" name="name" value="<?php echo $data[
               'name'
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
										<label for="password" class="col-sm-2 col-form-label">Password</label>
										<div class="col-sm-10">
											<input class="form-control" type="password" name="password" placeholder="---empty if you don't want to change---">
										</div>
									</div>
									<div class="form-group row">
										<label for="cfm_password" class="col-sm-2 col-form-label">Confirm Password</label>
										<div class="col-sm-10">
											<input class="form-control" type="password" name="cfm_password" placeholder="---empty if you don't want to change---">
										</div>
									</div>
									<div class="form-group row">
										<label for="signature" class="col-sm-2 col-form-label">Signature</label>
										<div class="col-sm-10">
										<textarea class="form-control" name="signature"><?php echo $data[
              'signature'
          ]; ?> </textarea>
										</div>
									</div>
									<!-- <div id="editor">
                    <div class="input">
                    </div> 
                  </div> -->
									<!-- <div class="form-group row">
										<label for="status" class="col-sm-2 col-form-label">Status</label>
										<div class="col-sm-10">
											<select name="status" class="form-control">
												<option value="enabled" class="form-control">Enabled</option>
												<option value="disabled" class="form-control">Disabled</option>
											</select>
										</div>
									</div> -->
									<!-- <div class="form-group row">
										<label for="signature" class="col-sm-2 col-form-label">Photo</label>
										<div class="col-sm-10">
											<input class="form-control form-control-sm mt-2" type="file" name="berkas" accept="image/jpeg,image/png">
										</div>
									</div> -->
									<input class="btn btn-primary" type="submit" value="Save">
									<!-- <a class="btn btn-secondary" href="user_menu.php">Back</a> -->
								</form>
							<!-- <?php
//endwhile;
?> -->
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

	
	<?php include 'global_footer.php'; ?>
</body>
</html>