<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Đơn Hàng</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
        <?php include_once("../../layout/partials/header.php")?>
        <div class="col-md-3" style="padding: 0;">
            <?php include_once("../../layout/partials/menu.php")?>
        </div>
        <div class="col-md-9 ">
        <a href="create.php" class="btn btn-primary">Thêm đơn hàng</a>
                <table id="tblDonhang"  class="table table-dark" style="display: block;" >
                <thead>
                    <th>Mã đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Ngày lập</th>
                    <th>Nơi giao</th>
                    <th>Hình thức thanh toán</th>
                    <th>Tổng thành tiền</th>
                    <th>Hành động</th>
                </thead>
                <tbody>
                    <?php
                        include_once('../../../connectdb.php');
                        $sql  = <<<EOT
                        SELECT dh.dh_ma, dh.dh_ngaylap,dh.tenkhachhang,
                        dh.dh_noigiao, httt.httt_ten,
                        SUM(hddh.hoa_dh_dongia*hddh.hoa_dh_soluong) AS tongthanhtien
                        FROM dondathang dh
                        JOIN hoa_dondathang hddh ON hddh.dh_ma = dh.dh_ma
                        JOIN hinhthucthanhtoan httt ON httt.httt_ma = dh.httt_ma
                        GROUP BY dh.dh_ma, dh.dh_ngaylap,
                        dh.dh_noigiao, httt.httt_ten   
EOT;
                        $result = mysqli_query($conn,$sql);
                        $ddh = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $ddh[] = array(
                                'dh_ma' => $row['dh_ma'],
                                'tenkhachhang' => $row['tenkhachhang'],
                                'dh_ngaylap' => $row['dh_ngaylap'],
                                'dh_noigiao' => $row['dh_noigiao'],
                                'httt_ten' => $row['httt_ten'],
                                'tongthanhtien' => $row['tongthanhtien'],
                                );
                        }
                    ?>
                    <?php foreach ($ddh as $dh) : ?>
                    <tr>
                        <td><?=$dh['dh_ma'] ?></td>
                        <td><?=$dh['tenkhachhang'] ?></td>
                        <td><?=$dh['dh_ngaylap'] ?></td>
                        <td><?=$dh['dh_noigiao'] ?></td>
                        <td>
                            <span class="badge badge-primary"><?=$dh['httt_ten']?></span>   
                        </td>
                        <td><?=$dh['tongthanhtien'] ?></td>
                        <td>
                            <a class="btn btn-primary" href="print.php?dh_ma=<?=$dh['dh_ma'] ?>">In</a>
                            <a class="btn btn-danger" href="delete.php?dh_ma=<?=$dh['dh_ma'] ?>">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>    
    <?php include_once("../../layout/partials/footer.php")?>
</div>






    
<?php include_once("../../layout/partials/script.php")?>
</body>
</html>