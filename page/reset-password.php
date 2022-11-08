<?php
require '../config/config.php';
session_start();

if (isset($_GET['email']) && isset($_GET['code'])) {
    $_SESSION['email'] = $_GET['email'];
    $code = $_GET['code'];

    // Check Link 
    $query = $conn->prepare("SELECT * FROM akun WHERE email=?");
    $query->execute([$_SESSION['email']]);
    $from_reset = $query->fetch();
    if ($code != $from_reset['code']) {
        $expired = 'Maaf, Link anda tidak valid!';
        header("Location: reset-password.php?error=$expired");
        exit();
    }
}

// reset password
if (isset($_POST['change-pw'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $newPW = validate($_POST['new_password']);
    $confirmPW = validate($_POST['confirm_password']);

    if ($newPW == $confirmPW) {
        $hashed_password = password_hash($newPW, PASSWORD_DEFAULT);
        $query = $conn->prepare("UPDATE akun SET password= ? WHERE email = ?");
        $query->execute([$hashed_password, $_SESSION['email']]);
        
        header("Location: reset-password.php?success=Kata Sandi berhasil diubah, Silahkan Masuk Kembali");
        session_destroy();
    } else {
        header("Location: reset-password.php?error=Kata Sandi tidak cocok!");
        exit();
    }
    
    // // update password
    // if (empty($error)) {
        // }
    }
    
    // if (isset($_POST['change-pw'])) {
        //     function validate($data)
        //     {
            //         $data = trim($data);
            //         $data = stripslashes($data);
            //         $data = htmlspecialchars($data);
            //         return $data;
            //     }
            
            //     $newPW = validate($_POST['new_password']);
            //     $confirmPW = validate($_POST['confirm_password']);
            
            //     if (empty($newPW) || empty($confirmPW)) {
                //         header("Location: reset-password?error=Password tidak sama");
                //         exit();
                //     } else {
                    //         # code...
                    //     }
                    
                    // }
                    ?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Ubah Kata Sandi - Anda Untung Kami Berkah</title>
        <link rel="stylesheet" type="text/css" href="../login-admin/css/login.css">
        <!-- Icon -->
        <link rel='shortcut icon' href='../landing-page/img/icon-tab.jpg'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <form class="reset" action="reset-password.php" method="post">
        <img src="../landing-page/img/Logo_ToSepatu_no_bg.png" alt="Logo Tosepatu" width="150px">
        <h2>Ubah Kata Sandi</h2>
        <p>Masukkan kata sandi baru anda dan konfirmasi kata sandi di bawah ini</p>
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
            <div>
                <a href="../login-admin/index.php" style="text-decoration: none;">
                    <button type="button" name="login-n" ta>Masuk</button>
                </a>
            </div>
        <?php
        } ?>
        <?php
        if (!isset($expired) && isset($_GET['code'])) {
            echo '
                <label>KATA SANDI BARU</label>
                <input type="password" name="new_password" placeholder="Masukkan Kata Sandi Baru" required>
                <label>KONFIRMASI KATA SANDI</label>
                <input type="password" name="confirm_password" placeholder="Masukkan Konfirmasi Kata Sandi" required>
                <br>
        
                <button type="submit" name="change-pw">Ubah Kata Sandi</button>
                <div class="btn-cancel">
                    <a href="../login-admin/index.php">Kembali</a>
                </div>
                ';
        }
        ?>
    </form>
</body>

</html>