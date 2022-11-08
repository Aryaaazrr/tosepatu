<?php
require '../config/config.php';
include 'funct-random-code.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php-mailer/src/Exception.php';
require 'php-mailer/src/PHPMailer.php';
require 'php-mailer/src/SMTP.php';

if (isset($_POST['send_link'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);

    // Check email apakah ada di database
    if (empty($email)) {
        header("Location: forgot.php?error=Email wajib diisi");
        exit();
    } else {
        $stmt = $conn->prepare("SELECT * FROM akun WHERE email=?");
        $stmt->execute([$email]);
        $row = $stmt->rowCount();

        if ($row == 1) {
            # generate code
            $code = generateRandomString();

            // formulate link
            $link = 'href="http://localhost:3000/page/reset-password.php?email=' . $email . '&code=' . $code . '"';
            $link2 = '<span style="width:95%"><a style="color: #40754C; display: flex; justify-content: center; align-items: center; margin: 0, auto;"' . $link . '>Link</a></span>';

            // header("Location: forgot.php?success=Link Terkirim. Check Email Sekarang!");
            // check data ke dalam tabel
            $query_reset = $conn->prepare("SELECT * FROM akun WHERE email=?");
            $query_reset->execute([$email]);
            $from_reset = $query_reset->fetch();

            if (empty($from_reset)) {
                # save info ke dalam tabel
                $query_insert_reset = $conn->prepare("INSERT INTO akun(email, code) VALUES (?, ?)");
                $query_insert_reset->execute([$email, $code]);
            } else {
                $query_insert_reset = $conn->prepare("UPDATE akun SET code = ? WHERE email = ?");
                $query_insert_reset->execute([$code, $email]);
            }

            // send email menggunakan php mailer
            $mail_send = new PHPMailer(true);
            // cofigurasi localhost
            $mail_send->isSMTP();
            $mail_send->Host = 'smtp.gmail.com';
            $mail_send->SMTPAuth = true;
            $mail_send->Username = 'tosepatu.kc@gmail.com';
            $mail_send->Password = 'keycmwufauijzziv';
            $mail_send->SMTPSecure = 'ssl';
            $mail_send->Port = 465;
            // inisialissasi format pesan email
            $to = $email;
            $subject = "Reset Password from TOSEPATU";
            $message = "
                <p>Dear '$email',</p>

                <p>Please click on this link to reset your password:</p>
                <p>$link2</p>

                <br>
                <p>Anda Untung Kami Berkah</p>,
                <span>ADMIN TOSEPATU</span>
            ";
            // $from = "tosepatu.kc@gmail.com";
            $mail_send->setFrom('tosepatu.kc@gmail.com');
            $mail_send->addAddress($to);
            $mail_send->isHTML(true);

            $mail_send->Subject = $subject;
            $mail_send->Body = $message;

            if ($mail_send->send()) {
                header("Location: forgot.php?success=Link Terkirim. Check email sekarang!");
            } else {
                header("Location: forgot.php?error=Gagal mengirim ke email");
                exit();
            }
        } else {
            header("Location: forgot.php?error=Email tidak ditemukan");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Lupa Kata Sandi - Anda Untung Kami Berkah</title>
    <link rel="stylesheet" type="text/css" href="../login-admin/css/login.css">
    <!-- Icon -->
    <link rel='shortcut icon' href='../landing-page/img/icon-tab.jpg'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <form class="forgot" action="forgot.php" method="post">
        <img src="../landing-page/img/Logo_ToSepatu_no_bg.png" alt="Logo Tosepatu" width="150px">
        <h2>Lupa Kata Sandi</h2>
        <p>Masukkan alamat email Anda</p>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error">
                <?= htmlspecialchars($_GET['error']) ?>
            </p>
        <?php
        } ?>
        <?php if (isset($_GET['success'])) { ?>
            <p class="success">
                <?= htmlspecialchars($_GET['success']); ?>
            </p>
        <?php
        } ?>
        <label>EMAIL</label>
        <input type="text" name="email" placeholder="Masukkan Email" value="<?php if (isset($_GET['email'])) echo (htmlspecialchars($_GET['email'])) ?>">
        <br>

        <button type="submit" name="send_link">Kirim Link</button>
        <div class="btn-cancel">
            <a href="../login-admin/index.php">Kembali</a>
        </div>
    </form>
</body>

</html>