<?php
// Mengaktifkan session
session_start();

// menghubungkan dengan koneksi database
require "../../config/config.php";

// memeriksa variable sudah diatur apa belum
if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    if (empty($email) && empty($pass)) {
        header("Location: ../index.php?error=Email dan Kata Sandi wajib diisi");
        exit();
    } else if (empty($email)) {
        header("Location: ../index.php?error=Email wajib diisi");
        exit();
    } else if (empty($pass)) {
        header("Location: ../index.php?error=Kata Sandi wajib diisi&email=$email");
        exit();
    }else {
        $stmt = $conn->prepare("SELECT * FROM akun WHERE email=?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();

            $user_id =  $user['id_akun'];
            $user_username =  $user['username'];
            $user_email =  $user['email'];
            $user_password =  $user['password'];
            $user_role =  $user['role'];
            $user_code =  $user['code'];
            $user_status =  $user['status'];

            if ($email === $user_email) {
                if (password_verify($pass, $user_password)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_username'] = $user_username;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_role'] = $user_role;
                    $_SESSION['user_code'] = $user_code;
                    $_SESSION['user_status'] = $user_status;

                    header("Location: ../../page/dashboard.php");
                } else {
                    header("Location: ../index.php?error=Email atau Password salah&email=$email");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=Email atau Password salah&email=$email");
                exit();
            }
        } else {
            header("Location: ../index.php?error=Email atau Password salah&email=$email");
            exit();
        }
    }
}
