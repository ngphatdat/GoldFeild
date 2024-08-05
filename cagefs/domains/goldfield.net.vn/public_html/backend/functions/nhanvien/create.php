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
                    <h1>Thêm nhân viên</h1>
                    <?php
                        $conn1=mysqli_connect("localhost","root","","diachi");
                        include_once('../../../connectdb.php');
                        $sqlChucvu = "select * from `chucvu`";

                        // Thực thi câu truy vấn SQL để lấy về dữ liệu
                        $resultChucvu = mysqli_query($conn, $sqlChucvu);

                        // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                        $chucvu = [];
                        while ($rowChucvu = mysqli_fetch_array($resultChucvu, MYSQLI_ASSOC)) {
                            $chucvu[] = array(
                                'cv_ma' => $rowChucvu['cv_ma'],
                                'cv_ten' => $rowChucvu['cv_ten'],
                            );
                        }

                    ?>

                    <form action="" method="POST" name="frmThem" id="frmThem">
                        <div class="form-group">
                            <label for="nv_ten">Tên nhân viên</label>
                            <input type="text" class="form-control" id="nv_ten" name="nv_ten">
                        </div>
                        <div class="form-group">
                            <label for="nv_diachi">Địa chỉ</label><br/>
                            <?php include_once('../diachi/index.php');?><br>
                            <input type="text" class="form-control" id="nv_diachi" name="nv_diachi">
                        </div>
                        <div class="form-group">
                            <label for="nv_taikhoan">Tài khoản</label>
                            <input type="text" class="form-control" id="nv_taikhoan" name="nv_taikhoan">
                        </div>
                        <div class="form-group">
                            <label for="nv_matkhau">Mật khẩu</label>
                            <input type="text" class="form-control" id="nv_matkhau" name="nv_matkhau">
                        </div>
                        <div class="form-group">
                            <label for="nv_chucvu">Chức vụ</label>
                            <select name="nv_chucvu" id="nv_chucvu" class="form-control">
                                <?php foreach($chucvu as $cv):?>
                                <option value="<?=$cv['cv_ma']?>"><?=$cv['cv_ten']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" name="btnThem" id="btnThem">Thêm</button>
                        </div>
                    </form>
            <?php
                if(isset($_POST['btnThem'])){
                    $t=$_POST['province'];
                    $h=$_POST['district'];
                    $x=$_POST['ward'];
                    
        
                    $sqlTinh = "SELECT * FROM province WHERE provinceid='$t'";
                    $resultTinh=mysqli_query($conn1,$sqlTinh);
                    $tinh=mysqli_fetch_array($resultTinh);
                    $tinh1=', '.$tinh['name'];

                    $sqlHuyen = "SELECT * FROM district WHERE districtid='$h'";
                    $resultHuyen=mysqli_query($conn1,$sqlHuyen);
                    $huyen=mysqli_fetch_array($resultHuyen);
                    $huyen1=', '.$huyen['name'];

                    $sqlXa = "SELECT * FROM ward WHERE wardid='$x'";
                    $resultXa=mysqli_query($conn1,$sqlXa);
                    $xa=mysqli_fetch_array($resultXa);
                    $xa1=', '.$xa['name'];
                    
                    $nv_ten = htmlentities( $_POST['nv_ten']);


                    $nv_diachi = htmlentities($_POST['nv_diachi'].$xa1.$huyen1.$tinh1);
                    
                    $nv_taikhoan = htmlentities( $_POST['nv_taikhoan']);
                    $nv_matkhau = sha1(htmlentities( $_POST['nv_matkhau']));
                    $nv_chucvu = htmlentities( $_POST['nv_chucvu']);
                    ?>
                <?php    
                    // include_once('../../../connectdb.php');
                    $connect=mysqli_connect("localhost","root","","ptflower");
                    $sqltk="select * from chucvu";
                    $resulttk=mysqli_query($connect,$sqltk);
                    $sqlThem =<<<EOT
                    INSERT INTO nhanvien
                    (nv_ten, nv_diachi, nv_taikhoan, nv_matkhau, nv_chucvu)
                    VALUES ('$nv_ten', '$nv_diachi', '$nv_taikhoan', '$nv_matkhau', $nv_chucvu)
EOT;
                    var_dump($sqlThem);
                    die;
                    $a = mysqli_query($connect,$sqlThem);
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