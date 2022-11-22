<?php
// require '../config/config.php';
// session_start();

require_once '../asset/php/auth.php';
$user = new Auth();

if (isset($_GET['email']) && isset($_GET['code'])) {
    $email = $user->validate($_GET['email']);
    $code = $user->validate($_GET['code']);

    // Check Link 
    $user_checklink = $user->reset_pass($email, $code);

    if ($user_checklink != null) {
        // reset password
        if (isset($_POST['change-pw'])) {

            $newPW = $user->validate($_POST['new_password']);
            $confirmPW = $user->validate($_POST['confirm_password']);

            if ($newPW == $confirmPW) {
                $hashed_password = password_hash($newPW, PASSWORD_DEFAULT);
                $user->update_pass($hashed_password, $email);

                header("Location: reset-password.php?success=Kata Sandi berhasil diubah, Silahkan Masuk Kembali");
                // session_destroy();
                exit();
            } else {
                header("Location: reset-password.php?error=Kata Sandi tidak cocok!");
                // exit();
            }
        }
    } else {
        $expired = 'Maaf, Link anda tidak valid!';
        header("Location: reset-password.php?error=$expired");
        exit();
        # code...
    }
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
    <link rel="stylesheet" type="text/css" href="../asset/css/log-page.css">
    <!-- Icon -->
    <link rel='shortcut icon' href='../asset/img/icon-tab.jpg'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <form class="reset" action="reset-password.php" method="post">
        <img src="../asset/img/Logo_ToSepatu_no_bg.png" alt="Logo Tosepatu" width="150px">
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
                <input type="password" name="new_password" placeholder="Masukkan Kata Sandi Baru" >
                <label>KONFIRMASI KATA SANDI</label>
                <input type="password" name="confirm_password" placeholder="Masukkan Konfirmasi Kata Sandi" >
                <br>
        
                <button type="submit" name="change-pw">Ubah Kata Sandi</button>
                ';
        }
        ?>
    </form>
</body>

</html>