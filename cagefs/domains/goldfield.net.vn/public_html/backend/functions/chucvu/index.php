<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Chức vụ</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
        <?php include_once("../../layout/partials/header.php")?>
        <div class="col-md-3" style="padding: 0;">
            <?php include_once("../../layout/partials/menu.php")?>
        </div>
        <div class="col-md-9 ">
        <a href="create.php" class="btn btn-primary">Thêm chức vụ</a>
        <table class="table table-dark">
            <thead>
                <th>STT</th>
                <th>Mã chức vụ</th>
                <th>Tên chức vụ</th>
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

                    $sql  = "SELECT * FROM chucvu";
                    $result = mysqli_query($conn,$sql);
                    $stt = 1;
                    $chucvu = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $chucvu[] = array(
                            'cv_ma' => $row['cv_ma'],
                            'cv_ten' => $row['cv_ten'],
                            );
                    }
                ?>
                <?php foreach ($chucvu as $cv) : ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= $cv['cv_ma'] ?></td>
                    <td><?= $cv['cv_ten'] ?></td>
                    <td>
                    <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `cv_ma` -->
                    <a href="edit.php?cv_ma=<?= $cv['cv_ma'] ?>" class="btn btn-warning">
                        <span data-feather="edit"></span> Sửa
                    </a>

                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `cv_ma` -->
                    <a href="delete.php?cv_ma=<?= $cv['cv_ma'] ?>" class="btn btn-danger">
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