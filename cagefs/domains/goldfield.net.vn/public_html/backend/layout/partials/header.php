<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Document</title>
</head>
<body >
    <?php
        include_once('../../../connectdb.php');
        $ma=$_SESSION['nhanvien'];
        if(!isset($_SESSION['nhanvien'])){
            echo '<script>window.location.href="../../functions/dangnhap/dangnhap.php"</script>';
        }else{
            $sql="select * from nhanvien where nv_ma=$ma";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($result);
        }
    
    ?>
    <div class="container-fluid">
        <div class="row" style="background-color: brown;">
            <div class="col-md-2">
                <img src="../../assets/imgs/pt.png"  style="width: 200px; hieght:200px; margin-left:0px" alt="">
            </div>
            <div class="col-md-3 mt-2"><span style="font-weight: bold;font-size:20px;color:white;">Admin PT Flower</span></div>
            <div class="col-md-3"></div>
            <div class="col-md-3 mt-2">
                <span style="font-weight: bold;font-size:20px;color:white;">Xin chào <?=$row['nv_ten']?></span>
            </div>
            <div class="col-md-1 mt-1">
                <a href="../../functions/dangnhap/dangxuat.php" class="btn btn-warning">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>