<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Hình Hoa</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
        <?php include_once("../../layout/partials/header.php")?>
        <div class="col-md-3" style="padding: 0;">
            <?php include_once("../../layout/partials/menu.php")?>
        </div>
        <div class="col-md-9 ">
        <a href="create.php" class="btn btn-primary" style="margin: 2px;">Thêm hình sản phẩm</a>
    <table  class="table table-dark"  >
        <thead>
            <th>STT</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Hình sản phẩm</th>
            <th>Hành động</th>
        </thead>
        <tbody>
            <?php
                include_once('../../../connectdb.php');
                $sql  = <<<EOT
                SELECt * FROM hinhsanpham hsp
                JOIN hoa hoa
                on hsp.hoa_ma = hoa.hoa_ma    
EOT;
                $result = mysqli_query($conn,$sql);
                $stt = 1;
                $hsp = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $hsp[] = array(
                        'hsp_ma' => $row['hsp_ma'],
                        'hsp_tentaptin' => $row['hsp_tentaptin'],
                        'hsp_ten' => $row['hoa_ten'],
                        );
                }
            ?>
             <?php foreach ($hsp as $h) : ?>
              <tr>
                <td><?= $stt++ ?></td>
                <td><?= $h['hsp_ma'] ?></td>
                <td><?= $h['hsp_ten'] ?></td>
                <td>
                    <img src="/webbackend/backend/assets/uploads/products/<?=$h['hsp_tentaptin']?>" style="width: 100px; hieght:100px;">
                </td>
                <td>
                  <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `lsp_ma` -->
                  <a href="edit.php?hsp_ma=<?= $h['hsp_ma'] ?>" class="btn btn-warning">
                    <span data-feather="edit"></span> Sửa
                  </a>

                  <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `lsp_ma` -->
                  <a href="delete.php?hsp_ma=<?= $h['hsp_ma'] ?>" class="btn btn-danger">
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