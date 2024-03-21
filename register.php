<?php
require 'config.php';
require 'function_encryption.php';
if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if($password !== $konfirmasi_password)
    {
        echo "<script>
                alert('Password and Confirm Password are not the same!');
                window.location.href = 'register.php';
                </script>
        ";
    }else{
        $cekEmail  = mysqli_query($conn,"SELECT * FROM m_user WHERE email = '$email'");
        if(mysqli_fetch_assoc($cekEmail))
        {
            echo "<script>
                alert('Email already registered. Register Failed!');
                window.location.href = 'register.php';
                </script>
                ";
        }else{
            $data = encrypt_password($password);
            $salt = $data['salt'];
            $password_hash = $data['hash'];
            $queryInsert = mysqli_query($conn,"INSERT INTO `m_user` (`user_id`, `name`, `email`, `salt`, `password`, `role_id`, `status`) VALUES (NULL, '$name', '$email', '$salt', '$password_hash', '2', 'enabled')");
            if($queryInsert)
            {
                echo "<script>
                window.location.href = 'login.php';
                alert('Register Successful!');
                </script>
                ";
            }else{
                echo "<script>
                alert('Register Failed!');
                window.location.href = 'register.php';
                </script>
                ";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .input {
            margin-top: 150px;
        }
    </style>
</head>

<body>
    <div class="input">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-transparent mb-0">
                            <h5 class="text-center">Register <span class="font-weight-bold text-primary"></span></h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label>Name:</label></br>
                                    <input class="form-control" type="text" id="inputName" name="name" placeholder="Name" autofocus required="required">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label></br>
                                    <input class="form-control" type="email" id="inputEmail" name="email" placeholder="Email" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Password:</label></br>
                                    <input class="form-control" type="password" id="inputPassword" name="password" placeholder="Password" autofocus required="required">
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password:</label></br>
                                    <input class="form-control" type="password" id="inputKonfirmasiPassword" name="konfirmasi_password" placeholder="Konfirmasi Password" required="required"></br>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="register" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Register</button></br>
                                </div>
                            </form>
                            <p class="small">Already have an account? <a href="login.php">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>