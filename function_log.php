<?php
function login($post)
{
    include 'config.php';
    $email = $post['email'];
    //$password = md5($post['password']);

    //ini SQL
    $sql = "SELECT * FROM m_user WHERE email='$email'";

    //ini query SQL  alias jalanin querynya
    $result = mysqli_query($conn, $sql);

    //ini get SQL nya, ambil datanya, jadi dalam bentuk array
    $row = mysqli_fetch_assoc($result);

    if (!empty($row)) {
        $user_pass = $row['password'];
        $user_salt = $row['salt'];
        $status = $row['status'];
        $disabled = 'disabled';

        $pass = $post['password'];
        $salted_pass = $pass . $user_salt;
        $encrypted_pass = md5($salted_pass);

        if ($status == $disabled) {
            echo "<script>alert('Your account is disabled!')</script>";
            echo '<meta http-equiv="refresh" content="0; url=login.php" />';
        } else {
            if ($user_pass == $encrypted_pass) {
                // session_start();
                //password sama
                $_SESSION['logged'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role_id'] = $row['role_id'];
                $_SESSION['loggrobdesk'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                echo "<script>
                            alert('Login Success!');
                        </script>";
                if ($row['role_id'] == 1) {
                    echo '<meta http-equiv="refresh" content="0; url=admin.php" />';
                } else {
                    echo '<meta http-equiv="refresh" content="0; url=admin.php" />';
                }
            } else {
                //password tidak sama
                echo "<script>alert('Your password is incorrect. Please try again!')</script>";
                echo '<meta http-equiv="refresh" content="0; url=login.php" />';
            }}

    } else {
        //password tidak sama
        echo "<script>alert('Your email is undefined. Please try again!')</script>";
        echo '<meta http-equiv="refresh" content="0; url=login.php" />';
    }
}

function isLoggedIn()
{
    include 'config.php';
    session_start();
    if (!isset($_SESSION['logged'])) {
        echo "<script> alert('You must login to access this page');
                    </script>";
        echo '<meta http-equiv="refresh" content="0; url=login.php" />';
        die();
    }

    $role_id = $_SESSION['role_id'];
    $query = mysqli_query(
        $conn,
        "SELECT role_acces FROM m_role WHERE role_id = $role_id"
    );
    $role = mysqli_fetch_assoc($query);
    // var_dump($role);die;
    if ($role == null) {
        echo "<script> alert('
        Your role id is empty or you don't have access');
        </script>";
        echo '<meta http-equiv="refresh" content="; url=null.php" />';
        die();
    }
    //var_dump($role);die;
    $exp = explode(',', $role['role_acces']);
    $length = count($exp);
    for ($i = 0; $i < $length; $i++) {
        $roles[$i + 1] = preg_replace('/[^0-9]/', '', $exp[$i]);
    }
    // var_dump($roles);
    // $url = explode('/', $_SERVER['REQUEST_URI']);
    // $endUrl = count($url) - 1;
    $akses = basename($_SERVER['PHP_SELF']);
    // var_dump($akses);

    $query2 = mysqli_query(
        $conn,
        "SELECT * FROM m_prm WHERE prm_file like '%$akses%'"
    );
    while ($prm = mysqli_fetch_assoc($query2)) {
        // var_dump($prm);
        $prmID = $prm['prm_id'];
    }
    $cek = array_search($prmID, $roles);
    // var_dump($cek);die;
    if ($cek == null || $cek == false) {
        echo "<script> alert('you don\'t have access');
        </script>";
        echo '<script>javascript:history.go(-1)</script>';
        die();
    }
}

function isLoggedOut()
{
    include 'config.php';
    session_start();
    if (isset($_SESSION['logged'])) {
        //echo "<script> alert('You already to logged in!');
        // </script>";
        echo '<meta http-equiv="refresh" content="0; url=admin.php" />';
        //die();
    }
}
