<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Nhân Viên</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
        <?php include_once("../../layout/partials/header.php")?>
        <div class="col-md-3" style="padding: 0;">
            <?php include_once("../../layout/partials/menu.php")?>
        </div>
        <div class="col-md-9 ">
        <a href="create.php" class="btn btn-primary">Thêm nhân viên</a>
        <table class="table table-dark text-center">
            <thead>
                <th>STT</th>
                <th>Mã nhân viên</th>
                <th>Tên nhân viên</th>
                <th>Địa chỉ</th>
                <th>Chức vụ</th>
                <th>Hành động</th>
            </thead>
            <tbody>
                <?php
                    include_once('../../../connectdb.php');
                    $ma=$_SESSION['nhanvien'];
                    $sqlNhanvien="SELECT * FROM nhanvien WHERE nv_ma=$ma";
                    $resultNhanvien=mysqli_query($conn,$sqlNhanvien);
                    $rowNhanvien=mysqli_fetch_array($resultNhanvien);
                    if($row['nv_chucvu'] != 1){
                        echo '<script>alert("Bạn không có quyền truy cập vào trang này")</script>';
                        echo '<script>window.location.href="javascript: history.go(-1)"</script>';
                    }

                    $sql  = <<<EOT
                    SELECT nv.nv_ma,nv.nv_ten,nv.nv_diachi,cv.cv_ten
                    FROM `nhanvien` nv
                    JOIN `chucvu` cv ON nv.nv_chucvu = cv.cv_ma
EOT;
                    $result = mysqli_query($conn,$sql);
                    $stt = 1;
                    $nhanvien= [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $nhanvien[] = array(
                            'nv_ma' => $row['nv_ma'],
                            'nv_ten' => $row['nv_ten'],
                            'nv_diachi' => $row['nv_diachi'],
                            'cv_ten' => $row['cv_ten'],
                            );
                    }
                ?>
                <?php foreach ($nhanvien as $nv) : ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= $nv['nv_ma'] ?></td>
                    <td><?= $nv['nv_ten'] ?></td>
                    <td><?= $nv['nv_diachi'] ?></td>
                    <td><?= $nv['cv_ten'] ?></td>
                    <td>
                    <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `nv_ma` -->
                    <a href="edit.php?nv_ma=<?= $nv['nv_ma'] ?>" class="btn btn-warning">
                        <span data-feather="edit"></span> Sửa
                    </a>

                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `nv_ma` -->
                    <a href="delete.php?nv_ma=<?= $nv['nv_ma'] ?>" class="btn btn-danger">
                        <span data-feather="delete"></span> Xóa
                    </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>    
                    
    <div class="fixed-bottom">
    <?php include_once("../../layout/partials/footer.php")?>
    </div> 
</div>





    
<?php include_once("../../layout/partials/script.php")?>
</body>
</html>