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
                        $sqlLoaibaiviet = "select * from `loaibaiviet`";

                        // Thực thi câu truy vấn SQL để lấy về dữ liệu
                        $resultLoaibaviet = mysqli_query($conn, $sqlLoaibaiviet);

                        // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                        $dataLoaibaiviet = [];
                        while ($rowLoaibaiviet = mysqli_fetch_array($resultLoaibaviet, MYSQLI_ASSOC)) {
                            $dataLoaibaiviet[] = array(
                                'ma_lbv' => $rowLoaibaiviet['ma_lbv'],
                                'ten_lbv' => $rowLoaibaiviet['ten_lbv'],
                            );
                        }

                        $ma=$_GET['ma_bv'];
                        $sqlBaiviet="SELECT * FROM baiviet WHERE ma_bv=$ma";
                        $resultBaiviet=mysqli_query($conn,$sqlBaiviet);
                        $baiviet=mysqli_fetch_array($resultBaiviet);
                    ?>

                    <!-- <form action="" method="POST" name="frmThem" id="frmThem">
                        <div class="form-group">
                            <label for="hoa_ten">Tên hoa</label>
                            <input type="text" class="form-control" id="hoa_ten" name="hoa_ten" value="<?=$hoa['hoa_ten']?>">
                        </div>
                        <div class="form-group">
                            <label for="hoa_gia">Giá hoa</label>
                            <input type="text" class="form-control" id="hoa_gia" name="hoa_gia" value="<?=$hoa['hoa_gia']?>">
                        </div>
                        <div class="form-group">
                            <label for="hoa_giacu">Giá cũ</label>
                            <input type="text" class="form-control" id="hoa_giacu" name="hoa_giacu" value="<?=$hoa['hoa_giacu']?>">
                        </div>
                        <div class="form-group">
                            <label for="hoa_motan_gan">Mô tả</label>
                            <textarea name="hoa_mota" id="hoa_mota" class="form-control" ><?=$hoa['hoa_mota']?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="hoa_soluong">Số lượng</label>
                            <input type="number" class="form-control" id="hoa_soluong" name="hoa_soluong" value="<?=$hoa['hoa_soluong']?>">
                        </div>
                        <div class="form-group">
                            <label for="lh_ma">Loại hoa</label>
                            <select name="lh_ma" id="lh_ma" class="form-control">
                                <?php foreach($dataLoaihoa as $lh):?>
                                <option value="<?=$lh['lh_ma']?>" <?php  echo( $lh['lh_ma'] == $hoa['lh_ma'] ? 'selected' : '' );?>><?=$lh['lh_ten']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" name="btnThem" id="btnThem">Thêm</button>
                        </div>
                    </form> -->

                    <form action="" method="POST" name="frmThem" id="frmThem" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="bv_ten">Tên bài viết</label>
                            <input type="text" class="form-control" id="bv_ten" name="bv_ten" value="<?=$baiviet['ten_bv']?>">
                        </div>
                        <div class="form-group">
                            <label for="diengiai">Diễn giải</label>
                            <textarea name="diengiai" id="diengiai" class="form-control" ><?=$baiviet['diengiai']?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="link_bv">Liên kết bài viết</label>
                            <textarea name="link_bv" id="link_bv" class="form-control" value=""><?=$baiviet['link_bv']?></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="hoa_ngaycapnhat">Ngày cập nhật</label>
                            <input type="text" class="form-control" id="hoa_ngaycapnhat" name="hoa_ngaycapnhat">
                        </div> -->
                        <div class="form-group">
                            <label for="ma_lbv">Loại bài viết</label>
                            <select name="ma_lbv" id="ma_lbv" class="form-control">
                                <?php foreach($dataLoaibaiviet as $lbv):?>
                                <option value="<?=$lbv['ma_lbv']?>" <?php  echo( $lbv['ma_lbv'] == $baiviet['ma_lbv'] ? 'selected' : '' );?>><?=$lbv['ten_lbv']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hsp_tentaptin">Hình ảnh</label>
                            <input type="file" name="hsp_tentaptin" id="hsp_tentaptin" value="<?=$baiviet['hinh_bv']?>"/>
                        </div>
                        <div class="preview-img-container">
                        <img src="../../assets/imgs/degault.jpg" id="preview-img" width="200px" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" name="btnThem" id="btnThem" style="margin: 2px;">Thêm</button>
                        </div>
                    </form>
            <?php
                if(isset($_POST['btnThem'])){
                    $hoa_ten = htmlentities( $_POST['hoa_ten']);
                    $hoa_mota = htmlentities( $_POST['hoa_mota']);
                    $hoa_gia = htmlentities( $_POST['hoa_gia']);
                    $hoa_giacu = htmlentities( $_POST['hoa_giacu']);
                    $hoa_soluong = htmlentities( $_POST['hoa_soluong']);
                    $lh_ma = htmlentities( $_POST['lh_ma']);
                    include_once('../../../connectdb.php');
                    $sql =<<<EOT
                    UPDATE hoa
                    SET
                        hoa_ten='$hoa_ten',
                        hoa_mota='$hoa_mota',
                        hoa_soluong=$hoa_soluong,
                        hoa_gia=$hoa_gia,
                        hoa_giacu=$hoa_giacu,
                        hoa_ngaycapnhat=NOW(),
                        lh_ma=$lh_ma
                    WHERE hoa_ma=$ma
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
                        maxlength: 1000
                        },
                        hoa_gia: {
                        required: true,
                        minlength: 4,
                        maxlength: 10
                        },
                        hoa_giacu: {
                        required: true,
                        minlength: 4,
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
                        maxlength: "Mô tả cho hoa không được vượt quá 1000 ký tự"
                        },
                        hoa_gia: {
                        required: "Vui lòng giá cho hoa",
                        minlength: "Giá hoa ít nhất có 4 ký tự",
                        maxlength: "Giá hoa có tối đa 10 ký tự"
                        },
                        hoa_giacu: {
                        required: "Vui lòng giá cũ cho hoa",
                        minlength: "Giá hoa ít nhất có 4 ký tự",
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