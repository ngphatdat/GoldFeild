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
            <h1>Chỉnh sửa loại hoa</h1>
            <?php
                include_once('../../../connectdb.php');
                $ma=$_GET['lh_ma'];
                $sql="SELECT * FROM loaihoa WHERE lh_ma=$ma";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
            ?>
            <form action="" method="POST">
                <label for="lh_ten">Tên loại hoa</label> <br/>
                <input class="form-control" type="text" name="lh_ten" id="lh_ten" value="<?=$row['lh_ten']?>"/> <br/>
                <label for="lh_mota">Mô tả loại hoa</label> <br/>
                <input class="form-control" type="text" name="lh_mota" id="lh_mota" value="<?=$row['lh_mota']?>"/> <br/>
                <button class="btn btn-primary" name="save">Lưu</button>
            </form>
            <?php
                if(isset($_POST['save'])){
                    $ten= htmlentities( $_POST['lh_ten']);
                    $mota=$_POST['lh_mota'];
                    $sql1="UPDATE loaihoa SET lh_ten='$ten' , lh_mota='$mota' WHERE lh_ma=$ma";
                    // var_dump($sql1); die;
                    $result1=mysqli_query($conn,$sql1);
                    header('location: index.php');
                }
            ?>
        </div>
    </div>    

<?php include_once("../../layout/partials/footer.php")?>
</div>





    
<?php include_once("../../layout/partials/script.php")?>
</body>
</html>