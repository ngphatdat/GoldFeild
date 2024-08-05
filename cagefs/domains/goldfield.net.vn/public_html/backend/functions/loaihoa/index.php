<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Loại Hoa</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
        <?php include_once("../../layout/partials/header.php")?>
        <div class="col-md-3" style="padding: 0;">
            <?php include_once("../../layout/partials/menu.php")?>
        </div>
        <div class="col-md-9 ">
        <a href="create.php" class="btn btn-primary">Thêm loại hoa</a>
        <table class="table table-dark">
            <thead>
                <th>STT</th>
                <th>Mã loại</th>
                <th>Tên loại</th>
                <th>Mô tả loại hoa</th>
                <th>Hành động</th>
            </thead>
            <tbody>
                <?php
                    include_once('../../../connectdb.php');
                    $sql  = "SELECT * FROM loaihoa";
                    $result = mysqli_query($conn,$sql);
                    $stt = 1;
                    $lh = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $lh[] = array(
                            'lh_ma' => $row['lh_ma'],
                            'lh_ten' => $row['lh_ten'],
                            'lh_mota' => $row['lh_mota'],
                            );
                    }
                ?>
                <?php foreach ($lh as $loaihoa) : ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= $loaihoa['lh_ma'] ?></td>
                    <td><?= $loaihoa['lh_ten'] ?></td>
                    <td><?= $loaihoa['lh_mota'] ?></td>
                    <td>
                    <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `lh_ma` -->
                    <a href="edit.php?lh_ma=<?= $loaihoa['lh_ma'] ?>" class="btn btn-warning">
                        <span data-feather="edit"></span> Sửa
                    </a>

                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `lh_ma` -->
                    <a href="delete.php?lh_ma=<?= $loaihoa['lh_ma'] ?>" class="btn btn-danger">
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