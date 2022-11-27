<?php
require_once '../asset/php/sidebar.php';
require_once '../asset/php/auth.php';

$count = new Auth();
?>

<div class="card">
    <div class="card-box" style="border-color: #FFE61B;">
        <h4 style="color: #FFE61B">Jumlah Produk</h4>
        <p style="color: #FFE61B;">
            <?= $count->totalCount('layanan'); ?>
        </p>
    </div>
    <div class="card-box" style="border-color: #EC524B;">
        <h4 style="color: #EC524B;">Toko Dilihat</h4>
        <p style="color: #EC524B;">
            <?php $data = $count->siteHits();
            echo $data['hits']; ?>
        </p>
    </div>
    <div class="card-box" style="border-color: #2BB6F1;">
        <h4 style="color: #2BB6F1;">Dalam Proses</h4>
        <p style="color: #2BB6F1;">209</p>
    </div>
    <div class="card-box" style="border-color: #F5B12C;">
        <h4 style="color: #F5B12C;">Total Pesanan</h4>
        <p style="color: #F5B12C;">
            <?= $count->totalCount('detail_pesanan'); ?>
        </p>
    </div>
</div>

<div class="content-data">
    <div class="chart">
        <div class="card-header">
            <h3>
                <?php
                $bulan = date("F");
                echo 'Grafik Pemesanan '.$count->bulan($bulan);
                ?>
            </h3>
            <p>
                <?php
                date_default_timezone_set('Asia/Jakarta');
                echo $today = date('j F Y, g:i A');
                ?>
            </p>
        </div>
        <div class="cont-chart">
            <canvas id="chart-line" class="chart-canvas"></canvas>
        </div>
    </div>

    <div class="content-right">
        <div class="quick-access">
            <div class="tittle-quick">
                <i class="fa-solid fa-store"></i>
                <h4>Quick Access</h4>
            </div>
            <div class="item-quick">
                <li><i class="fa-solid fa-square-plus"></i>
                    <a href="#popup1">Tambah Produk</a>
                </li>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <h2>Tambah Produk</h2>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            Silahkan masukkan data produk
                        </div>
                        <div id="alert"></div>
                        <div class="form-produk">
                            <form action="#" method="post" id="add-produk-form">
                                <input type="text" name="id-produk" disabled value="<?= $count->idProdukIncrement(); ?>">
                                <input type="text" name="nama-produk" placeholder="Masukkan Nama Produk">
                                <input type="text" name="harga-produk" placeholder="Masukkan Harga Produk">
                                <br>
                                <br>

                                <button type="submit" id="add-produk-btn">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
                <li><i class="fa-sharp fa-solid fa-cart-plus"></i>
                    <a href="#popup2">Buat Pesanan</a>
                </li>
                <div id="popup2" class="overlay">
                    <div class="popup">
                        <h2>Buat Pesanan</h2>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            Silahkan masukkan data pesanan
                        </div>
                        <div id="alert"></div>
                        <div class="form-produk">
                            <form action="#" method="post" id="add-produk-form">
                                <input type="text" name="id-produk" disabled value="<?= $count->idPesananIncrement(); ?>">
                                <input type="text" name="nama-produk" placeholder="Masukkan Nama Produk">
                                <input type="text" name="harga-produk" placeholder="Masukkan Harga Produk">
                                <br>
                                <br>

                                <button type="submit" id="add-produk-btn">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="status-karyawan">
            <div class="tittle-status">
                <i class="fa-solid fa-user-check"></i>
                <h4>Status Karyawan</h4>
            </div>
            <div class="item-status">
                <li><a href="kelola tim.php">Achmad Zakariya</a><i class="fa-solid fa-circle-check"></i></li>
                <li><a href="kelola tim.php">A. Maulana Subandrio</a><i class="fa-solid fa-circle-check"></i></li>
                <li><a href="kelola tim.php">Refyan Gigas</a><i class="fa-solid fa-circle-check"></i></li>
                <li><a href="kelola tim.php">Daffa Fauzi</a><i class="fa-solid fa-circle-check"></i></li>
                <li><a href="kelola tim.php">Akbar Kusnandi</a><i class="fa-solid fa-circle-check"></i></li>
            </div>
        </div>
    </div>
</div>
</div>
</section>

<!--   Core JS Files   -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
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
<!-- Link auth line chart -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<!-- <script src="path/to/chartjs/dist/chart.umd.js"></script> -->
<!-- Link Ajax Request-->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<!-- Ajax add produk request -->
<script>
    $(document).ready(function() {
        $("#add-produk-btn").click(function(e) {
            if ($("#add-produk-form")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: '../asset/php/action.php',
                    method: 'post',
                    data: $("#add-produk-btn").serialize() + '$action=tambahproduk',
                    success: function(response) {
                        console.log(response);
                        // if (response === 'tambahproduk') {
                        //     $("#alert").html(response);
                        // } else {
                        //     $("#aAlert").html(response);
                        // }
                    }
                });
            }
        });
    });
</script>

</body>

</html>
<?php
// } else {
//     header("Location: ../login-admin/index.php");
// }
?>