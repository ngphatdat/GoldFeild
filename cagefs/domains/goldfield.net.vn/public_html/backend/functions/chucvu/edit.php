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
            <h1>Chỉnh sửa chức vụ</h1>
            <?php
                include_once('../../../connectdb.php');
                $ma=$_GET['cv_ma'];
                $sql="SELECT * FROM chucvu WHERE cv_ma=$ma";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
            ?>
            <form action="" method="POST">
                <label for="lh_ten">Tên chức vụ</label> <br/>
                <input class="form-control" type="text" name="cv_ten" id="cv_ten" value="<?=$row['cv_ten']?>"/> <br/>
                <button class="btn btn-primary" name="save">Lưu</button>
            </form>
            <?php
                if(isset($_POST['save'])){
                    $ten= htmlentities( $_POST['cv_ten']);
                    $sql1="UPDATE chucvu SET cv_ten='$ten' WHERE cv_ma=$ma";
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