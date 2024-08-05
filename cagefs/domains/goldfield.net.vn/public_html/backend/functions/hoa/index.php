<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Hoa</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
        <?php include_once("../../layout/partials/header.php")?>
        <div class="col-md-3" style="padding: 0;">
            <?php include_once("../../layout/partials/menu.php")?>
        </div>
        <div class="col-md-9 ">
        <a href="create.php" class="btn btn-primary" style="margin: 1px;">Thêm hoa</a>
        <table class="table table-dark" style="display: block;">
            <thead>
                <th>STT</th>
                <th>Hoa mã</th>
                <th>Tên hoa</th>
                <th>Mô tả hoa</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Giá cũ</th>
                <th>Ngày cập nhật</th>
                <th>Hành động</th>
            </thead>
            <tbody>
                <?php
                    include_once('../../../connectdb.php');
                    $sql  = "SELECT * FROM hoa";
                    $result = mysqli_query($conn,$sql);
                    $stt = 1;
                    $hoa = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $hoa[] = array(
                            'hoa_ma' => $row['hoa_ma'],
                            'hoa_ten' => $row['hoa_ten'],
                            'hoa_mota' => $row['hoa_mota'],
                            'hoa_soluong' => $row['hoa_soluong'],
                            'hoa_gia' => $row['hoa_gia'],
                            'hoa_giacu' => $row['hoa_giacu'],
                            'hoa_ngaycapnhat' => $row['hoa_ngaycapnhat'],
                            );
                    }
                ?>
                <?php foreach ($hoa as $h) : ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= $h['hoa_ma'] ?></td>
                    <td><?= $h['hoa_ten'] ?></td>
                    <td><?= $h['hoa_mota'] ?></td>
                    <td><?= $h['hoa_soluong'] ?></td>
                    <td><?= $h['hoa_gia'] ?></td>
                    <td><?= $h['hoa_giacu'] ?></td>
                    <td><?= $h['hoa_ngaycapnhat'] ?></td>
                    <td>
                    <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `hoa_ma` -->
                    <a href="edit.php?hoa_ma=<?= $h['hoa_ma'] ?>" class="btn btn-warning">
                        <span data-feather="edit"></span> Sửa
                    </a>

                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `hoa_ma` -->
                    <a href="delete.php?hoa_ma=<?= $h['hoa_ma'] ?>" class="btn btn-danger">
                        <span data-feather="delete"></span> Xóa
                    </a>
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