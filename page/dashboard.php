<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Beranda - Anda Untung Kami Berkah</title>
        <!-- Icon -->
        <link rel='shortcut icon' href='../landing-page/img/icon-tab.jpg'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="page.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <!-- Link auth line chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body>
        <section id="menu">
            <div class="logo">
                <img src="../landing-page/img/Logo_ToSepatu_no_bg.png" alt="Logo tosepatu">
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
                    <!-- <i class="fa-solid fa-pipe"></i> -->
                    <!-- <i class="fa-duotone fa-pipe"></i> -->
                    <img src="../landing-page/img/divider.png" alt="divider" height="550px">
                    <h4>
                        <?php
                        echo $_SESSION['user_username'];
                        ?>
                    </h4>
                    <img src="../landing-page/img/icon-tab.jpg" alt="Foto Profile">
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

                <div class="chart">
                    <canvas id="myChart"></canvas>
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
        </section>

        <!-- Line Chart -->
        <script>
            const labels = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember',
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Sekarang',
                    backgroundColor: '#5FD3D0',
                    borderColor: '#5FD3D0',
                    data: [23, 10, 5, 2, 20, 30, 45, 90, 79, 65, 43, 21],
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>

    </body>

    </html>
<?php
} else {
    header("Location: ../login-admin/index.php");
}
?>