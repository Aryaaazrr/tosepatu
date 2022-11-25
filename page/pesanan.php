<?php
require_once '../asset/php/sidebar.php';
$tbl = new Auth();
?>

<div class="tbl-container">
    <div class="tbl-content">
        <div class="tbl-header">
            <h3>Semua Pesanan</h3>
            <div class="tbl-header-right">
                <a href="#"><i class="fa-sharp fa-solid fa-cart-plus">&nbsp;&nbsp;&nbsp;</i>Buat Pesanan</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#"><i class="fa-solid fa-sort">&nbsp;&nbsp;&nbsp;</i>Sort</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#"><i class="fa-solid fa-filter">&nbsp;&nbsp;&nbsp;</i>Filter</a>
            </div>
        </div>
        <div class="tbl-table" id="showAllUser">
            <!-- <table>
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Detail Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peter</td>
                    <td>Griffin</td>
                    <td>$100</td>
                    <td>$100</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lois</td>
                    <td>Griffin</td>
                    <td>$150</td>
                    <td>$150</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Joe</td>
                    <td>Swanson</td>
                    <td>$300</td>
                    <td>$300</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cleveland</td>
                    <td>Brown</td>
                    <td>$250</td>
                    <td>$250</td>
                </tr>
            </table> -->
        </div>
    </div>
</div>
<!-- Link Ajax Request-->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        fetchAllUser();
        function fetchAllUser() {
            $.ajax({
                url: '../asset/php/action.php',
                method: 'post',
                data: {
                    action: 'fetchAllUser'
                },
                success: function(response) {
                    // console.log(response);
                    $("#showAllUser").html(response);
                }
            });
        }
    });
</script>
</body>

</html>