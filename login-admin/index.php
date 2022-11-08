
<!DOCTYPE html>
<html>

<head>
    <title>Login - Anda Untung Kami Berkah</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!-- Icon -->
    <link rel='shortcut icon' href='../landing-page/img/icon-tab.jpg'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <form class="login" action="cek-login/log-controller.php" method="post">
        <img src="../landing-page/img/Logo_ToSepatu_no_bg.png" alt="Logo Tosepatu" width="150px">
        <h2>Masuk</h2>
        <p>Masukkan email dan kata sandi anda di bawah ini</p>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error">
                <?=htmlspecialchars($_GET['error']) ?>
            </p>
        <?php 
        } ?>
        <label>EMAIL</label>
        <input type="text" name="email" placeholder="Masukkan Email" value="<?php if (isset($_GET['email'])) echo (htmlspecialchars($_GET['email'])) ?>">

        <label>KATA SANDI</label>
        <a href="../page/forgot.php">Lupa Kata Sandi?</a>
        <input type="password" name="password" placeholder="Masukkan Kata Sandi">
        <br>

        <button type="submit">Masuk</button>
    </form>
</body>

</html>
<?php
// }else {
// header("Location: ../page/dashboard.php"); 
// }
?>