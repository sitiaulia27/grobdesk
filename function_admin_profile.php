<?php
function updateUser1($post)
{
    include 'config.php';
    include 'function_encryption.php';
    $id = $post['id'];
    $name = $post['name'];
    $email = $post['email'];
    $password = $post['password'];
    $cfm_password = $post['cfm_password'];
    $signature = $post['signature'];
    $pass = encrypt_password($password);
    $id = $post['id'];
    $salt = $pass['salt'];
    $hash = $pass['hash'];

    if (!$name || !$email || !$signature) {
        echo "
                    <script>
                        alert('User Failed to Update!');
                    </script>";

        echo '<meta http-equiv="refresh" content="0; url=profil_admin.php" />';
    } else {
        if (!empty($password)) {
            $sql_user = "UPDATE m_user SET name='$name', email='$email', salt='$salt', password='$hash', signature='$signature' WHERE user_id='$id'";
        } else {
            $sql_user = "UPDATE m_user SET name='$name', email='$email', signature='$signature' WHERE user_id='$id'";
        }
        $query_user = mysqli_query($conn, $sql_user);
        if ($query_user) {
            echo "
                            <script>
                                alert('User Success to Update!');
                            </script>";
        }
        echo '<meta http-equiv="refresh" content="0; url=profil_admin.php" />';
    }
}

function admin_solved()
{
    include 'config.php';
    $query = mysqli_query(
        $conn,
        "SELECT t.ticket_id as id_ticket FROM m_ticket t WHERE t.status = 'solved' AND DATE(t.date_modified) BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()"
    );
    $hasil = mysqli_num_rows($query);
    echo "<h3>$hasil</h3>";
}

function admin_unassigned()
{
    include 'config.php';
    $query2 = mysqli_query(
        $conn,
        "SELECT t.ticket_id as id_ticket, ct.name as catename, t.email, t.subject, t.date_added, t.date_modified, t.status as status FROM m_ticket t
        LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'unassigned'"
    );
    $hasil2 = mysqli_num_rows($query2);
    echo "<h3>$hasil2</h3>";
}

function admin_unsolved()
{
    include 'config.php';
    $user_id = $_SESSION['user_id'];
    $query3 = mysqli_query(
        $conn,
        "SELECT t.ticket_id as id_ticket, ct.name as catename, t.email, t.subject,t.date_modified FROM m_ticket t
    LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open' AND t.ticket_id IN (SELECT ticket_id FROM m_ticket_detail WHERE user_id = '$user_id')"
    );
    $hasil3 = mysqli_num_rows($query3);
    echo "<h3>$hasil3</h3>";
}
?>

