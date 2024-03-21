<?php
function readCategory()
{
    include 'config.php';
    $sql_category = 'SELECT * FROM m_category_ticket';
    $query_category = mysqli_query($conn, $sql_category);
    return $query_category;
}

function createCategory($post)
{
    include 'config.php';
    $name = $post['name'];
    $status = $post['status'];
    $sort_order = $post['sort_order'];

    if (!$name || !$status || !$sort_order) {
        echo "
          <script>
            alert('Failed to Add Category!');
            window.location.href = 'category_add.php';
          </script>";
    } else {
        $sql_category = "INSERT INTO `m_category_ticket` (`name`, `status`, `sort_order`) VALUES ( '$name', '$status', '$sort_order')";

        $query_category = mysqli_query($conn, $sql_category);
        if ($query_category) {
            echo "
              <script>
                alert('Category Added Successfully!');
                window.location.href = 'category_index.php';
              </script>";
        } else {
            echo "
              <script>
                alert('Failed to Add Category!');
                window.location.href = 'category_add.php';
              </script>";
        }
    }
}

function updateCategory($id, $post)
{
    include 'config.php';
    $name = $post['name'];
    $status = $post['status'];
    $sort_order = $post['sort_order'];

    if (!$name || !$status || !$sort_order) {
        echo "
          <script>
            alert('Category Failed to Update!');
            window.location.href = 'category_index.php';
          </script>";
    } else {
        $sql_category = "UPDATE `m_category_ticket` SET `name` = '$name', `status` = '$status', `sort_order` = '$sort_order' WHERE `m_category_ticket`.`category_ticket_id` = $id";

        $query_category = mysqli_query($conn, $sql_category);
        if ($query_category) {
            echo "
              <script>
                alert('Category Updated Successfully!');
                window.location.href = 'category_index.php';
              </script>";
        } else {
            echo "
              <script>
                alert('Category Failed to Update!');
                window.location.href = 'category_index.php';
              </script>";
        }
    }
}

function deleteCategory($id)
{
    include 'config.php';
    $query_category = mysqli_query(
        $conn,
        "DELETE FROM m_category_ticket WHERE category_ticket_id='$id'"
    );

    if ($query_category) {
        echo "
          <script>
            alert('Category Deleted Successfully!');
            window.location.href = 'category_index.php';
          </script>";
    } else {
        echo "
          <script>
            alert('Category Failed to Delete!');
            window.location.href = 'category_index.php';
          </script>";
    }
}

function data_update($id)
{
    include 'config.php';
    $category = [];
    $id = $_GET['id'];
    $update = mysqli_query(
        $conn,
        $query = "SELECT * FROM m_category_ticket WHERE category_ticket_id=$id"
    );
    $category = mysqli_fetch_assoc($update);
    return $category;
}
