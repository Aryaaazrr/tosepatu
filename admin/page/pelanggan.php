<?php
require_once '../asset/php/sidebar.php';
$tbl = new Auth();
?>
<div class="tbl-container">
    <div class="tbl-content">
        <div class="tbl-header">
            <h3>Semua Pelanggan</h3>
            <div class="tbl-header-right">
                <a href="#"><i class="fa-solid fa-sort">&nbsp;&nbsp;&nbsp;</i>Sort</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#"><i class="fa-solid fa-filter">&nbsp;&nbsp;&nbsp;</i>Filter</a>
            </div>
        </div>
        <div class="tbl-table" id="showAllUser">
            <!-- <table>
                <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Pelanggan</th>
                    <th>Alamat Pelanggan</th>
                    <th>No. Telepon</th>
                    <th></th>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peter</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Griffin</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$100</td>
                    <td><i class="fa-solid fa-ellipsis-vertical"></i></td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lois</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Griffin</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$150</td>
                    <td><i class="fa-solid fa-ellipsis-vertical"></i></td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Joe</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Swanson</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$300</td>
                    <td><i class="fa-solid fa-ellipsis-vertical"></i></td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cleveland</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Brown</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$250</td>
                    <td><i class="fa-solid fa-ellipsis-vertical"></i></td>
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
                    $("#showAllUser").html(response);
                }
            });
        }
    });
</script>
</body>

</html>