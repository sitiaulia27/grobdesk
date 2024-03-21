<?php

// function list_user()
// {
//     include('config.php');
//     // $id = $_GET('id');
//     $get = "SELECT * FROM m_user";

// $query = mysqli_query($conn, $get);
// while ($row = mysqli_fetch_assoc($query)) {
//     echo "<tr>";
//     echo "<td>" . $row['name'] . "</td>";
//     echo "<td>" . $row['email'] . "</td>";
//     echo "<td>" . $row['status'] . "</td>";
//     echo "<td>";
//     echo "<a class=btn&#32btn-sm&#32mx-1&#32btn-warning href=user_update.php?id=" . $row['user_id'] . "><i class=fa fa-edit></i>Edit</a>";
//     echo "<a class=btn&#32btn-sm&#32mx-1&#32btn-danger href=user_delete.php?id=" . $row['user_id'] . ">Hapus</a></td>";
//     echo "</tr>";
// }
// }

function createUser($post)
{
    include 'config.php';
    include 'function_encryption.php';
    $name = $post['name'];
    $email = $post['email'];
    $password = $post['password'];
    $role_id = $post['role_id'];
    $pass = encrypt_password($password);

    $salt = $pass['salt'];
    $hash = $pass['hash'];

    if (!$name || !$email || !$password) {
        echo "
                <script>
                    alert('Failed User Add!');
                </script>
            ";
        echo '<meta http-equiv="refresh" content="0; url=input.php" />';
    } else {
        $sql_input = "INSERT INTO m_user (name, email, salt, password, role_id) VALUES ('$name', '$email', '$salt', '$hash', '$role_id')";

        $query_input = mysqli_query($conn, $sql_input);
        if ($query_input) {
            echo "
                <script>
                    alert('Success User Add!');
                </script>";
            echo '<meta http-equiv="refresh" content="0; url=user_menu.php" />';
        } else {
            echo "
                <script>
                    alert('Failed User Add!');
                </script>";
            echo '<meta http-equiv="refresh" content="0; url=input.php" />';
            echo mysqli_error($conn);
        }
    }
}

function readUser()
{
    include 'config.php';
    $sql_user = 'SELECT * FROM m_user';
    $query_user = mysqli_query($conn, $sql_user);
    return $query_user;
}

function updateUser($post)
{
    include 'config.php';
    include 'function_encryption.php';
    $name = $post['name'];
    $email = $post['email'];
    $password = $post['password'];
    $cfm_password = $post['cfm_password'];
    $status = $post['status'];
    $role_id = $post['role_id'];
    $pass = encrypt_password($password);
    $id = $post['id'];
    $salt = $pass['salt'];
    $hash = $pass['hash'];

    if (!$name || !$email || !$status) {
        echo "
                <script>
                    alert('User Failed to Update!');
                </script>";

        echo '<meta http-equiv="refresh" content="0; url=menu_user.php" />';
    } else {
        if (!empty($password)) {
            $sql_user = "UPDATE m_user SET name='$name', email='$email', salt='$salt', password='$hash', status='$status', role_id='$role_id' WHERE user_id='$id'";
        } else {
            $sql_user = "UPDATE m_user SET name='$name', email='$email', status='$status', role_id='$role_id' WHERE user_id='$id'";
        }
        $query_user = mysqli_query($conn, $sql_user);
        if ($query_user) {
            echo "
                        <script>
                            alert('User Success to Update!');
                        </script>";
        }
        echo '<meta http-equiv="refresh" content="0; url=user_menu.php" />';
    }
}

function deleteUser($id)
{
    include 'config.php';
    $query_user = mysqli_query($conn, "DELETE FROM m_user WHERE user_id='$id'");

    if ($query_user) {
        echo "
            <script>
                alert('User data Deleted Successfully!');
                window.location.href = 'user_menu.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Category Failed to Delete!');
                window.location.href = 'user_menu.php';
            </script>";
    }
}

// function deleteUser($id)
// {
//     include('config.php');
//     $query_user = mysqli_query($conn, "DELETE FROM m_user WHERE user_id='$id'");

//     if ($query_user) {
//         echo "
//         <script>
//             alert('User Failed to Delete!');
//             location:'user_menu.php';
//         </script>";
//     } else {
//         echo "
//         <script>
//             alert('User Success to Delete!');
//         </script>";
//         echo '<meta http-equiv="refresh" content="0; url=user_menu.php" />';
//     }
// }
// t.ticket_id as id_ticket, ct.name as catename, t.email, t.subject, t.date_added, t.date_modified

function role_user($role_id = 0)
{
    include 'config.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM m_role WHERE status='enabled'";
    $query_user = mysqli_query($conn, $sql);
    while ($fetch_user = mysqli_fetch_assoc($query_user)) {
        $select = '';
        if ($fetch_user['role_id'] == $role_id) {
            $select = ' selected ';
        }
        echo '<option ' .
            $select .
            " value='" .
            $fetch_user['role_id'] .
            "'>" .
            $fetch_user['name'] .
            '</option>';
    }
}

function userOption()
{
    include 'config.php';
    $sql_user = 'SELECT * FROM m_user';
    $query_user = mysqli_query($conn, $sql_user);
    while ($fetch_user = mysqli_fetch_assoc($query_user)) {
        echo "<option value='" .
            $fetch_user['user_id'] .
            "'>" .
            $fetch_user['name'] .
            '</option>';
    }
}

function getUserById($id)
{
    include 'config.php';
    $sql_user = "SELECT * FROM m_user WHERE user_id =$id";
    $query_user = mysqli_query($conn, $sql_user);
    $fetch_user = mysqli_fetch_assoc($query_user);
    return $fetch_user;
}

function update_user($id)
{
    include 'config.php';
    $data = [];
    $id = $_GET['id'];
    $query_mysqli = mysqli_query(
        $conn,
        "SELECT u.name as usname, u.user_id, r.role_id, u.email, u.password, u.status, r.name as rolname FROM m_user u LEFT JOIN m_role r ON r.role_id = u.role_id WHERE user_id = '$id'"
    );
    $data = mysqli_fetch_array($query_mysqli);
    return $data;
}

function data_usermenu()
{
    include 'config.php';
    $out = [];
    $get = 'SELECT u.name as usname, u.user_id, u.email, u.status, r.name as rolname FROM m_user u LEFT JOIN m_role r ON r.role_id = u.role_id
';
    $query = mysqli_query($conn, $get);
    while ($data = mysqli_fetch_assoc($query)) {
        $name = $data['usname'];
        $email = $data['email'];
        $role_name = $data['rolname'];
        $status = $data['status'];
        $user_id = $data['user_id'];

        $out[] = [
            'name' => $name,
            'email' => $email,
            'rolname' => $role_name,
            'status' => $status,
            'user_id' => $user_id,
        ];
    }
    return $out;
}
