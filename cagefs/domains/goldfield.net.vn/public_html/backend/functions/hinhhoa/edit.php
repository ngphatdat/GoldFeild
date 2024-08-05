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
        <h1>Chỉnh sửa hình ảnh sản phẩm</h1>
            <?php
                    include_once('../../../connectdb.php');
                    $sql  = "SELECT * FROM hoa ";
                    $result = mysqli_query($conn,$sql);
                    $sp=[];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        $sp[] = array(
                            'hoa_ma' => $row['hoa_ma'],
                            'hoa_ten'=> $row['hoa_ten']
                        );
                    }
                    // var_dump($sp); die;
                    $hsp_ma = $_GET['hsp_ma'];
                    $sqlHinh  = "SELECT * FROM hinhsanpham WHERE hsp_ma=$hsp_ma";
                    $resultHinh = mysqli_query($conn,$sqlHinh);
                    $hsp = mysqli_fetch_array($resultHinh, MYSQLI_ASSOC);
                ?>

            <form action="" name="frmHinh" id="frmHinh" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="slSp">Sản phẩm</label>
                    <select name="slSp" id="slSp" class="form-control">
                    <?php foreach($sp as $sanpham):?>
                        <?php if( $sanpham['hoa_ma'] == $hsp['hoa_ma'] ):?>
                            <option value="<?=$sanpham['hoa_ma']?>" selected><?= $sanpham['hoa_ten']?></option>
                        <?php else:?>
                            <option value="<?=$sanpham['hoa_ma']?>"><?= $sanpham['hoa_ten']?></option>
                        <?php endif?>
                    <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="">Hình ảnh cũ</label>
                    <img src="/webbackend/backend/assets/uploads/products/<?=$hsp['hsp_tentaptin']?>" width="200px"/>
                </div>
                <div class="form-group ">
                    <label for="hsp_tentaptin">Hình ảnh</label>
                    <input type="file" name="hsp_tentaptin" id="hsp_tentaptin" />
                </div>
                <div class="preview-img-container form-group ">
                <img src="../../assets/imgs/degault.jpg" id="preview-img" width="200px" />
                </div>
                <div class="form-group">
                    <button name="btnLuu" class="btn btn-primary">Lưu</button>
                </div>
                <div class="form-group">
                    <a href="index.php" class="btn btn-primary" >Trở lại trang chủ</a>
                </div>
            </form>
            <?php
                if(isset($_POST['btnLuu'])){
                    $sp_ma= $_POST['slSp'];
                    if(isset($_FILES['hsp_tentaptin'])){
                        $upload_dir = __DIR__ . "/../../assets/uploads/";
                        // Các hình ảnh sẽ được lưu trong thư mục con `products` để tiện quản lý
                        $subdir = 'products/';

                        if ($_FILES['hsp_tentaptin']['error'] > 0) {
                            echo 'File Upload Bị Lỗi'; die;
                        } else{
                            $old_file = $upload_dir . $subdir . $hsp['hsp_tentaptin'];
                            if (file_exists($old_file)) {
                            // Hàm unlink(filepath) dùng để xóa file trong PHP
                            unlink($old_file);
                            }

                            $tentaptin= $_FILES['hsp_tentaptin']['name'];
                            $ten = date('YmdHis') . '_' . $tentaptin;
                            $sqlInsert="UPDATE `hinhsanpham` SET hsp_tentaptin='$ten' WHERE hsp_ma=$hsp_ma;";
                            $resultInsert=mysqli_query($conn,$sqlInsert);
                            move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir.$subdir.$ten);
                        }
                    }
                }
                
            ?>
        </div>
    </div>    
    <?php include_once("../../layout/partials/footer.php")?>    
</div>
<script>
    // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
    const reader = new FileReader();
    const fileInput = document.getElementById("hsp_tentaptin");
    const img = document.getElementById("preview-img");
    reader.onload = e => {
      img.src = e.target.result;
    }
    fileInput.addEventListener('change', e => {
      const f = e.target.files[0];
      reader.readAsDataURL(f);
    })
  </script>


<?php include_once("../../layout/partials/footer.php")?>


    
<?php include_once("../../layout/partials/script.php")?>
</body>
</html>