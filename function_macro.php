<?php
function readMacro()
{
    include 'config.php';
    $sql_role = 'SELECT * FROM m_macro';
    $query_role = mysqli_query($conn, $sql_role);
    return $query_role;
}

function addMacro($post)
{
    include 'config.php';
    $user_id = $_SESSION['user_id'];
    $name = $post['macro_name'];
    $text = $post['macro_text'];
    $status = $post['status'];

    if (!$name) {
        echo '<script> alert("Failed Macro Added!")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0; url=macro_index.php" />';
    } else {
        $sql_macro = "INSERT INTO m_macro (macro_name, macro_text, status, user_id) VALUES ('$name', '$text', '$status', '$user_id')";
        $query_macro = mysqli_query($conn, $sql_macro);
        if ($query_macro) {
            echo '<script> alert("Macro Successfuly!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=macro_index.php" />';
        }
    }
}

function updateMacro($post)
{
    include 'config.php';
    // var_dump($_POST);die;
    $id = $_POST['id'];
    $name = $_POST['macro_name'];
    $text = $_POST['macro_text'];
    $status = $_POST['status'];
    $query3 = mysqli_query(
        $conn,
        "UPDATE m_macro SET macro_name='$name', macro_text='$text', status='$status' WHERE macro_id='$id'"
    );
    if ($query3) {
        echo "
                <script>
                alert('Macro Update Successfully!');
                window.location.href = 'macro_index.php';
                </script>
                ";
    } else {
        echo "
                <script>
                alert('Macro Failed to Update!');
                window.location.href = 'macro_index.php';
                </script>";
    }
}

function deleteMacro($id)
{
    include 'config.php';
    $query = "SELECT * FROM m_macro WHERE macro_id='$id'";
    $c = mysqli_query($conn, $query);
    if ($c->num_rows > 0) {
        $query2 = mysqli_query(
            $conn,
            "DELETE FROM m_macro WHERE macro_id='$id'"
        );
        if ($query2) {
            echo '<script type="text/javascript">';
            echo 'alert("Macro Delete Successfully!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=macro_index.php" />';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Macro Delete Failed!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=macro_index.php" />';
        }
    }
}

function macroOption()
{
    include 'config.php';
    if ($_SESSION['role_id'] == 1) {
        $sql_macro = 'SELECT * FROM m_macro';
    } else {
        $sql_macro =
            'SELECT * FROM m_macro WHERE user_id=' . $_SESSION['user_id'] . ' ';
    }
    $query_macro = mysqli_query($conn, $sql_macro);
    while ($fetch_macro = mysqli_fetch_assoc($query_macro)) {
        echo "<option value='" .
            $fetch_macro['macro_text'] .
            "'>" .
            $fetch_macro['macro_name'] .
            '</option>';
    }
}

function macro_edit($id)
{
    include 'config.php';
    $data = [];
    $id = $_GET['id'];
    $query_mysqli = mysqli_query(
        $conn,
        "SELECT * FROM m_macro WHERE macro_id = '$id'"
    );
    $data = mysqli_fetch_array($query_mysqli);
    return $data;
}

function macro_index()
{
    include 'config.php';
    $out = [];
    if ($_SESSION['role_id'] == 1) {
        $get = 'SELECT * FROM m_macro';
    } else {
        $get =
            'SELECT * FROM m_macro WHERE user_id=' . $_SESSION['user_id'] . ' ';
    }
    $query = mysqli_query($conn, $get);
    while ($row = mysqli_fetch_assoc($query)) {
        $name = $row['macro_name'];
        $text = $row['macro_text'];
        $status = $row['status'];
        $id = $row['macro_id'];
        $out[] = [
            'macro_name' => $name,
            'macro_text' => $text,
            'status' => $status,
            'macro_id' => $id,
        ];
    }

    return $out;
}
