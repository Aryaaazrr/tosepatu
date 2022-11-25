<?php
// session_start();
require_once '../asset/php/session.php';
// echo '<pre>';

// if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $tittle = ucfirst(basename($_SERVER['PHP_SELF'], '.php'));
    ?>
    <title><?= $tittle ?> | TOSEPATU - Anda Untung Kami Berkah</title>
    <!-- Icon -->
    <link rel='shortcut icon' href='../asset/img/icon-tab.jpg'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../asset/css/page.css">
    <!-- <link rel="stylesheet" href="../asset/css/pop-up.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Link auth line chart -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
</head>

<body>
    <section id="menu">
        <div class="logo">
            <img src="../asset/img/Logo_ToSepatu_no_bg.png" alt="Logo tosepatu">
            <h2>TOSEPATU.KC</h2>
        </div>
        <div class="item">
            <li><i class="fa-solid fa-chart-pie"></i>
                <a href="beranda.php" <?= (basename($_SERVER['PHP_SELF']) == "dashboard.php") ? "nav-active" : ""; ?>>Beranda</a>
            </li>
            <li><i class="fa-solid fa-ticket"></i>
                <a href="pesanan.php" <?= (basename($_SERVER['PHP_SELF']) == "pesanan.php") ? "active" : ""; ?>>Pesanan</a>
            </li>
            <li><i class="fa-solid fa-lightbulb"></i>
                <a href="pelanggan.php" <?= (basename($_SERVER['PHP_SELF']) == "pelanggan.php") ? "active" : ""; ?>>Pelanggan</a>
            </li>
            <li><i class="fa-solid fa-users"></i>
                <a href="kelola tim.php" <?= (basename($_SERVER['PHP_SELF']) == "tim.php") ? "active" : ""; ?>>Kelola Tim</a>
            </li>
            <li><i class="fa-solid fa-book"></i>
                <a href="laporan.php" <?= (basename($_SERVER['PHP_SELF']) == "laporan.php") ? "active" : ""; ?>>Laporan</a>
            </li>
            <li><i class="fa-solid fa-gear"></i>
                <a href="pengaturan.php" <?= (basename($_SERVER['PHP_SELF']) == "pengaturan.php") ? "active" : ""; ?>>Pengaturan</a>
            </li>
        </div>
    </section>
    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div class="nav-judul">
                    <h2><?= $tittle;?></h2>
                </div>
            </div>
            <div class="profile">
                <i class="fa-solid fa-bell"></i>
                <img src="../asset/img/divider.png" alt="vertical line">

                <!-- <i class="fa-light fa-pipe"></i> -->
                <h4>
                    <?php
                    echo $fname;
                    ?>
                </h4>
                <div class="dropdown" style="float:right">
                    <button class="dropbtn">
                        <img class="photo" src="../asset/img/icon-tab.jpg" alt="Foto Profile">
                    </button>
                    <div class="dropdown-content">
                        <a href="pengaturan.php"><i class="fa-solid fa-gear"></i>&nbsp;Pengaturan</a>
                        <a href="../asset/php/logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Keluar</a>
                    </div>
                </div>
            </div>