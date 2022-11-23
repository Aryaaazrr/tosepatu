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
    <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?> | Anda Untung Kami Berkah</title>
    <!-- Icon -->
    <link rel='shortcut icon' href='../asset/img/icon-tab.jpg'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../asset/css/page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Link auth line chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <section id="menu">
        <div class="logo">
            <img src="../asset/img/Logo_ToSepatu_no_bg.png" alt="Logo tosepatu">
            <h2>TOSEPATU.KC</h2>
        </div>
        <div class="item">
            <li><i class="fa-solid fa-chart-pie"></i><a href="#">Beranda</a></li>
            <li><i class="fa-solid fa-ticket"></i><a href="#">Pesanan</a></li>
            <li><i class="fa-solid fa-lightbulb"></i><a href="#">Pelanggan</a></li>
            <li><i class="fa-solid fa-users"></i><a href="#">Kelola Tim</a></li>
            <li><i class="fa-solid fa-book"></i><a href="#">Laporan</a></li>
            <li><i class="fa-solid fa-gear"></i><a href="#">Pengaturan</a></li>
        </div>
    </section>
    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div class="nav-judul">
                    <h2>Beranda</h2>
                </div>
            </div>
            <div class="profile">
                <i class="fa-solid fa-bell"></i>
                <!-- <img src="../landing-page/img/divider.png" alt="divider" height="550px"> -->
                <h4>
                    <?php
                    echo $cname;
                    ?>
                </h4>
                <div class="dropdown" style="float:right">
                    <button class="dropbtn">
                        <img src="../asset/img/icon-tab.jpg" alt="Foto Profile">
                    </button>
                    <div class="dropdown-content">
                        <a href="#">Pengaturan</a>
                        <a href="../asset/php/logout.php">Keluar</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-box">
                    <h4>Jumlah Produk</h4>
                    <p>2</p>
                </div>
                <div class="card-box">
                    <h4>Toko Dilihat</h4>
                    <p>200</p>
                </div>
                <div class="card-box">
                    <h4>Dalam Proses</h4>
                    <p>209</p>
                </div>
                <div class="card-box">
                    <h4>Total Pesanan</h4>
                    <p>50</p>
                </div>
            </div>

            <div class="content-data">

                <!-- <div class="chart">
                <canvas id="myChart"></canvas>
            </div> -->

                <div class="chart">
                    <div class="card-header">
                        <h4>Bulan Ini</h4>
                        <p>
                            <!-- <i class="fa fa-arrow-up text-success"></i> -->
                            <!-- <span class="font-weight-bold">4% more</span> -->
                            13 Oktober 2022
                        </p>
                    </div>
                    <div class="cont-chart">
                        <canvas id="chart-line" class="chart-canvas"></canvas>
                    </div>
                </div>

                <div class="quick-access">
                    <div class="tittle-quick">
                        <i class="fa-solid fa-store"></i>
                        <h4>Quick Access</h4>
                    </div>
                    <div class="item-quick">
                        <li><i class="fa-regular fa-square-plus"></i><a href="#">Tambah Produk</a></li>
                        <li><i class="fa-regular fa-arrow-up-right-from-square"></i><a href="#">Buat Pesanan</a></li>
                        <li><i class="fa-regular fa-grid-2-plus"></i><a href="#">Metode Pengiriman</a></li>
                        <li><i class="fa-regular fa-grid-2-plus"></i><a href="#">Jam Operasional</a></li>
                        <li><i class="fa-regular fa-grid-2-plus"></i><a href="#">Metode Pembayaran</a></li>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card-body p-3">
                </div>
            </div>
        </div>
    </section>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!-- Line Chart -->
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(95, 211, 208, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(95, 211, 208, 0.2)');
        gradientStroke1.addColorStop(0, 'rgba(95, 211, 208, 0.2)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5FD3D0",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>

</body>

</html>
<?php
// } else {
//     header("Location: ../login-admin/index.php");
// }
?>