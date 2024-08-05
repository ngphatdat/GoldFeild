<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Đăng nhập</title>
    <style>
        .dangnhap{
            width: 420px;
            height: 230px;
            background-color: whitesmoke;
            position: fixed;
            top: 200px;
            right: 500px;
            padding: 10px;
        }
        .chu{
            position: fixed;
            top: 150px;
            left: 500px;
            text-align: center;
            color:white;
        }
        body{
            background-color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 class="chu">Admin PT Flower</h1>
            <div class="dangnhap" >
                <form name="frmDangNhap" id="frmDangNhap" method="POST" action="">
                    <div class="form-group">
                        <label for="taikhoan"> <b>Tài khoản</b></label>
                        <input type="tetx" class="form-control" id="taikhoan" name="taikhoan" require>
                    </div>
                    <div class="form-group">
                        <label for="matkhau"><b>Mật khẩu</b> </label>
                        <input type="password" class="form-control" id="matkhau" name="matkhau" require>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary ">Đăng nhập</button>
                        <a href="#">Bạn quên mật khẩu?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['submit'])){
            $tk=$_POST['taikhoan'];
            $mk=($_POST['matkhau']);
            include_once('../../../connectdb.php');
            $sql="select * from nhanvien where nv_taikhoan='$tk'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) == 0){
                echo '<script>alert("Tên đăng nhập không tồn tại. Vui lòng nhập đúng tên đăng nhập")</script>';
                exit;
            }
            $nv=mysqli_fetch_array($result);
            if($mk != $nv['nv_matkhau']){
                echo '<script>alert("Mật khẩu không đúng. Vui lòng nhập đúng mật khẩu")</script>';  
            }else{
            $_SESSION['nhanvien']=$nv['nv_ma'];
            echo '<script>window.location.href="../hoa/index.php"</script>';
            }
        }    
    ?>
    <?php include_once("../../layout/partials/script.php")?>
</body>
</html>