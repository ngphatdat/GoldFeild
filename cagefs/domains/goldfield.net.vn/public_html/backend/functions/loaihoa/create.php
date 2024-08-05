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
            <form name="frmLoaiSanPham" id="frmLoaiSanPham" method="POST" action="">
            <div class="mb-3">
                <label for="lh_ten" class="form-label"><b>Tên loại hoa</b></label>
                <input type="text" class="form-control" id="lh_ten" name="lh_ten" aria-describedby="lh_tenHelp">
                <div id="lh_tenHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="lh_mota" class="form-label"><b>Mô tả loại hoa</b></label>
                <textarea class="form-control" name="lh_mota" id="lh_mota" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="add">Lưu</button>
            </form>

            <?php
                // Truy vấn database
                // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        //        include_once(__DIR__ . '/../../../dbconnect.php');

                // 2. Nếu người dùng có bấm nút "Lưu dữ liệu"
                if (isset($_POST['add'])) {
                    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                    $lh_ten = $_POST['lh_ten'];
                    $lh_mota = $_POST['lh_mota'];

                    // Kiểm tra ràng buộc dữ liệu (Validation)
                    // Tạo biến lỗi để chứa thông báo lỗi
                    $errors = [];

                    // Validate Tên loại hoa
                    // required
                    if (empty($lh_ten)) {
                        $errors['lh_ten'][] = [
                        'rule' => 'required',
                        'rule_value' => true,
                        'value' => $lh_ten,
                        'msg' => 'Vui lòng nhập tên Loại hoa'
                        ];
                    }
                    // minlength 3
                    if (!empty($lh_ten) && strlen($lh_ten) < 3) {
                        $errors['lh_ten'][] = [
                        'rule' => 'minlength',
                        'rule_value' => 3,
                        'value' => $lh_ten,
                        'msg' => 'Tên Loại hoa phải có ít nhất 3 ký tự'
                        ];
                    }
                    // maxlength 50
                    if (!empty($lh_ten) && strlen($lh_ten) > 50) {
                        $errors['lh_ten'][] = [
                        'rule' => 'maxlength',
                        'rule_value' => 50,
                        'value' => $lh_ten,
                        'msg' => 'Tên Loại hoa không được vượt quá 50 ký tự'
                        ];
                    }

                    // Validate Diễn giải
                    // required
                    if (empty($lh_mota)) {
                        $errors['lh_mota'][] = [
                        'rule' => 'required',
                        'rule_value' => true,
                        'value' => $lh_mota,
                        'msg' => 'Vui lòng nhập mô tả Loại hoa'
                        ];
                    }
                    // minlength 3
                    if (!empty($lh_mota) && strlen($lh_mota) < 3) {
                        $errors['lh_mota'][] = [
                        'rule' => 'minlength',
                        'rule_value' => 3,
                        'value' => $lh_mota,
                        'msg' => 'Mô tả loại hoa phải có ít nhất 3 ký tự'
                        ];
                    }
                    // maxlength 255
                    if (!empty($lh_mota) && strlen($lh_mota) > 255) {
                        $errors['lh_mota'][] = [
                        'rule' => 'maxlength',
                        'rule_value' => 255,
                        'value' => $lh_mota,
                        'msg' => 'Mô tả loại hoa không được vượt quá 255 ký tự'
                        ];
                    }
                }
                ?>
                <?php if (
                    isset($_POST['add'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                    && isset($errors)         // Nếu biến $errors có tồn tại
                    && (!empty($errors))      // Nếu giá trị của biến $errors không rỗng
                    ) : ?>
                    <div id="errors-container" class="alert alert-danger face my-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            <?php foreach ($errors as $fields) : ?>
                                <?php foreach ($fields as $field) : ?>
                                <li><?php echo $field['msg']; ?></li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php
                if(isset($_POST['add'])){
                    $lh_ten = htmlentities( $_POST['lh_ten']);
                    $lh_mota = htmlentities( $_POST['lh_mota']);
                    include_once('../../../connectdb.php');
                    $sql = "INSERT INTO loaihoa(lh_ten,lh_mota) VALUES ('$lh_ten','$lh_mota')";
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
                    $("#frmLoaiSanPham").validate({
                    rules: {
                        lh_ten: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                        },
                        lh_mota: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                        }
                    },
                    messages: {
                        lh_ten: {
                        required: "Vui lòng nhập tên Loại hoa",
                        minlength: "Tên Loại hoa phải có ít nhất 3 ký tự",
                        maxlength: "Tên Loại hoa không được vượt quá 50 ký tự"
                        },
                        lh_mota: {
                        required: "Vui lòng nhập mô tả cho Loại hoa",
                        minlength: "Mô tả cho Loại hoa phải có ít nhất 3 ký tự",
                        maxlength: "Mô tả cho Loại hoa không được vượt quá 255 ký tự"
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