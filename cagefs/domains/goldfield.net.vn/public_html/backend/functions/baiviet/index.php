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
        <a href="create.php" class="btn btn-primary" style="margin: 1px;">Thêm bài viết</a>
        <table class="table table-dark" style="display: block;">
            <thead>
                <th>STT</th>
                <th>Bài viết mã</th>
                <th>Tên bài viết</th>
                <th>Diễn giải</th>
                <th>Hình bài viết</th>
                <th>Liên kết bài viết</th>
            </thead>
            <tbody>
                <?php
                    include_once('../../../connectdb.php');
                    $sql  = "SELECT * FROM baiviet";
                    $result = mysqli_query($conn,$sql);
                    $stt = 1;
                    $baiviet = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $baiviet[] = array(
                            'ma_bv' => $row['ma_bv'],
                            'ten_bv' => $row['ten_bv'],
                            'diengiai' => $row['diengiai'],
                            'hinh_bv' => $row['hinh_bv'],
                            'link_bv' => $row['link_bv'],
                            );
                    }
                ?>
                <?php foreach ($baiviet as $h) : ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= $h['ma_bv'] ?></td>
                    <td><?= $h['ten_bv'] ?></td>
                    <td><?= $h['diengiai'] ?></td>
                    <td><?= $h['hinh_bv'] ?></td>
                    <td><?= $h['link_bv'] ?></td>
                    <td>
                    <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `hoa_ma` -->
                    <!-- <a href="edit.php?ma_bv=<?= $h['ma_bv'] ?>" class="btn btn-warning">
                        <span data-feather="edit"></span> Sửa
                    </a> -->

                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `hoa_ma` -->
                    <a href="delete.php?ma_bv=<?= $h['ma_bv'] ?>" class="btn btn-danger">
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