<?php
function readRole()
{
    include 'config.php';
    $sql_role = 'SELECT * FROM m_role';
    $query_role = mysqli_query($conn, $sql_role);
    return $query_role;
}

function addRole($post)
{
    include 'config.php';
    $name = $post['name'];
    $status = $post['status'];
    $permission = $post['permission'];
    $perm = json_encode($permission);

    if (!$name) {
        echo '<script> alert("Failed Role Acces Added!")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
    } else {
        $sql_role = "INSERT INTO m_role (name, status, role_acces) VALUES ('$name', '$status', '$perm')";
        $query_role = mysqli_query($conn, $sql_role);
        if ($query_role) {
            echo '<script> alert("Role Acces Add Successfuly!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
        }
    }
}

function updateRole($post)
{
    include 'config.php';
    $id = $_POST['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $permission = $_POST['permission'];
    $perm = json_encode($permission);
    $query3 = mysqli_query(
        $conn,
        "UPDATE m_role SET name='$name', status='$status', role_acces='$perm' WHERE role_id=$id"
    );
    if ($query3) {
        echo "
                <script>
                alert('Role Acces Update Successfully!');
                window.location.href = 'roleMenu.php';
                </script>
                ";
    } else {
        echo "
                <script>
                alert('Role Acces Failed to Update!');
                window.location.href = 'roleEdit.php';
                </script>";
    }
}

function deleteRole($id)
{
    include 'config.php';
    $query = "SELECT * FROM m_user WHERE role_id='$id'";
    $c = mysqli_query($conn, $query);
    if ($c->num_rows < 1) {
        $query2 = mysqli_query($conn, "DELETE FROM m_role WHERE role_id='$id'");
        if ($query2) {
            echo '<script type="text/javascript">';
            echo 'alert("Role Delete Successfully!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Role Delete Failed!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Role Delete Failed! a user still using this role")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
    }
}

function prm_group()
{
    include 'config.php';
    $prm = 'SELECT prm_group FROM m_prm GROUP by prm_group';
    $group = mysqli_query($conn, $prm);
    while ($r = mysqli_fetch_array($group, MYSQLI_ASSOC)) {
        $getquery =
            "SELECT  * FROM m_prm WHERE prm_group='" .
            $r['prm_group'] .
            "' ORDER BY prm_name ASC";
        $hasil = mysqli_query($conn, $getquery);
        echo '<p>' . $r['prm_group'] . '</p>';
        while ($getdata2 = mysqli_fetch_array($hasil, MYSQLI_ASSOC)) {
            echo "<input type='checkbox'name='permission[]' value='$getdata2[prm_id]'/>$getdata2[prm_name]<br/>";
        }
        echo '<p>&nbsp;</p>';
    }
}

function prm_group2()
{
    include 'config.php';
    $prm = 'SELECT prm_group FROM m_prm GROUP by prm_group';
    $group = mysqli_query($conn, $prm);
    $perms = '';
    $i = 0;
    while ($r = mysqli_fetch_array($group, MYSQLI_ASSOC)) {
        //mendapatkan id dari url yang dikirim, menggunakan method GET:
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        //membuat query tampil data berdasarkan id yang dipilih
        $query2 = mysqli_query(
            $conn,
            "SELECT * FROM m_role WHERE role_id='$id'"
        );
        while ($data = mysqli_fetch_array($query2)) {
            //membuat variabel untuk menampung data
            $role_acces = $data['role_acces'];
        }
        $split = str_split($role_acces);

        $getquery =
            "SELECT  * FROM m_prm WHERE prm_group='" .
            $r['prm_group'] .
            "' ORDER BY prm_name ASC";
        $hasil = mysqli_query($conn, $getquery);

        $prm = '';
        while ($getdata2 = mysqli_fetch_array($hasil, MYSQLI_ASSOC)) {
            if (array_search($getdata2['prm_id'], $split) != null) {
                $prm .= "<input type='checkbox'name='permission[]' value='$getdata2[prm_id]' checked/>$getdata2[prm_name]<br/>";
            } else {
                $prm .= "<input type='checkbox'name='permission[]' value='$getdata2[prm_id]'/>$getdata2[prm_name]<br/>";
            }
        }
        $perms .= '<p>' . $r['prm_group'] . '</p>' . $prm . '<p>&nbsp;</p>';
        // $perms[] = $role[$i] . $prm . $end;
        $i++;
    }
    $output = $perms;
    echo $output;
}

function data_editrole($id)
{
    include 'config.php';
    $data = [];
    $id = $_GET['id'];
    //membuat query tampil data berdasarkan id yang dipilih
    $query2 = mysqli_query($conn, "SELECT * FROM m_role WHERE role_id=$id");
    $data = mysqli_fetch_array($query2);
    return $data;
}

function data_rolemenu()
{
    include 'config.php';
    $data = [];
    $query = mysqli_query($conn, 'SELECT * FROM m_role');
    while ($get = mysqli_fetch_assoc($query)) {
        $id = $get['role_id'];
        $name = $get['name'];
        $data[] = ['id' => $id, 'name' => $name];
    }
    return $data;
}

?>
