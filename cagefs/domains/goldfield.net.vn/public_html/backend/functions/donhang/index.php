<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don dat hang</title>
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <!-- DataTable CSS -->
    <link href="../../assets/vendor/DataTables/datatables.min.css" type="text/css" rel="stylesheet" />
    <link href="../../assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <a href="create.php"> Them</a>
    <table id="tblDonhang" class="table table-dark" style="display: block;" >
        <thead>
            <th>Mã đơn hàng</th>
            <th>Khách hàng</th>
            <th>Ngày lập</th>
            <th>Ngày giao</th>
            <th>Nơi giao</th>
            <th>Hình thức thanh toán</th>
            <th>Tổng thành tiền</th>
            <th>Trạng thái thanh toán</th>
            <th>Hành động</th>
        </thead>
        <tbody>
            <?php
                include_once('../../../connectdb.php');
                $sql  = <<<EOT
                SELECT dh.dh_ma, dh.dh_ngaylap, dh.dh_ngaygiao,dh.tenkhachhang,
                dh.dh_noigiao, httt.httt_ten,dh.dh_trangthaithanhtoan,
                SUM(hddh.hoa_dh_dongia*hddh.hoa_dh_soluong) AS tongthanhtien
                FROM dondathang dh
                JOIN hoa_dondathang hddh ON hddh.dh_ma = dh.dh_ma
                JOIN hinhthucthanhtoan httt ON httt.httt_ma = dh.httt_ma
                GROUP BY dh.dh_ma, dh.dh_ngaylap, dh.dh_ngaygiao,
                dh.dh_noigiao, httt.httt_ten,dh.dh_trangthaithanhtoan    
EOT;
                $result = mysqli_query($conn,$sql);
                $ddh = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $ddh[] = array(
                        'dh_ma' => $row['dh_ma'],
                        'tenkhachhang' => $row['tenkhachhang'],
                        'dh_ngaylap' => $row['dh_ngaylap'],
                        'dh_ngaygiao' => $row['dh_ngaygiao'],
                        'dh_noigiao' => $row['dh_noigiao'],
                        'httt_ten' => $row['httt_ten'],
                        'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
                        'tongthanhtien' => $row['tongthanhtien'],
                        );
                }
            ?>
             <?php foreach ($ddh as $dh) : ?>
              <tr>
                <td><?=$dh['dh_ma'] ?></td>
                <td><?=$dh['tenkhachhang'] ?></td>
                <td><?=$dh['dh_ngaylap'] ?></td>
                <td><?=$dh['dh_ngaygiao'] ?></td>
                <td><?=$dh['dh_noigiao'] ?></td>
                <td>
                    <span class="btn btn-primary"><?=$dh['httt_ten']?></span>   
                </td>
                <td><?=$dh['tongthanhtien'] ?></td>
                <td><?=$dh['dh_trangthaithanhtoan'] ?></td>
                <td>
                    <a class="btn btn-primary" href="print.php?dh_ma=<?=$dh['dh_ma'] ?>">In</a>
                    <a class="btn btn-primary" href="delete.php?dh_ma=<?=$dh['dh_ma'] ?>">Xóa</a>
                </td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <script src="../../assets/vendor/DataTables/datatables.min.js"></script>
    <script src="../../assets/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="../../assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../../assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>

    <!-- SweetAlert -->
    <script src="../../assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            // Yêu cầu DataTable quản lý datatable #tblDanhSach
            $('#tblDonhang').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
</body>
</html> 