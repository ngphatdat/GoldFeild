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
                    <h1>Thêm chức vụ</h1>

                    <form action="" method="POST" name="frmThem" id="frmThem">
                        <div class="form-group">
                            <label for="hoa_ten">Tên chức vụ</label>
                            <input type="text" class="form-control" id="cv_ten" name="cv_ten">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" name="btnThem" id="btnThem">Thêm</button>
                        </div>
                    </form>
            <?php
                if(isset($_POST['btnThem'])){
                    $cv_ten = htmlentities( $_POST['cv_ten']);
                    include_once('../../../connectdb.php');
                    $sql =<<<EOT
                    INSERT INTO chucvu
	                (cv_ten)
	                VALUES ('$cv_ten')
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
                        cv_ten: {
                        required: true,
                        minlength: 5,
                        maxlength: 70
                        }
                    },
                    messages: {
                        cv_ten: {
                        required: "Vui lòng nhập tên chức vụ",
                        minlength: "Tên chức vụ phải có ít nhất 3 ký tự",
                        maxlength: "Tên chức vụ không được vượt quá 50 ký tự"
                        }
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