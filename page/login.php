<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | TOSEPATU - Anda Untung Kami Berkah</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/log-page.css">
    <!-- Icon -->
    <link rel='shortcut icon' href='../asset/img/icon-tab.jpg'>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="login">
        <form action="#" method="post" id="login-form">
            <img src="../asset/img/Logo_ToSepatu_no_bg.png" alt="Logo Tosepatu" width="150px">
            <h2>Masuk</h2>
            <p>Masukkan email dan kata sandi anda di bawah ini</p>
            <div id="logAlert"></div>
            <label>EMAIL</label>
            <input type="text" name="email" placeholder="Masukkan Email" value="<?php if (isset($_GET['email'])) echo (htmlspecialchars($_GET['email'])) ?>">

            <label>KATA SANDI</label>
            <a href="forgot.php">Lupa Kata Sandi?</a>
            <input type="password" name="password" placeholder="Masukkan Kata Sandi" value="<?php if (isset($_GET['password'])) echo (htmlspecialchars($_GET['password'])) ?>">
            <br>

            <button type="submit" id="login-btn">Masuk</button>
        </form>
    </div>

    <!-- Login Ajax Request link -->
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        // Login Ajax Request 
        $(document).ready(function() {
            $("#login-btn").click(function(e) {
                if ($("#login-form")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: '../asset/php/action.php',
                        method: 'post',
                        data: $("#login-form").serialize() + '&action=login',
                        success: function(response) {
                            if (response === 'login') {
                                window.location = 'dashboard.php';
                            } else {
                                $("#logAlert").html(response);
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>