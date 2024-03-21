<?php
use PHPMailer\PHPMailer\PHPMailer;

function replay($post)
{
    include 'config.php';

    //ini wajib dipanggil paling atas

    //ini sesuaikan foldernya ke file 3 ini
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    $user_id = $_SESSION['user_id'];
    // $_SESSION['user_id'] = $row['user_id'];
    $status = 'open';
    $pesan = $_POST['pesan'];
    $ticket_id = $_POST['tickId'];

    $namaFile = $_FILES['berkas']['name'];
    $namaSementara = $_FILES['berkas']['tmp_name'];

    $extension = pathinfo($namaFile, PATHINFO_EXTENSION);
    $randomno = rand(0, 999);
    $rename = date('YmdHis') . $randomno;
    $newname = $rename . '.' . $extension;

    // tentukan tahun. Contoh: 2022
    $year = date('Y');
    // tentukan bulan. Contoh 07
    $month = date('m');

    $dirUplod = "img/$year/$month/";

    // periksa apakah direktori unggahan ada
    // jika tidak ada, buat direktori bernama img
    if (!file_exists('img')) {
        mkdir('img', 0755, true);
    }

    // periksa apakah direktori unggahan img/2022 ada
    // jika tidak ada, buat direktori bernama img/2022
    if (!file_exists("img/$year")) {
        mkdir("img/$year", 0755, true);
    }

    /// periksa apakah direktori img/2022/07 ada
    // jika tidak ada, buat direktori bernama img/2022/07
    if (!file_exists("img/$year/$month")) {
        mkdir("img/$year/$month", 0755, true);
    }

    if (is_uploaded_file($_FILES['berkas']['tmp_name'])) {
        $filePath = $dirUplod . $newname;
        move_uploaded_file($_FILES['berkas']['tmp_name'], $filePath);
        if ($extension == 'jpg' || $extension == 'jpeg') {
            $orig_image = imagecreatefromjpeg($filePath);
        } elseif ($extension == 'png') {
            $orig_image = imagecreatefrompng($filePath);
        } else {
            $orig_image = imagecreatefromjpeg($filePath);
        }

        $image_info = getimagesize($filePath);
        $width = 640; // new image width
        $height = 480; // new image height

        list($width_orig, $height_orig) = getimagesize($filePath);
        $ratio_orig = $width_orig / $height_orig;

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        $destination_image = imagecreatetruecolor($width, $height);
        imagecopyresampled(
            $destination_image,
            $orig_image,
            0,
            0,
            0,
            0,
            $width,
            $height,
            $width_orig,
            $height_orig
        );
        imagejpeg($destination_image, $filePath, 100);
        // simpan file file.txt ke dalam direktori img/{year}/month/
        $newname = $year . '/' . $month . '/' . $newname;
    } else {
        $newname = '';
    }

    //$email_pengirim = "sitiauliafitriyantii@gmail.com";
    $pesan = $_POST['pesan'];
    $subject = 'Grobmart (' . $ticket_id . ')';
    $email_tujuan = $_POST['emailto'];

    $mail = new PHPMailer();

    $mail->IsHTML(true); // set email format to HTML
    $mail->IsSMTP(); // we are going to use SMTP
    $mail->SMTPAuth = true; // enabled SMTP authentication
    $mail->SMTPSecure = 'ssl'; // prefix for secure protocol to connect to the server
    $mail->Host = 'smtp.gmail.com'; // setting GMail as our SMTP server
    $mail->Port = $SMPT_PORT; // SMTP port to connect to GMail
    $mail->Username = $SMTP_EMAIL; // alamat email kamu
    $mail->Password = $SMTP_PASSWORD; // password GMail
    $mail->SetFrom($SMTP_EMAIL, 'Grobmart'); //Siapa yg mengirim email
    $mail->Subject = $subject;
    $mail->Body = $pesan;
    $mail->AddAddress($email_tujuan);
    if ($newname != '') {
        $mail->addAttachment('img/' . $newname);
    }

    if (!$mail->Send()) {
        echo 'Eror: ' . $mail->ErrorInfo;
        echo '<script type ="text/JavaScript">';
        echo 'alert("Gagal !!!")';
        echo '</script>';
        exit();
    } else {
        $query = "INSERT INTO m_ticket_detail SET ticket_id = '$ticket_id', message = '$pesan', user_id = '$user_id', status = '$status', date_added = NOW(), date_modified = NOW(), attachment = '$newname'";
        if (mysqli_query($conn, $query)) {
            $query1 = "UPDATE m_ticket SET status='open' WHERE ticket_id=$ticket_id";
            if (mysqli_query($conn, $query1)) {
                echo '<script type ="text/JavaScript">';
                echo 'alert("pesan terkirim")';
                echo '</script>';
                echo '<meta http-equiv="refresh" content="0; url=" />';
            } else {
                echo '<script type ="text/JavaScript">';
                echo 'alert("Gagal !!")';
                echo '</script>';
            }
        } else {
            echo '<script type ="text/JavaScript">';
            echo 'alert("Gagal !")';
            echo '</script>';
        }
        // echo "<div class='alert alert-success'><strong>Berhasil!</strong> Email telah berhasil dikirim.</div>";
    }
}
