<!DOCTYPE html>
<html>
<?php
include 'function_log.php';
include 'function_role.php';
isLoggedIn();
?>

<head>
    <!-- <meta charset="utf-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <?php include 'global_head.php';?>
    <title>Edit Access</title>
</head>


<!-- <?php
//function prm_group()
// {
//     include 'config.php';
//     $prm = 'SELECT prm_group FROM m_prm GROUP by prm_group';
//     $group = mysqli_query($conn, $prm);
//     while ($r = mysqli_fetch_array($group, MYSQLI_ASSOC)) {
//         //mendapatkan id dari url yang dikirim, menggunakan method GET:
//         $id = isset($_GET['id']) ? $_GET['id'] : '';
//         //membuat query tampil data berdasarkan id yang dipilih
//         $query2 = mysqli_query(
//             $conn,
//             "SELECT * FROM m_role WHERE role_id='$id'"
//         );
//         while ($data = mysqli_fetch_array($query2)) {
//             //membuat variabel untuk menampung data
//             $role_acces = $data['role_acces'];
//         }
//         $split = str_split($role_acces);

//         $getquery =
//             "SELECT  * FROM m_prm WHERE prm_group='" .
//             $r['prm_group'] .
//             "' ORDER BY prm_name ASC";
//         $hasil = mysqli_query($conn, $getquery);
//         echo '<p>' . $r['prm_group'] . '</p>';
//         while ($getdata2 = mysqli_fetch_array($hasil, MYSQLI_ASSOC)) {
//             if (array_search($getdata2['prm_id'], $split) != null) {
//                 echo "<input type='checkbox'name='permission[]' value='$getdata2[prm_id]' checked/>$getdata2[prm_name]<br/>";
//             } else {
//                 echo "<input type='checkbox'name='permission[]' value='$getdata2[prm_id]'/>$getdata2[prm_name]<br/>";
//             }
//         }
//         echo '<p>&nbsp;</p>';
//     }
//}
?> -->

<?php
$id = $_GET['id'];
$data = data_editrole($id);
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    <!-- Navbar -->
    <?php include 'global_header.php';?>
    <?php include 'global_sidebar.php';?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Access</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
             <!-- <a href="roleMenu.php" class="btn btn-info btn-sm"><i class="fa fa-reply"></i>&nbsp</a></br> -->
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <form action="" method="post">
                    <!-- <input type="hidden" name="id" value="<?php echo $data[
    'role_id'
]; ?>"> -->
                      <!-- <div class="box-body"> -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <!-- <input type="text" name="name" class="form-control"> -->
                            <!-- <div class="col-sm-10"> -->
								<input class="form-control" type="text" name="name" value="<?php echo $data[
    'name'
]; ?>">
							<!-- </div> -->
                        <!-- </div> -->
                      </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" value="" class="form-control">
                            <option value="enabled"<?php echo $data == 'enabled'
? 'selected="selected"'
: ''; ?>>Enabled</option>
                            <option value="disabled"<?php echo $data ==
'disabled'
? 'selected="selected"'
: ''; ?>>Disabled</option>
                        </select>
                    </div>

                            <div class="form-group">
                                <label for="status">Permissions</label>
                                    <!-- <div class="col-lg-8"> -->
                                    <div id="user-group-permission" class="form-control" style="height: 88%;">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                <?php prm_group2();?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                                <!-- </div> -->
                                <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <button type="submit" name="update" class="btn btn-primary">Save</button>
                                    <a class="btn btn-secondary" href="roleMenu.php">Back</a>
                                </div>
                        <!-- </div> -->
                    </form>
                <?php
//}
?>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>

<?php
include 'config.php';
// include 'function_role.php';
if (isset($_POST['update'])) {
    updateRole($_POST);
}
?>
<?php include 'global_footer.php';?>
</body>
</html>