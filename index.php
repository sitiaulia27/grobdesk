<?php
include "config.php";
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Berhasil Login</title>
    <style>
        .navbar a{
            color: white;
            text-decoration: none;
        }

        .navbar a:hover{
            color: white;
        }

		.isi{
			margin-top: 60px;
		}
        body{
            font-family: "Lucida Console";
        }

        a{
        text-decoration: none;
        }

        .button {
        position: fixed;
        margin-top: 550px;
        margin-left: 20px;
        font-size: 10px;
        }
	</style>
</head>
<body>
<div class="navbar">
<nav class="navbar fixed-top navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><b>Grobmart</b></a>
            <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
        </ul>
  </div>
</nav>
</div>

<div class="isi">
    <div class="container-logout">
        <form action="" method="POST" class="login-email">
            <?php echo "<h1>Selamat Datang, " . $_SESSION['name'] . "!" . "</h1>"; ?>
            <div class="input-group">
            <!--<a href="logout.php" class="btn">Logout</a>-->
            </div>
        </form>
    </div>

    <diV class="button">
<button type="button" class="btn btn-primary btn-lg">
  <a href="form.php" style="color:white;"> <i class="fa-solid fa-circle-question fa-1x" style="color:white;"></i> Bantuan</a>
</button>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>