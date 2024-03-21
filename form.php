<?php
include 'config.php';
include 'function_data_ticket.php';
include 'function_categoryOption.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grobdesk Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
    table,tr,td {
            border: 1px solid black;
        }
    </style>
  </head>
<body>
<div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header mb-0 bg-dark text-white"><h5 class="text-center">Bantuan <span class="font-weight-bold text-primary"></span></h5></div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label"><b>Name:<font color="red">*</font></b></label>
                    <input type="text" name="name" class="form-control" required>
                    <input type="hidden" name="customer_id" id="customer_id" value="1" class="form-control">
                </div>
                <div class="form-group">
                <label class="form-label"><b>Subject:</b></label>
                <input type="text" name="subject" class="form-control" required>
                </div>
                <div class="form-group">
                <label class="form-label"><b>Email:<font color="red">*</font></b></label>
                <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                <label class="form-label"><b>Order id:</b></label>
                <input type="text" name="order" class="form-control" required>
                </div>
                <div class="form-group">
                <label class="form-label"><b>Question Category:<font color="red">*</font></b></label>
                <select class="form-select" aria-label="Default select example" name="kategori" required>
                    <?php categoryOption();?>
                </select>
                </div>
                <div class="form-group">
                <label class="form-label"><b>Message:<font color="red">*</font></b></label>
                    <textarea class="form-control"name="pesan" required></textarea>
                </div>
                <div class="form-group">
                <label class="form-label"><b>Attachment:</b></label>
                <br/>
                <input class="form-control" type="file" name="berkas" accept="image/jpeg,image/png">
                </div>
                <br/>
                <div class="form-group">
                    <input type="submit" name="kirim" value="Kirim" class="btn btn-primary btn-block">
                </div>
            </form>

            <?php
include 'function_form.php';
if (isset($_POST['kirim'])) {
    form_post($_POST);
}
?>

            </div>
        </div>
        </div>
    </div>
    </div>
<br/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>