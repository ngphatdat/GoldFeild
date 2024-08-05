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
                    <h1>Chỉnh sửa hoa</h1>
                    <?php
                        include_once('../../../connectdb.php');
                        $ma=$_GET['nv_ma'];
                        $sql=<<<EOT
                        SELECT * FROM nhanvien
                        WHERE nv_ma=$ma
EOT;
                        $result=mysqli_query($conn,$sql);
                        $nhanvien=mysqli_fetch_array($result);

                        $sql2="SELECT * FROM chucvu";
                        $result2=mysqli_query($conn,$sql2);
                        $chucvu=[];
                        while($row2=mysqli_fetch_array($result2)){
                            $chucvu[] = array(
                                'cv_ma'=>$row2['cv_ma'],
                                'cv_ten'=>$row2['cv_ten'],
                            );
                        }
                    ?>

                    <form action="" method="POST" name="frmThem" id="frmThem">
                        <div class="form-group">
                            <label for="hoa_ten">Tên nhân viên</label>
                            <input type="text" class="form-control" id="nv_ten" name="nv_ten" value="<?=$nhanvien['nv_ten']?>">
                        </div>
                        <div class="form-group">
                            <label for="nv_diachi">Địa chỉ</label>
                            <input type="text" class="form-control" id="nv_diachi" name="nv_diachi" value="<?=$nhanvien['nv_diachi']?>">
                        </div>
                        <div class="form-group">
                            <label for="cv_ma">Chức vụ</label>
                            <select name="cv_ma" id="cv_ma" class="form-control">
                                <?php foreach($chucvu as $cv):?>
                                <option value="<?=$cv['cv_ma']?>"  <?php  echo( $cv['cv_ma'] == $nhanvien['nv_chucvu'] ? 'selected' : '' );?>><?=$cv['cv_ten']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" name="btnThem" id="btnThem">Lưu</button>
                        </div>
                    </form>
            <?php
                if(isset($_POST['btnThem'])){
                    $nv_ten = htmlentities( $_POST['nv_ten']);
                    $nv_diachi = htmlentities( $_POST['nv_diachi']);
                    $nv_chucvu = htmlentities( $_POST['cv_ma']);
                    include_once('../../../connectdb.php');
                    $sql =<<<EOT
                    UPDATE nhanvien
                    SET
                    nv_ten='$nv_ten',
                    nv_diachi='$nv_diachi',
                    nv_chucvu=$nv_chucvu
                    WHERE nv_ma=$ma
EOT;
                    // var_dump($sql); die;
                    $result = mysqli_query($conn,$sql);
                    echo'
                        <script>
                            window.location="index.php";
                        </script>
                    ';
                }
                ?>

            <?php include_once("../../layout/partials/script.php")?>
            <script>
                $(document).ready(function() {
                    $("#frmThem").validate({
                    rules: { 
                        hoa_ten: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                        },
                        hoa_mota: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                        },
                        hoa_gia: {
                        required: true,
                        minlength: 6,
                        maxlength: 10
                        },
                        hoa_giacu: {
                        required: true,
                        minlength: 6,
                        maxlength: 10
                        },
                        hoa_soluong: {
                        required: true,
                        minlength: 1,
                        maxlength: 3
                        }
                    },
                    messages: {
                        hoa_ten: {
                        required: "Vui lòng nhập tên hoa",
                        minlength: "Tên hoa phải có ít nhất 3 ký tự",
                        maxlength: "Tên hoa không được vượt quá 50 ký tự"
                        },
                        hoa_mota: {
                        required: "Vui lòng nhập mô tả cho hoa",
                        minlength: "Mô tả cho hoa phải có ít nhất 3 ký tự",
                        maxlength: "Mô tả cho hoa không được vượt quá 255 ký tự"
                        },
                        hoa_gia: {
                        required: "Vui lòng giá cho hoa",
                        minlength: "Giá hoa ít nhất có 6 ký tự",
                        maxlength: "Giá hoa có tối đa 10 ký tự"
                        },
                        hoa_giacu: {
                        required: "Vui lòng giá cũ cho hoa",
                        minlength: "Giá hoa ít nhất có 6 ký tự",
                        maxlength: "Giá hoa có tối đa 10 ký tự"
                        },
                        hoa_soluong : {
                        required: "Vui lòng số lượng hoa",
                        minlength: "Số lượng hoa phải lớn hơn 1",
                        maxlength: "Số lượng hoa phải nhỏ hơn 1000"
                        },
                    },
                    errorElement: "em",
                    errorPlacement: function(error, element) {
                        // Thêm class `invalid-feedback` cho field đang có lỗi
                        error.addClass("invalid-feedback");
                        if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                        } else {
                        error.insertAfter(element);
                        }
                    },
                    success: function(label, element) {},
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-valid").removeClass("is-invalid");
                    }
                    });
                });
                </script>
        </div>
    </div>    
    <?php include_once("../../layout/partials/footer.php")?>
</div>
    
<?php include_once("../../layout/partials/script.php")?>
</body>
</html>