<?php
session_start();
include '../../funct-random-code.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
$mail = new PHPMailer(true);

require_once 'auth.php';
$user = new Auth();

// Handle login request 
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = $user->validate($_POST['email']);
    $pass = $user->validate($_POST['password']);

    if (empty($email) && empty($pass)) {
        echo $user->showMessage('danger', 'Email dan Kata Sandi wajib diisi');
        // header("Location: ../../page/login.php?error=Email dan Kata Sandi wajib diisi");
        exit();
    } else if (empty($email)) {
        echo $user->showMessage('danger', 'Email wajib diisi');
        // header("Location: ../../page/login.php?error=Email wajib diisi");
        exit();
    } else if (empty($pass)) {
        echo $user->showMessage('danger', 'Kata Sandi wajib diisi');
        // header("Location: ../../page/login.php?error=Kata Sandi wajib diisi&email=$email");
        exit();
    } else {
        $loginUser = $user->login($email);

        if ($loginUser != null) {
            if (password_verify($pass, $loginUser['password'])) {
                echo 'login';
                $_SESSION['user'] = $email;
            } else {
                echo $user->showMessage('danger', 'Kata sandi salah');
            }
        } else {
            echo $user->showMessage('danger', 'Email dan Kata Sandi salah');
        }
    }
}

